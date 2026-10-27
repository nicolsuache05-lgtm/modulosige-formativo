<?php

namespace Modules\Egresados\app\Imports;

use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Program;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EgresadosImport
{
    /**
     * Procesa una fila individual (compatible con formato asociativo o numérico).
     *
     * @param array $row
     * @return \Modules\SICA\Entities\Apprentice|null
     */
    public function model(array $row)
    {
        // Obtener valores posicionales como fallback
        $values = array_values($row);

        // Normalizar claves a minúsculas sin acentos ni caracteres especiales
        $normalized = [];
        foreach ($row as $k => $v) {
            $key = (string) $k;
            $key = str_replace(
                ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'],
                ['a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n'],
                $key
            );
            $cleanKey = strtolower(trim(preg_replace('/[^a-zA-Z0-9_]/', '_', $key)));
            $cleanKey = trim(preg_replace('/_+/', '_', $cleanKey), '_');
            $normalized[$cleanKey] = is_string($v) ? trim($v) : $v;
        }

        // Obtener valores con múltiples alias posibles o por posición
        $tipoDoc   = $normalized['tipo_documento'] ?? $normalized['tipo_de_documento'] ?? $normalized['tipo'] ?? $values[0] ?? 'CC';
        $docRaw    = $normalized['numero_de_documento'] ?? $normalized['numero_documento'] ?? $normalized['documento'] ?? $normalized['identificacion'] ?? $normalized['no_documento'] ?? $values[1] ?? null;
        $nombre    = $normalized['nombre_completo'] ?? $normalized['nombre_del_aprendiz'] ?? $normalized['nombre'] ?? $normalized['nombres'] ?? $values[2] ?? 'Aprendiz SENA';
        $correo    = $normalized['correo_electronico'] ?? $normalized['correo'] ?? $normalized['email'] ?? $values[3] ?? null;
        $telefono  = $normalized['telefono'] ?? $normalized['celular'] ?? $normalized['telefono_1'] ?? $values[4] ?? null;
        $programa  = $normalized['programa_de_formacion'] ?? $normalized['programa'] ?? $normalized['nombre_programa'] ?? $values[5] ?? null;
        $ficha     = $normalized['codigo_de_ficha'] ?? $normalized['codigo_ficha'] ?? $normalized['ficha'] ?? $values[6] ?? null;
        $estado    = $normalized['estado'] ?? $normalized['estado_del_aprendiz'] ?? $normalized['estado_ocupacional'] ?? $values[7] ?? 'CERTIFICADO';

        if (empty($docRaw)) {
            return null;
        }

        $docNum = (int) preg_replace('/[^0-9]/', '', (string)$docRaw);
        if ($docNum <= 0) {
            return null;
        }

        // 1. Buscar o Instanciar Persona primero
        $person = Person::firstOrNew(['document_number' => $docNum]);

        // 2. Mapeo de Tipo de Documento al Enum de MySQL
        $mapDocTypes = [
            'CC'  => 'Cédula de ciudadanía',
            'CEDULA' => 'Cédula de ciudadanía',
            'CEDULA DE CIUDADANIA' => 'Cédula de ciudadanía',
            'CE'  => 'Cédula de extranjería',
            'CEDULA DE EXTRANJERIA' => 'Cédula de extranjería',
            'TI'  => 'Tarjeta de identidad',
            'TARJETA DE IDENTIDAD' => 'Tarjeta de identidad',
            'PAS' => 'Pasaporte',
            'PASAPORTE' => 'Pasaporte',
            'DNI' => 'Documento nacional de identidad',
            'RC'  => 'Registro civil',
            'REGISTRO CIVIL' => 'Registro civil',
            'PEP' => 'Permiso de Protección Temporal',
            'PPT' => 'Permiso de Protección Temporal',
            'PERMISO DE PROTECCION TEMPORAL' => 'Permiso de Protección Temporal',
        ];
        $tipoDocClean = strtoupper(trim(str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú'], ['a','e','i','o','u','A','E','I','O','U'], (string)$tipoDoc)));
        $finalDocType = $mapDocTypes[$tipoDocClean] ?? ($person->document_type ?: 'Cédula de ciudadanía');

        // 3. Separar Nombres y Apellidos
        $partes = explode(' ', trim((string)$nombre));
        $firstName = $partes[0] ?? 'Aprendiz';
        $firstLastName = $partes[1] ?? 'SENA';
        $secondLastName = isset($partes[2]) ? implode(' ', array_slice($partes, 2)) : null;

        // 4. Actualizar datos de Persona
        $person->document_type = $finalDocType;
        $person->first_name = $firstName;
        $person->first_last_name = $firstLastName;
        if ($secondLastName) {
            $person->second_last_name = $secondLastName;
        }

        // Correo: Validar formato y verificar que no pertenezca a otra persona con diferente documento
        if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $cleanEmail = strtolower(filter_var($correo, FILTER_SANITIZE_EMAIL));
            $isEmailTakenByOther = Person::where(function($q) use ($cleanEmail) {
                $q->where('personal_email', $cleanEmail)->orWhere('misena_email', $cleanEmail);
            })->where('document_number', '!=', $docNum)->exists();

            if (!$isEmailTakenByOther) {
                $person->personal_email = $cleanEmail;
                $person->misena_email = $cleanEmail;
            }
        }

        // Teléfono: Validar formato (7-15 dígitos) y verificar que no pertenezca a otra persona
        if (!empty($telefono)) {
            $cleanTelDigits = preg_replace('/\D/', '', (string)$telefono);
            if (!empty($cleanTelDigits) && strlen($cleanTelDigits) >= 7 && strlen($cleanTelDigits) <= 15) {
                $isTelTakenByOther = Person::where('telephone1', (int)$cleanTelDigits)
                    ->where('document_number', '!=', $docNum)
                    ->exists();

                if (!$isTelTakenByOther) {
                    $person->telephone1 = (int)$cleanTelDigits;
                }
            }
        }

        // Asignar llaves foráneas por defecto si es nuevo
        if (!$person->exists) {
            $person->eps_id = $person->eps_id ?: (DB::table('e_p_s')->value('id') ?? 1);
            $person->population_group_id = $person->population_group_id ?: (DB::table('population_groups')->value('id') ?? 1);
            $person->pension_entity_id = $person->pension_entity_id ?: (DB::table('pension_entities')->value('id') ?? 1);
        }
        $person->save();

        // 4. Buscar o Asociar Curso (Ficha / Programa)
        $courseId = null;
        if (!empty($ficha)) {
            $cleanFicha = preg_replace('/[^0-9]/', '', (string)$ficha);
            $course = Course::where('code', $cleanFicha)->orWhere('code', (string)$ficha)->first();
            if ($course) {
                $courseId = $course->id;
            }
        }

        if (!$courseId && !empty($programa)) {
            $prog = Program::where('name', 'like', "%{$programa}%")->first();
            if ($prog) {
                $course = Course::where('program_id', $prog->id)->first();
                if ($course) {
                    $courseId = $course->id;
                }
            }
        }

        if (!$courseId) {
            $firstCourse = Course::first();
            $courseId = $firstCourse ? $firstCourse->id : 1;
        }

        // 5. Mapear Estado Ocupacional al Enum de MySQL (por defecto CERTIFICADO para egresados)
        $mapStatus = [
            'NO REGISTRA'       => 'NO REGISTRA',
            'CERTIFICADO'       => 'CERTIFICADO',
            'EGRESADO'          => 'CERTIFICADO',
            'GRADUADO'          => 'CERTIFICADO',
            'TITULADO'          => 'CERTIFICADO',
            'FINALIZADO'        => 'CERTIFICADO',
            'CULMINADO'         => 'CERTIFICADO',
            'EN FORMACION'      => 'EN FORMACIÓN',
            'EN FORMACIÓN'      => 'EN FORMACIÓN',
            'RETIRO VOLUNTARIO' => 'RETIRO VOLUNTARIO',
            'CANCELADO'         => 'CANCELADO',
            'TRASLADADO'        => 'TRASLADADO',
            'APLAZADO'          => 'APLAZADO',
            'INDUCCION'         => 'INDUCCIÓN',
            'INDUCCIÓN'         => 'INDUCCIÓN',
            'CONDICIONADO'      => 'CONDICIONADO',
        ];
        $statusClean = strtoupper(trim(str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú'], ['a','e','i','o','u','A','E','I','O','U'], (string)$estado)));
        $finalStatus = $mapStatus[$statusClean] ?? 'CERTIFICADO';

        // 6. Crear o Actualizar Aprendiz (Egresado)
        $apprentice = Apprentice::firstOrNew(['person_id' => $person->id]);
        $apprentice->course_id = $courseId;
        $apprentice->apprentice_status = $finalStatus;
        $apprentice->save();

        return $apprentice;
    }

    /**
     * Importa directamente un archivo CSV o Excel (.xlsx) subido.
     *
     * @param \Illuminate\Http\UploadedFile|string $file
     * @return int Cantidad de registros procesados
     */
    public function import($file): int
    {
        $path = is_string($file) ? $file : $file->getRealPath();
        $rows = SimpleXlsxReader::read($path);

        if (empty($rows)) {
            throw new \Exception("El archivo está vacío o no contiene registros procesables.");
        }

        $header = array_shift($rows);
        if (isset($header[0])) {
            $header[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', (string)$header[0]);
        }

        $processedCount = 0;
        $syncService = app(\Modules\Egresados\Services\SigeSyncService::class);
        $chunk = [];

        try {
            foreach ($rows as $row) {
                if (empty(array_filter($row, fn($val) => trim((string)$val) !== ''))) {
                    continue;
                }

                if (count($header) === count($row)) {
                    $rowData = array_combine($header, $row);
                } else {
                    $rowData = $row;
                }

                $chunk[] = $rowData;

                if (count($chunk) >= 500) {
                    $processedCount += $syncService->upsertChunk($chunk);
                    $chunk = [];
                }
            }

            if (!empty($chunk)) {
                $processedCount += $syncService->upsertChunk($chunk);
                unset($chunk);
            }

            return $processedCount;
        } catch (\Throwable $e) {
            Log::error('Error en EgresadosImport masivo: ' . $e->getMessage());
            throw $e;
        }
    }
}
