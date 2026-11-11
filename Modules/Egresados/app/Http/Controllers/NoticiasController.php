<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NoticiasController extends Controller
{
    /**
     * Parsea la fecha de vigencia o límite temporal de una noticia para verificar si ha expirado.
     */
    public static function parseNoticiaExpiry(?string $vigenciaStr, ?string $dateStr = null): ?\Carbon\Carbon
    {
        if (!empty($vigenciaStr)) {
            $vigenciaStr = trim($vigenciaStr);
            try {
                if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $vigenciaStr, $m)) {
                    return \Carbon\Carbon::createFromDate((int)$m[3], (int)$m[2], (int)$m[1])->endOfDay();
                }
                if (preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})$/', $vigenciaStr, $m)) {
                    return \Carbon\Carbon::createFromDate((int)$m[1], (int)$m[2], (int)$m[3])->endOfDay();
                }
                return \Carbon\Carbon::parse($vigenciaStr)->endOfDay();
            } catch (\Throwable $e) {}
        }

        // Si no se definió fecha explícita, se calcula 30 días a partir de la fecha de publicación
        if (!empty($dateStr)) {
            try {
                if (preg_match('/^(\d{1,2})\s+([A-Za-zñáéíóú]+)\s+(\d{4})$/u', trim($dateStr), $m)) {
                    $meses = [
                        'ene' => 1, 'feb' => 2, 'mar' => 3, 'abr' => 4, 'may' => 5, 'jun' => 6,
                        'jul' => 7, 'ago' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'dic' => 12
                    ];
                    $subMes = mb_strtolower(mb_substr($m[2], 0, 3));
                    $mesNum = $meses[$subMes] ?? 11;
                    return \Carbon\Carbon::createFromDate((int)$m[3], $mesNum, (int)$m[1])->addDays(30)->endOfDay();
                }
                return \Carbon\Carbon::parse($dateStr)->addDays(30)->endOfDay();
            } catch (\Throwable $e) {}
        }

        return null;
    }

    /**
     * Lista base de noticias institucionales del CEFA.
     */
    private function getDefaultNoticias(): array
    {
        return [
            [
                'id' => 'NOT-001',
                'title' => 'Convocatoria Fondo Emprender 2026 para Egresados SENA',
                'category' => 'Convocatorias',
                'category_pill' => 'status-green',
                'summary' => 'Abierta la convocatoria nacional con capital semilla de hasta $100 millones para iniciativas innovadoras en sectores agropecuario, TIC y servicios.',
                'content' => "El Fondo Emprender del SENA abre una nueva convocatoria especial dirigida exclusivamente a egresados certificados de programas técnicos, tecnólogos y especializaciones tecnológicas.\n\nPodrán postularse planes de negocio enfocados en transformación digital, agroindustria sostenible, energías limpias y desarrollo de software. Los seleccionados recibirán asesoría personalizada de los Centros de Desarrollo Empresarial (SBDC) y capital semilla no reembolsable.\n\nFechas clave:\n• Apertura: 01 de Noviembre 2026\n• Cierre de postulaciones: 15 de Diciembre 2026\n• Publicación de resultados: Enero 2027.",
                'author' => 'Centro de Desarrollo Empresarial SBDC',
                'author_role' => 'Coordinación Fondo Emprender',
                'date' => '04 Nov 2026',
                'fecha_vigencia' => '15/12/2026',
                'status' => 'DESTACADA',
                'status_pill' => 'status-blue',
                'views_count' => 542,
                'target' => 'Todos los Egresados CEFA',
                'icon' => 'fa-solid fa-bullhorn',
                'icon_bg' => '#EAF7EE',
                'icon_color' => '#39A900',
                'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'NOT-002',
                'title' => 'Alianza Estratégica con Empresas TIC para Vinculación Laboral Inmediata',
                'category' => 'Empleabilidad',
                'category_pill' => 'status-blue',
                'summary' => 'Más de 45 vacantes disponibles para egresados de ADSO, Animación Digital y Redes con contratación directa y modalidad remota o híbrida.',
                'content' => "La Agencia Pública de Empleo (APE) de la regional Huila junto a una red de 12 empresas aliadas de tecnología han abierto 45 plazas de trabajo para egresados de Análisis y Desarrollo de Software (ADSO) y carreras afines.\n\nRequisitos principales:\n• Título de tecnólogo SENA en ADSO o Sistemas.\n• Conocimientos en desarrollo web (PHP/Laravel, JavaScript, Python) o desarrollo móvil.\n• Hoja de vida registrada y actualizada al 100% en la plataforma APE.\n\nLos interesados pueden postularse a través de la intermediación laboral del Centro CEFA La Angostura.",
                'author' => 'Agencia Pública de Empleo (APE)',
                'author_role' => 'Líder de Intermediación Laboral',
                'date' => '02 Nov 2026',
                'fecha_vigencia' => '02/12/2026',
                'status' => 'PUBLICADA',
                'status_pill' => 'status-green',
                'views_count' => 389,
                'target' => 'Egresados ADSO y TIC',
                'icon' => 'fa-solid fa-briefcase',
                'icon_bg' => '#EEF4FF',
                'icon_color' => '#2563EB',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'NOT-003',
                'title' => 'Jornada de Certificación por Competencias Laborales para Egresados',
                'category' => 'Capacitación',
                'category_pill' => 'status-amber',
                'summary' => 'Valida tu experiencia laboral en normas del sector agropecuario, riego, mecanización y buenas prácticas agrícolas sin costo alguno.',
                'content' => "El área de Evaluación y Certificación de Competencias Laborales (ECCL) del CEFA La Angostura invita a todos los egresados con experiencia demostrable de mínimo 6 meses a certificar sus saberes empíricos y laborales.\n\nNormas disponibles en esta vigencia:\n1. Mantenimiento y operación de maquinaria agrícola.\n2. Implementación de Buenas Prácticas Agrícolas (BPA).\n3. Gestión de sistemas de riego y fertirriego.\n4. Manejo técnico de poscosecha.\n\nEl proceso es 100% virtual y gratuito, otorgando certificado oficial del SENA con validez nacional.",
                'author' => 'Líder ECCL - CEFA',
                'author_role' => 'Certificación de Competencias',
                'date' => '29 Oct 2026',
                'fecha_vigencia' => '29/11/2026',
                'status' => 'PUBLICADA',
                'status_pill' => 'status-green',
                'views_count' => 274,
                'target' => 'Egresados Agropecuarios',
                'icon' => 'fa-solid fa-certificate',
                'icon_bg' => '#FEF3C7',
                'icon_color' => '#D97706',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'NOT-004',
                'title' => 'CEFA La Angostura Inaugura Nuevo Laboratorio de Biotecnología',
                'category' => 'Institucional',
                'category_pill' => 'status-green',
                'summary' => 'Modernas instalaciones disponibles para proyectos de investigación aplicada, emprendimiento Sennova y prácticas de egresados.',
                'content' => "Con una inversión superior a los 1.200 millones de pesos, el Centro de Formación Agroindustrial La Angostura puso en funcionamiento el nuevo Complejo de Biotecnología y Análisis Químico.\n\nEl espacio cuenta con equipos de cromatografía, microscopía electrónica y biorreactores para el mejoramiento genético de cultivos del sur del país. Egresados con proyectos en marcha podrán acceder a los servicios de laboratorio a través de las convocatorias de Sennova.",
                'author' => 'Subdirección de Centro CEFA',
                'author_role' => 'Comunicaciones Institucionales',
                'date' => '24 Oct 2026',
                'fecha_vigencia' => '05/11/2026',
                'status' => 'EXPIRADA',
                'status_pill' => 'status-gray',
                'views_count' => 415,
                'target' => 'Comunidad CEFA',
                'icon' => 'fa-solid fa-microscope',
                'icon_bg' => '#E0F2FE',
                'icon_color' => '#0284C7',
                'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'NOT-005',
                'title' => 'Programa de Mentorías 2026: Egresados Orientan a Nuevos Aprendices',
                'category' => 'Comunidad',
                'category_pill' => 'status-blue',
                'summary' => 'Súmate como mentor voluntario y comparte tu trayectoria laboral con aprendices que inician su etapa productiva en empresas de la región.',
                'content' => "La Coordinación Académica lanza el programa 'Huella SENA: Egresados que Inspiran'. Buscamos profesionales egresados con más de 2 años de experiencia en el mercado laboral que deseen apadrinar aprendices de último trimestre.\n\nEl rol de mentor incluye 2 sesiones mensuales virtuales de orientación vocacional, revisión de desafíos laborales y networking. Los mentores recibirán reconocimiento institucional formal y acceso prioritario a cursos de educación continua del SENA.",
                'author' => 'Bienestar al Aprendiz & Egresados',
                'author_role' => 'Coordinación de Egresados',
                'date' => '18 Oct 2026',
                'fecha_vigencia' => '01/11/2026',
                'status' => 'EXPIRADA',
                'status_pill' => 'status-gray',
                'views_count' => 198,
                'target' => 'Egresados con Experiencia',
                'icon' => 'fa-solid fa-users-rays',
                'icon_bg' => '#F3E8FF',
                'icon_color' => '#9333EA',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'NOT-006',
                'title' => 'Próxima Feria de Servicios y Homologación Universitaria',
                'category' => 'Capacitación',
                'category_pill' => 'status-amber',
                'summary' => 'Convenios con universidades nacionales para continuidad formativa a nivel profesional con tarifas especiales y reconocimiento de créditos.',
                'content' => "El próximo 25 de noviembre se llevará a cabo en la biblioteca institucional la Feria de Articulación y Homologación Superior con universidades adscritas a los convenios marco SENA.\n\nEgresados tecnólogos podrán conocer las tablas de homologación para carreras de Ingeniería de Sistemas, Agronomía, Administración de Empresas y Medicina Veterinaria.",
                'author' => 'Área de Relaciones Corporativas',
                'author_role' => 'Convenios Institucionales',
                'date' => '12 Oct 2026',
                'fecha_vigencia' => '25/11/2026',
                'status' => 'BORRADOR',
                'status_pill' => 'status-amber',
                'views_count' => 86,
                'target' => 'Tecnólogos Egresados',
                'icon' => 'fa-solid fa-graduation-cap',
                'icon_bg' => '#FFF8E6',
                'icon_color' => '#B45309',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&auto=format&fit=crop&q=80',
            ],
        ];
    }

    /**
     * Procesa y guarda un archivo de imagen si fue subido.
     */
    private function processUploadedImage(Request $request): ?string
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'noticia_' . time() . '_' . uniqid() . '.' . $extension;
            
            $destinationPath = public_path('storage/noticias');
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
            return asset('storage/noticias/' . $filename);
        }

        if ($imageUrl = trim($request->input('image_url', ''))) {
            return $imageUrl;
        }

        return null;
    }

    /**
     * Ruta al archivo persistente de noticias personalizadas.
     */
    public static function getCustomNoticiasFile(): string
    {
        return storage_path('app/custom_noticias.json');
    }

    /**
     * Obtiene noticias personalizadas desde archivo y sesión.
     */
    public static function getCustomNoticias(): array
    {
        $fileNoticias = [];
        $filePath = self::getCustomNoticiasFile();
        if (file_exists($filePath)) {
            $json = @file_get_contents($filePath);
            $fileNoticias = json_decode($json, true) ?: [];
        }

        $sessionNoticias = session('custom_noticias', []);

        $merged = [];
        foreach (array_merge($sessionNoticias, $fileNoticias) as $item) {
            if (!empty($item['id']) && !isset($merged[$item['id']])) {
                $merged[$item['id']] = $item;
            }
        }

        return array_values($merged);
    }

    /**
     * Guarda o actualiza una noticia personalizada en sesión y archivo.
     */
    public static function saveNoticiaCustom(array $noticia): void
    {
        $custom = self::getCustomNoticias();
        $found = false;

        foreach ($custom as &$c) {
            if ($c['id'] === $noticia['id']) {
                $c = $noticia;
                $found = true;
                break;
            }
        }

        if (!$found) {
            array_unshift($custom, $noticia);
        }

        session(['custom_noticias' => $custom]);
        @file_put_contents(self::getCustomNoticiasFile(), json_encode($custom, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Elimina una noticia personalizada de sesión y archivo.
     */
    public static function deleteNoticiaCustom(string $id): void
    {
        $custom = self::getCustomNoticias();
        $custom = array_values(array_filter($custom, fn($n) => $n['id'] !== $id));
        session(['custom_noticias' => $custom]);
        @file_put_contents(self::getCustomNoticiasFile(), json_encode($custom, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Obtiene la lista combinada de noticias (sesión + predeterminadas),
     * aplicando la verificación de fecha de vigencia/expiración automática.
     */
    public static function getAllNoticias(): array
    {
        $custom = self::getCustomNoticias();
        $defaults = (new self)->getDefaultNoticias();

        $customIds = array_column($custom, 'id');
        $filteredDefaults = array_filter($defaults, fn($d) => !in_array($d['id'], $customIds));

        $all = array_values(array_merge($custom, $filteredDefaults));

        $now = \Carbon\Carbon::now();
        foreach ($all as &$n) {
            $statusCurrent = strtoupper($n['status'] ?? 'PUBLICADA');
            if ($statusCurrent !== 'BORRADOR') {
                $expiry = self::parseNoticiaExpiry($n['fecha_vigencia'] ?? null, $n['date'] ?? null);
                if ($expiry && $expiry->lessThanOrEqualTo($now)) {
                    $n['status'] = 'EXPIRADA';
                    $n['status_pill'] = 'status-gray';
                    $n['auto_expirada'] = true;
                }
            }
        }
        unset($n);

        return $all;
    }

    /**
     * Guarda o actualiza una noticia en la sesión (retrocompatibilidad).
     */
    private function saveNoticiaInSession(array $noticia): void
    {
        self::saveNoticiaCustom($noticia);
    }

    /**
     * Vista principal de Noticias para Superadmin.
     */
    public function index(Request $request)
    {
        $noticias = $this->getAllNoticias();

        if ($search = trim($request->input('search', ''))) {
            $noticias = array_filter($noticias, function ($n) use ($search) {
                return stripos($n['title'], $search) !== false ||
                       stripos($n['summary'], $search) !== false ||
                       stripos($n['category'], $search) !== false ||
                       stripos($n['author'], $search) !== false;
            });
        }

        if ($category = trim($request->input('category', ''))) {
            if ($category !== 'Todas' && $category !== '') {
                $noticias = array_filter($noticias, fn($n) => strcasecmp($n['category'], $category) === 0);
            }
        }

        if ($status = trim($request->input('status', ''))) {
            if ($status !== 'Todos' && $status !== '') {
                $noticias = array_filter($noticias, fn($n) => strcasecmp($n['status'], $status) === 0);
            }
        }

        $allNoticias = $this->getAllNoticias();
        $totalNoticias = count($allNoticias);
        $excludedStatuses = ['BORRADOR', 'EXPIRADA', 'CERRADA', 'INACTIVA', 'ARCHIVADA'];
        $totalPublicadas = count(array_filter($allNoticias, fn($n) => !in_array(strtoupper(trim($n['status'] ?? 'PUBLICADA')), $excludedStatuses)));
        $totalDestacadas = count(array_filter($allNoticias, fn($n) => strtoupper(trim($n['status'] ?? '')) === 'DESTACADA'));
        $totalLecturas = array_sum(array_column($allNoticias, 'views_count'));

        [$categories, $statuses] = $this->buildFilterOptions($allNoticias);

        return view('egresados::superadmin.noticias.index', [
            'noticias' => array_values($noticias),
            'totalNoticias' => $totalNoticias,
            'totalPublicadas' => $totalPublicadas,
            'totalDestacadas' => $totalDestacadas,
            'totalLecturas' => $totalLecturas,
            'categories' => $categories,
            'statuses' => $statuses,
            'filterSearch' => $search ?? '',
            'filterCategory' => $category ?? '',
            'filterStatus' => $status ?? '',
        ]);
    }

    /**
     * Resuelve colores e ícono institucional según la categoría escrita.
     */
    private function resolveCategoryMeta(string $category): array
    {
        $key = mb_strtolower(trim($category), 'UTF-8');
        $map = [
            'convocatorias' => ['pill' => 'status-green', 'icon' => 'fa-solid fa-bullhorn', 'bg' => '#EAF7EE', 'color' => '#39A900'],
            'empleabilidad' => ['pill' => 'status-blue',  'icon' => 'fa-solid fa-briefcase', 'bg' => '#EEF4FF', 'color' => '#2563EB'],
            'capacitación'  => ['pill' => 'status-amber', 'icon' => 'fa-solid fa-certificate', 'bg' => '#FEF3C7', 'color' => '#D97706'],
            'capacitacion'  => ['pill' => 'status-amber', 'icon' => 'fa-solid fa-certificate', 'bg' => '#FEF3C7', 'color' => '#D97706'],
            'institucional' => ['pill' => 'status-green', 'icon' => 'fa-solid fa-building-columns', 'bg' => '#E0F2FE', 'color' => '#0284C7'],
            'comunidad'     => ['pill' => 'status-blue',  'icon' => 'fa-solid fa-users-rays', 'bg' => '#F3E8FF', 'color' => '#9333EA'],
        ];

        return $map[$key] ?? ['pill' => 'status-green', 'icon' => 'fa-solid fa-newspaper', 'bg' => '#EAF7EE', 'color' => '#39A900'];
    }

    /**
     * Resuelve el estilo visual del estado de publicación.
     */
    private function resolveStatusPill(string $status): string
    {
        $key = strtoupper(trim($status));
        if (str_contains($key, 'DESTACAD') || str_contains($key, 'PRIORIDAD')) {
            return 'status-blue';
        }
        if (str_contains($key, 'BORRADOR') || str_contains($key, 'PENDIENTE') || str_contains($key, 'EXPIRAD') || str_contains($key, 'CERRAD')) {
            return 'status-amber';
        }
        return 'status-green';
    }

    /**
     * Combina categorías y estados predeterminados con valores personalizados registrados.
     */
    private function buildFilterOptions(array $allNoticias): array
    {
        $defaultCats = ['Convocatorias', 'Empleabilidad', 'Capacitación', 'Institucional', 'Comunidad'];
        $defaultStatuses = ['PUBLICADA', 'DESTACADA', 'BORRADOR', 'EXPIRADA'];

        $extraCats = array_values(array_filter(array_map(fn($n) => trim((string)($n['category'] ?? '')), $allNoticias)));
        $extraStatuses = array_values(array_filter(array_map(fn($n) => trim((string)($n['status'] ?? '')), $allNoticias)));

        $categories = array_values(array_unique(array_merge($defaultCats, $extraCats)));
        $statuses = array_values(array_unique(array_merge($defaultStatuses, $extraStatuses)));

        return [$categories, $statuses];
    }

    /**
     * Crear una nueva noticia desde Superadmin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|string|max:100',
            'target' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'fecha_vigencia' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $cat = trim($validated['category']);
        $status = trim($validated['status']);
        $catMeta = $this->resolveCategoryMeta($cat);

        $uploadedImage = $this->processUploadedImage($request);

        $fechaVigencia = null;
        if (!empty($validated['fecha_vigencia'])) {
            try {
                $fechaVigencia = \Carbon\Carbon::parse($validated['fecha_vigencia'])->format('d/m/Y');
            } catch (\Throwable $e) {
                $fechaVigencia = trim($validated['fecha_vigencia']);
            }
        } else {
            $fechaVigencia = \Carbon\Carbon::now()->addDays(30)->format('d/m/Y');
        }

        $newNoticia = [
            'id' => 'NOT-' . str_pad((count($this->getAllNoticias()) + 1), 3, '0', STR_PAD_LEFT),
            'title' => $validated['title'],
            'category' => $cat,
            'category_pill' => $catMeta['pill'],
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'author' => !empty($validated['author']) ? $validated['author'] : (auth()->check() ? (auth()->user()->name ?? 'Administración CEFA') : 'Super Administrador SIGE'),
            'author_role' => 'Administración CEFA La Angostura',
            'date' => Carbon::now()->locale('es')->isoFormat('D MMM Y'),
            'fecha_vigencia' => $fechaVigencia,
            'status' => $status,
            'status_pill' => $this->resolveStatusPill($status),
            'views_count' => 1,
            'target' => !empty($validated['target']) ? $validated['target'] : 'Todos los Egresados CEFA',
            'icon' => $catMeta['icon'],
            'icon_bg' => $catMeta['bg'],
            'icon_color' => $catMeta['color'],
            'image' => $uploadedImage ?: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&auto=format&fit=crop&q=80',
        ];

        $this->saveNoticiaInSession($newNoticia);

        return redirect()->route('egresados.noticias')
            ->with('success', '¡Noticia institucional "' . $newNoticia['title'] . '" publicada con éxito!');
    }

    /**
     * Actualizar una noticia existente.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|string|max:100',
            'target' => 'nullable|string|max:255',
            'fecha_vigencia' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $noticias = $this->getAllNoticias();
        $targetNoticia = null;

        foreach ($noticias as $n) {
            if ($n['id'] === $id) {
                $targetNoticia = $n;
                break;
            }
        }

        if (!$targetNoticia) {
            return redirect()->back()->with('error', 'La noticia especificada no fue encontrada.');
        }

        $cat = trim($validated['category']);
        $status = trim($validated['status']);
        $catMeta = $this->resolveCategoryMeta($cat);

        $targetNoticia['title'] = $validated['title'];
        $targetNoticia['category'] = $cat;
        $targetNoticia['category_pill'] = $catMeta['pill'];
        $targetNoticia['icon'] = $catMeta['icon'];
        $targetNoticia['icon_bg'] = $catMeta['bg'];
        $targetNoticia['icon_color'] = $catMeta['color'];
        $targetNoticia['summary'] = $validated['summary'];
        $targetNoticia['content'] = $validated['content'];
        $targetNoticia['status'] = $status;
        $targetNoticia['status_pill'] = $this->resolveStatusPill($status);
        if (!empty($validated['target'])) {
            $targetNoticia['target'] = $validated['target'];
        }

        if (!empty($validated['fecha_vigencia'])) {
            try {
                $targetNoticia['fecha_vigencia'] = \Carbon\Carbon::parse($validated['fecha_vigencia'])->format('d/m/Y');
            } catch (\Throwable $e) {
                $targetNoticia['fecha_vigencia'] = trim($validated['fecha_vigencia']);
            }
        }

        if ($uploadedImage = $this->processUploadedImage($request)) {
            $targetNoticia['image'] = $uploadedImage;
        }

        $this->saveNoticiaInSession($targetNoticia);

        return redirect()->route('egresados.noticias')
            ->with('success', 'Noticia "' . $targetNoticia['title'] . '" actualizada correctamente.');
    }

    /**
     * Alternar estado de publicación de la noticia.
     */
    public function toggleStatus(string $id)
    {
        $noticias = $this->getAllNoticias();
        $target = null;

        foreach ($noticias as $n) {
            if ($n['id'] === $id) {
                $target = $n;
                break;
            }
        }

        if ($target) {
            $target['status'] = ($target['status'] === 'BORRADOR') ? 'PUBLICADA' : 'BORRADOR';
            $target['status_pill'] = ($target['status'] === 'PUBLICADA') ? 'status-green' : 'status-amber';
            $this->saveNoticiaInSession($target);

            return redirect()->back()->with('success', 'Estado de la noticia cambiado a ' . $target['status']);
        }

        return redirect()->back()->with('error', 'Noticia no encontrada.');
    }

    /**
     * Eliminar noticia de sesión y archivo persistente.
     */
    public function destroy(string $id)
    {
        self::deleteNoticiaCustom($id);

        return redirect()->back()->with('success', '¡Noticia eliminada exitosamente!');
    }

    /**
     * Vista de Noticias para Instructor.
     */
    public function instructorIndex(Request $request)
    {
        $noticias = $this->getAllNoticias();

        if ($search = trim($request->input('search', ''))) {
            $noticias = array_filter($noticias, function ($n) use ($search) {
                return stripos($n['title'], $search) !== false ||
                       stripos($n['summary'], $search) !== false ||
                       stripos($n['category'], $search) !== false;
            });
        }

        if ($category = trim($request->input('category', ''))) {
            if ($category !== 'Todas' && $category !== '') {
                $noticias = array_filter($noticias, fn($n) => strcasecmp($n['category'], $category) === 0);
            }
        }

        if ($status = trim($request->input('status', ''))) {
            if ($status !== 'Todos' && $status !== '') {
                $noticias = array_filter($noticias, fn($n) => strcasecmp($n['status'], $status) === 0);
            }
        }

        $allNoticias = self::getAllNoticias();
        $totalNoticias = count($allNoticias);
        $excludedStatuses = ['BORRADOR', 'EXPIRADA', 'CERRADA', 'INACTIVA', 'ARCHIVADA'];
        $totalPublicadas = count(array_filter($allNoticias, fn($n) => !in_array(strtoupper(trim($n['status'] ?? 'PUBLICADA')), $excludedStatuses)));
        $totalDestacadas = count(array_filter($allNoticias, fn($n) => strtoupper(trim($n['status'] ?? '')) === 'DESTACADA'));
        $totalLecturas = array_sum(array_column($allNoticias, 'views_count'));

        [$categories, $statuses] = $this->buildFilterOptions($allNoticias);

        return view('egresados::instructor.noticias.index', [
            'noticias' => array_values($noticias),
            'totalNoticias' => $totalNoticias,
            'totalPublicadas' => $totalPublicadas,
            'totalDestacadas' => $totalDestacadas,
            'totalLecturas' => $totalLecturas,
            'categories' => $categories,
            'statuses' => $statuses,
            'filterSearch' => $search ?? '',
            'filterCategory' => $category ?? '',
            'filterStatus' => $status ?? '',
        ]);
    }

    /**
     * Publicar comunicado/noticia desde Instructor.
     */
    public function instructorStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'nullable|string|max:100',
            'target' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'fecha_vigencia' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $cat = trim($validated['category']);
        $catMeta = $this->resolveCategoryMeta($cat);

        $defaultAuthor = auth()->check() ? (auth()->user()->name ?? 'Instructor CEFA') : 'Carlos Mendoza';
        $author = !empty($validated['author']) ? $validated['author'] : $defaultAuthor;
        $status = !empty($validated['status']) ? trim($validated['status']) : 'PUBLICADA';

        $uploadedImage = $this->processUploadedImage($request);

        $fechaVigencia = null;
        if (!empty($validated['fecha_vigencia'])) {
            try {
                $fechaVigencia = \Carbon\Carbon::parse($validated['fecha_vigencia'])->format('d/m/Y');
            } catch (\Throwable $e) {
                $fechaVigencia = trim($validated['fecha_vigencia']);
            }
        } else {
            $fechaVigencia = \Carbon\Carbon::now()->addDays(30)->format('d/m/Y');
        }

        $newNoticia = [
            'id' => 'NOT-' . str_pad((count(self::getAllNoticias()) + 1), 3, '0', STR_PAD_LEFT),
            'title' => $validated['title'],
            'category' => $cat,
            'category_pill' => $catMeta['pill'],
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'author' => $author,
            'author_role' => 'Instructor / Seguimiento a Egresados',
            'date' => Carbon::now()->locale('es')->isoFormat('D MMM Y'),
            'fecha_vigencia' => $fechaVigencia,
            'status' => $status,
            'status_pill' => $this->resolveStatusPill($status),
            'views_count' => 1,
            'target' => !empty($validated['target']) ? $validated['target'] : 'Fichas Asignadas del Instructor',
            'icon' => $catMeta['icon'],
            'icon_bg' => $catMeta['bg'],
            'icon_color' => $catMeta['color'],
            'image' => $uploadedImage ?: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80',
        ];

        self::saveNoticiaCustom($newNoticia);

        return redirect()->route('egresados.instructor.noticias.index')
            ->with('success', '¡Noticia publicada con éxito para tus aprendices y egresados!');
    }

    /**
     * Actualizar noticia desde panel Instructor.
     */
    public function instructorUpdate(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|string|max:100',
            'target' => 'nullable|string|max:255',
            'fecha_vigencia' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $noticias = self::getAllNoticias();
        $targetNoticia = null;

        foreach ($noticias as $n) {
            if ($n['id'] === $id) {
                $targetNoticia = $n;
                break;
            }
        }

        if (!$targetNoticia) {
            return redirect()->back()->with('error', 'La noticia especificada no fue encontrada.');
        }

        $cat = trim($validated['category']);
        $status = trim($validated['status']);
        $catMeta = $this->resolveCategoryMeta($cat);

        $targetNoticia['title'] = $validated['title'];
        $targetNoticia['category'] = $cat;
        $targetNoticia['category_pill'] = $catMeta['pill'];
        $targetNoticia['icon'] = $catMeta['icon'];
        $targetNoticia['icon_bg'] = $catMeta['bg'];
        $targetNoticia['icon_color'] = $catMeta['color'];
        $targetNoticia['summary'] = $validated['summary'];
        $targetNoticia['content'] = $validated['content'];
        $targetNoticia['status'] = $status;
        $targetNoticia['status_pill'] = $this->resolveStatusPill($status);
        if (!empty($validated['target'])) {
            $targetNoticia['target'] = $validated['target'];
        }

        if (!empty($validated['fecha_vigencia'])) {
            try {
                $targetNoticia['fecha_vigencia'] = \Carbon\Carbon::parse($validated['fecha_vigencia'])->format('d/m/Y');
            } catch (\Throwable $e) {
                $targetNoticia['fecha_vigencia'] = trim($validated['fecha_vigencia']);
            }
        }

        if ($uploadedImage = $this->processUploadedImage($request)) {
            $targetNoticia['image'] = $uploadedImage;
        }

        self::saveNoticiaCustom($targetNoticia);

        return redirect()->route('egresados.instructor.noticias.index')
            ->with('success', 'Noticia "' . $targetNoticia['title'] . '" actualizada correctamente.');
    }

    /**
     * Alternar estado de publicación desde panel Instructor.
     */
    public function instructorToggleStatus(string $id)
    {
        $noticias = self::getAllNoticias();
        $target = null;

        foreach ($noticias as $n) {
            if ($n['id'] === $id) {
                $target = $n;
                break;
            }
        }

        if ($target) {
            $target['status'] = ($target['status'] === 'BORRADOR') ? 'PUBLICADA' : 'BORRADOR';
            $target['status_pill'] = ($target['status'] === 'PUBLICADA') ? 'status-green' : 'status-amber';
            self::saveNoticiaCustom($target);

            return redirect()->back()->with('success', 'Estado de la noticia cambiado a ' . $target['status']);
        }

        return redirect()->back()->with('error', 'Noticia no encontrada.');
    }

    /**
     * Eliminar noticia desde panel Instructor.
     */
    public function instructorDestroy(string $id)
    {
        self::deleteNoticiaCustom($id);

        return redirect()->back()->with('success', '¡Noticia eliminada exitosamente!');
    }
}
