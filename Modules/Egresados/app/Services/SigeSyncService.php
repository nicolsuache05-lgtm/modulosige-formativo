<?php

namespace Modules\Egresados\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;

class SigeSyncService
{
    protected string $baseUrl;
    protected ?string $token;
    protected int $timeout;
    protected int $defaultPerPage;

    // Cache local en memoria para resoluciones O(1) de cursos y maestros
    protected ?array $courseMap = null;
    protected ?int $defaultEpsId = null;
    protected ?int $defaultPopulationGroupId = null;
    protected ?int $defaultPensionEntityId = null;
    protected ?int $fallbackCourseId = null;

    public function __construct()
    {
        $this->baseUrl = (string) (config('egresados.sige.base_url') 
            ?? config('services.sige.base_url') 
            ?? env('SIGE_API_URL', 'https://api.sige.ejemplo.com/v1'));

        $this->token = config('egresados.sige.token') 
            ?? config('services.sige.token') 
            ?? env('SIGE_API_TOKEN', null);

        $this->timeout = (int) (config('egresados.sige.timeout') ?? 60);
        $this->defaultPerPage = (int) (config('egresados.sige.per_page') ?? 500);
    }

    /**
     * Sincroniza masivamente registros desde la API de SIGE en lotes/chunks iterativos.
     * Evita saturar la memoria RAM y optimiza las consultas SQL mediante upsert por lotes.
     *
     * @param callable|null $onProgress Callback invocado por cada lote: fn(int $pagina, int $loteCount, int $totalSoFar)
     * @param int|null $perPage Tamaño de cada página consultada (por defecto 500)
     * @param int|null $maxPages Límite opcional de páginas a consultar
     * @return array Resumen de la sincronización
     */
    public function syncAll(?callable $onProgress = null, ?int $perPage = null, ?int $maxPages = null): array
    {
        // Aumentar temporalmente el tiempo de ejecución para altos volúmenes
        @set_time_limit(600);

        $pagina = 1;
        $porPagina = $perPage ?: $this->defaultPerPage;
        $totalProcesados = 0;
        $hayMasPaginas = true;

        $this->preloadMasterData();

        while ($hayMasPaginas) {
            if ($maxPages !== null && $pagina > $maxPages) {
                break;
            }

            $endpoint = rtrim($this->baseUrl, '/') . '/egresados';
            $client = Http::timeout($this->timeout);

            if (!empty($this->token)) {
                $client = $client->withToken($this->token);
            }

            try {
                $response = $client->get($endpoint, [
                    'page'     => $pagina,
                    'per_page' => $porPagina,
                    'limit'    => $porPagina,
                ]);
            } catch (\Throwable $e) {
                Log::error("Excepción de red al conectar con API SIGE en la página {$pagina}: " . $e->getMessage());
                return [
                    'success'          => false,
                    'error'            => 'Error de conexión con la API de SIGE: ' . $e->getMessage(),
                    'total_procesados' => $totalProcesados,
                    'paginas'          => $pagina - 1,
                ];
            }

            if ($response->failed()) {
                Log::error("Error HTTP en API SIGE en la página {$pagina}", [
                    'status' => $response->status(),
                    'error'  => $response->body(),
                ]);
                return [
                    'success'          => false,
                    'error'            => "Respuesta HTTP {$response->status()} en página {$pagina}",
                    'total_procesados' => $totalProcesados,
                    'paginas'          => $pagina - 1,
                ];
            }

            $datos = $response->json('data') ?? $response->json('egresados') ?? $response->json() ?? [];

            // Si la respuesta no es un arreglo o viene vacía, finalizamos
            if (!is_array($datos) || empty($datos)) {
                $hayMasPaginas = false;
                break;
            }

            // Si los datos vinieron envueltos en un objeto asociativo
            if (isset($datos['data']) && is_array($datos['data'])) {
                $datos = $datos['data'];
            }

            // Procesar el lote mediante UPSERT SQL masivo
            $procesadosEnLote = $this->upsertChunk($datos);
            $totalProcesados += $procesadosEnLote;

            if ($onProgress) {
                $onProgress($pagina, $procesadosEnLote, $totalProcesados);
            }

            // Control de paginación
            $meta = $response->json('meta');
            if ($meta && isset($meta['last_page'])) {
                $hayMasPaginas = $pagina < (int) $meta['last_page'];
            } elseif ($meta && isset($meta['total_pages'])) {
                $hayMasPaginas = $pagina < (int) $meta['total_pages'];
            } elseif ($response->json('next_page_url')) {
                $hayMasPaginas = true;
            } else {
                // Si la API devuelve menos registros que el límite pedido, era la última
                $hayMasPaginas = count($datos) >= $porPagina;
            }

            // Liberar memoria del lote inmediatamente
            unset($datos, $response);
            $pagina++;
        }

        return [
            'success'          => true,
            'total_procesados' => $totalProcesados,
            'paginas'          => $pagina - 1,
        ];
    }

    /**
     * Sincroniza una página específica (compatible con llamadas puntuales).
     */
    public function syncEgresados(int $pagina = 1, int $limite = 500): array
    {
        $this->preloadMasterData();

        $endpoint = rtrim($this->baseUrl, '/') . '/egresados';
        $client = Http::timeout($this->timeout);

        if (!empty($this->token)) {
            $client = $client->withToken($this->token);
        }

        try {
            $response = $client->get($endpoint, [
                'page'     => $pagina,
                'per_page' => $limite,
                'limit'    => $limite,
            ]);

            if ($response->failed()) {
                Log::error('Error al consultar la API de SIGE', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return ['success' => false, 'procesados' => 0];
            }

            $datos = $response->json('data') ?? $response->json() ?? [];
            if (isset($datos['data']) && is_array($datos['data'])) {
                $datos = $datos['data'];
            }

            $procesados = $this->upsertChunk($datos);

            return [
                'success'    => true,
                'procesados' => $procesados,
                'total_api'  => count($datos),
            ];
        } catch (\Throwable $e) {
            Log::error('Excepción en syncEgresados: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage(), 'procesados' => 0];
        }
    }

    /**
     * Procesa un lote (chunk de 500 registros) mediante UPSERT SQL masivo en las tablas
     * nativas del ERP (people y apprentices), eliminando consultas 1 a 1 y N+1.
     *
     * @param array $items Registros crudos recibidos desde la API
     * @return int Cantidad de registros procesados en este lote
     */
    public function upsertChunk(array $items): int
    {
        if (empty($items)) {
            return 0;
        }

        $this->preloadMasterData();

        $mapDocTypes = [
            'CC'                             => 'Cédula de ciudadanía',
            'CEDULA'                         => 'Cédula de ciudadanía',
            'CEDULA DE CIUDADANIA'           => 'Cédula de ciudadanía',
            'CE'                             => 'Cédula de extranjería',
            'CEDULA DE EXTRANJERIA'          => 'Cédula de extranjería',
            'TI'                             => 'Tarjeta de identidad',
            'TARJETA DE IDENTIDAD'           => 'Tarjeta de identidad',
            'PAS'                            => 'Pasaporte',
            'PASAPORTE'                      => 'Pasaporte',
            'DNI'                            => 'Documento nacional de identidad',
            'RC'                             => 'Registro civil',
            'REGISTRO CIVIL'                 => 'Registro civil',
            'PEP'                            => 'Permiso de Protección Temporal',
            'PPT'                            => 'Permiso de Protección Temporal',
            'PERMISO DE PROTECCION TEMPORAL' => 'Permiso de Protección Temporal',
        ];

        $mapStatus = [
            'NO REGISTRA'       => 'NO REGISTRA',
            'CERTIFICADO'       => 'CERTIFICADO',
            'EGRESADO'          => 'CERTIFICADO',
            'GRADUADO'          => 'CERTIFICADO',
            'EN FORMACION'      => 'EN FORMACIÓN',
            'EN FORMACIÓN'      => 'EN FORMACIÓN',
            'EMPLEADO'          => 'EN FORMACIÓN',
            'RETIRO VOLUNTARIO' => 'RETIRO VOLUNTARIO',
            'CANCELADO'         => 'CANCELADO',
            'TRASLADADO'        => 'TRASLADADO',
            'APLAZADO'          => 'APLAZADO',
            'INDUCCION'         => 'INDUCCIÓN',
            'INDUCCIÓN'         => 'INDUCCIÓN',
            'CONDICIONADO'      => 'CONDICIONADO',
        ];

        $now = now()->toDateTimeString();
        $peopleBatch = [];
        $itemsByDoc = [];

        // 1. Mapeo estricto y depuración en memoria: solo los campos necesarios
        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $rawDoc = $item['numero_documento'] 
                ?? $item['numero_de_documento']
                ?? $item['documento'] 
                ?? $item['identificacion'] 
                ?? $item['no_documento']
                ?? $item['document_number'] 
                ?? $item['codigo'] 
                ?? null;

            if ($rawDoc === null) {
                continue;
            }

            $docNum = (int) preg_replace('/[^0-9]/', '', (string) $rawDoc);
            if ($docNum <= 0) {
                continue;
            }

            // Resolver tipo de documento institucional
            $rawDocType = strtoupper(trim((string) ($item['tipo_documento'] ?? $item['tipo'] ?? 'CC')));
            $cleanDocTypeKey = str_replace(['Á','É','Í','Ó','Ú'], ['A','E','I','O','U'], $rawDocType);
            $docType = $mapDocTypes[$cleanDocTypeKey] ?? 'Cédula de ciudadanía';

            // Resolver nombres y apellidos
            $rawFirstName = trim((string) ($item['nombres'] ?? $item['first_name'] ?? ''));
            $rawLastName  = trim((string) ($item['apellidos'] ?? $item['first_last_name'] ?? ''));

            if ($rawFirstName === '' && !empty($item['nombre_completo'])) {
                $partes = preg_split('/\s+/', trim((string) $item['nombre_completo']));
                $rawFirstName = $partes[0] ?? 'Aprendiz';
                $rawLastName  = isset($partes[1]) ? implode(' ', array_slice($partes, 1)) : 'SENA';
            }

            $firstName = $rawFirstName !== '' ? substr($rawFirstName, 0, 100) : 'Aprendiz';
            $firstLastName = $rawLastName !== '' ? substr($rawLastName, 0, 100) : 'SENA';
            $secondLastName = !empty($item['segundo_apellido']) ? substr(trim((string) $item['segundo_apellido']), 0, 100) : null;

            // Sanitizar correo
            $rawEmail = strtolower(trim((string) ($item['correo'] ?? $item['email'] ?? $item['correo_electronico'] ?? '')));
            $cleanEmail = filter_var($rawEmail, FILTER_VALIDATE_EMAIL) ? substr($rawEmail, 0, 150) : null;

            // Sanitizar teléfono
            $rawTel = preg_replace('/[^0-9]/', '', (string) ($item['telefono'] ?? $item['celular'] ?? ''));
            $cleanTel = ($rawTel !== '' && strlen($rawTel) >= 7) ? (int) substr($rawTel, 0, 18) : null;

            // Fila para UPSERT masivo en `people` (identificador único: document_number)
            $peopleBatch[$docNum] = [
                'document_type'        => $docType,
                'document_number'      => $docNum,
                'first_name'           => $firstName,
                'first_last_name'      => $firstLastName,
                'second_last_name'     => $secondLastName,
                'personal_email'       => $cleanEmail,
                'misena_email'         => $cleanEmail,
                'telephone1'           => $cleanTel,
                'eps_id'               => $this->defaultEpsId,
                'population_group_id'  => $this->defaultPopulationGroupId,
                'pension_entity_id'    => $this->defaultPensionEntityId,
                'created_at'           => $now,
                'updated_at'           => $now,
            ];

            // Almacenar metadatos del egresado para vincular con `apprentices`
            $itemsByDoc[$docNum] = $item;
        }

        if (empty($peopleBatch)) {
            return 0;
        }

        // 2. Ejecutar UPSERT por lotes en la tabla `people` (1 sola consulta SQL para hasta 500 registros)
        DB::table('people')->upsert(
            array_values($peopleBatch),
            ['document_number'], // Clave única nativa de MySQL
            [
                'document_type',
                'first_name',
                'first_last_name',
                'second_last_name',
                'personal_email',
                'misena_email',
                'telephone1',
                'updated_at',
            ]
        );

        // 3. Recuperar en 1 sola consulta indexada los IDs generados/existentes de `people`
        $docNumbers = array_keys($peopleBatch);
        $personIdMap = DB::table('people')
            ->whereIn('document_number', $docNumbers)
            ->pluck('id', 'document_number')
            ->toArray();

        // 4. Preparar lote para UPSERT en la tabla `apprentices` (clave única: person_id + course_id)
        $apprenticeBatch = [];

        foreach ($itemsByDoc as $docNum => $item) {
            $personId = $personIdMap[$docNum] ?? null;
            if (!$personId) {
                continue;
            }

            // Resolver ficha / curso en O(1) desde memoria sin consultas repetidas
            $rawFicha = preg_replace('/[^0-9]/', '', (string) ($item['ficha'] ?? $item['codigo_ficha'] ?? $item['codigo_de_ficha'] ?? $item['course_code'] ?? ''));
            $courseId = $this->courseMap[$rawFicha] ?? $this->fallbackCourseId;

            // Mapear estado ocupacional
            $rawStatus = strtoupper(trim((string) ($item['estado'] ?? $item['estado_ocupacional'] ?? 'CERTIFICADO')));
            $cleanStatusKey = str_replace(['Á','É','Í','Ó','Ú'], ['A','E','I','O','U'], $rawStatus);
            $apprenticeStatus = $mapStatus[$cleanStatusKey] ?? 'CERTIFICADO';

            $compositeKey = "{$personId}_{$courseId}";
            $apprenticeBatch[$compositeKey] = [
                'person_id'         => $personId,
                'course_id'         => $courseId,
                'apprentice_status' => $apprenticeStatus,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];
        }

        // 5. Ejecutar UPSERT por lotes en la tabla `apprentices` (1 sola consulta SQL masiva)
        if (!empty($apprenticeBatch)) {
            DB::table('apprentices')->upsert(
                array_values($apprenticeBatch),
                ['person_id', 'course_id'], // Clave única compuesta en apprentices
                [
                    'apprentice_status',
                    'updated_at',
                ]
            );
        }

        $procesadosCount = count($peopleBatch);

        // Limpiar memoria
        unset($peopleBatch, $itemsByDoc, $docNumbers, $personIdMap, $apprenticeBatch);

        return $procesadosCount;
    }

    /**
     * Permite probar localmente la velocidad y el consumo de memoria del UPSERT
     * masivo con entre 5.000 y 10.000 registros sintéticos.
     *
     * @param int $totalCount Cantidad de registros a generar y sincronizar (ej. 5000 o 10000)
     * @param callable|null $onProgress
     * @return array
     */
    public function syncMockBenchmark(int $totalCount = 5000, ?callable $onProgress = null): array
    {
        @set_time_limit(600);
        $chunkSize = 500;
        $totalProcesados = 0;
        $paginas = (int) ceil($totalCount / $chunkSize);

        $fichasDisponibles = array_keys($this->getCourseMap());
        if (empty($fichasDisponibles)) {
            $fichasDisponibles = ['2692929', '2501020', '2615840'];
        }

        for ($p = 1; $p <= $paginas; $p++) {
            $lote = [];
            $registrosEnEsteLote = min($chunkSize, $totalCount - $totalProcesados);

            for ($i = 1; $i <= $registrosEnEsteLote; $i++) {
                $docIndex = 90000000 + (($p - 1) * $chunkSize) + $i;
                $fichaRand = $fichasDisponibles[array_rand($fichasDisponibles)];

                $lote[] = [
                    'sige_id'          => "SIGE-{$docIndex}",
                    'tipo_documento'   => 'CC',
                    'numero_documento' => (string) $docIndex,
                    'nombres'          => "Aprendiz{$i}",
                    'apellidos'        => "Sige{$p}",
                    'correo'           => "egresado_{$docIndex}@sena.edu.co",
                    'telefono'         => "310" . str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                    'ficha'            => $fichaRand,
                    'programa'         => 'Análisis y Desarrollo de Software',
                    'estado'           => 'CERTIFICADO',
                    'fecha_graduacion' => '2025-12-15',
                ];
            }

            $procesados = $this->upsertChunk($lote);
            $totalProcesados += $procesados;

            if ($onProgress) {
                $onProgress($p, $procesados, $totalProcesados);
            }

            unset($lote);
        }

        return [
            'success'          => true,
            'total_procesados' => $totalProcesados,
            'paginas'          => $paginas,
        ];
    }

    /**
     * Precarga los maestros institucionales para evitar miles de consultas repetitivas.
     */
    protected function preloadMasterData(): void
    {
        if ($this->courseMap === null) {
            $this->courseMap = Course::pluck('id', 'code')->toArray();
        }

        if ($this->fallbackCourseId === null) {
            $this->fallbackCourseId = Course::value('id') ?? 1;
        }

        if ($this->defaultEpsId === null) {
            $this->defaultEpsId = DB::table('e_p_s')->value('id') ?? 0;
        }

        if ($this->defaultPopulationGroupId === null) {
            $this->defaultPopulationGroupId = DB::table('population_groups')->value('id') ?? 1;
        }

        if ($this->defaultPensionEntityId === null) {
            $this->defaultPensionEntityId = DB::table('pension_entities')->value('id') ?? 1;
        }
    }

    /**
     * Retorna el mapa de cursos indexado por código de ficha.
     */
    public function getCourseMap(): array
    {
        $this->preloadMasterData();
        return $this->courseMap ?? [];
    }
}
