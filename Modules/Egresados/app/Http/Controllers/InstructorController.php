<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Program;

class InstructorController extends Controller
{
    /**
     * Muestra el panel principal / dashboard de seguimiento para el rol de Instructor.
     */
    public function dashboard(Request $request)
    {
        $courses = Course::with('program')->get();
        $totalFichas = $courses->count() ?: 6;

        $baseQuery = Apprentice::whereNull('apprentices.deleted_at')
            ->where(function($q) {
                $q->whereExists(function($sub) {
                    $sub->select(DB::raw(1))
                        ->from('people')
                        ->join('users', 'people.id', '=', 'users.person_id')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->whereColumn('people.id', 'apprentices.person_id')
                        ->where('roles.slug', 'egresados.egresado');
                })->orWhere('apprentices.apprentice_status', 'CERTIFICADO');
            });

        $totalEgresados = (clone $baseQuery)->count();
        $totalActivos = $totalEgresados;
        $totalEmpleados = (clone $baseQuery)->where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = (clone $baseQuery)->where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = (clone $baseQuery)->where('apprentice_status', 'EN FORMACIÓN')->count();

        $tasaEmpleo = $totalActivos > 0 ? round(($totalEmpleados / $totalActivos) * 100) : 67;

        $nuevasEnc = session('nuevas_encuestas', []);
        $customEnc = session('custom_encuestas', []);
        $totalEncuestas = 5 + count($nuevasEnc) + count($customEnc);
        $totalEventos = 5;
        $customReports = session('custom_reports', []);
        $totalReportes = 5 + count($customReports);

        $recentEgresados = (clone $baseQuery)
            ->with(['person', 'course.program'])
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        // Métricas reales de egresados por programa de formación
        $programStats = DB::table('programs')
            ->join('courses', 'programs.id', '=', 'courses.program_id')
            ->join('apprentices', 'courses.id', '=', 'apprentices.course_id')
            ->whereNull('apprentices.deleted_at')
            ->where(function($q) {
                $q->whereExists(function($sub) {
                    $sub->select(DB::raw(1))
                        ->from('people')
                        ->join('users', 'people.id', '=', 'users.person_id')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->whereColumn('people.id', 'apprentices.person_id')
                        ->where('roles.slug', 'egresados.egresado');
                })->orWhere('apprentices.apprentice_status', 'CERTIFICADO');
            })
            ->select('programs.name', DB::raw('count(apprentices.id) as total'))
            ->groupBy('programs.id', 'programs.name')
            ->orderByDesc('total')
            ->take(4)
            ->get();

        return view('egresados::instructor.dashboard', compact(
            'courses',
            'totalEgresados',
            'totalFichas',
            'totalActivos',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'tasaEmpleo',
            'totalEncuestas',
            'totalEventos',
            'totalReportes',
            'recentEgresados',
            'programStats'
        ));
    }

    /**
     * Muestra el directorio exclusivo de egresados para el Instructor.
     */
    public function directorio(Request $request)
    {
        // Consulta base: Egresados vinculados a SIGE o con estado CERTIFICADO (incluyendo soft-deleted del módulo para permitir activar/desactivar)
        $query = Apprentice::withTrashed()
            ->with(['person.users.roles', 'course.program'])
            ->where(function($q) {
                $q->whereHas('person.users.roles', function($rq) {
                    $rq->where('slug', 'egresados.egresado');
                })->orWhere('apprentice_status', 'CERTIFICADO');
            });

        // Búsqueda por nombre, apellido o número de documento
        if ($request->filled('search')) {
            $search = trim(strip_tags($request->input('search')));
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('second_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        // Filtro por estado solo si se selecciona uno específico distinto de TODOS
        if ($request->filled('apprentice_status') && $request->input('apprentice_status') !== 'TODOS') {
            $stFilter = $request->input('apprentice_status');
            if ($stFilter === 'ACTIVOS') {
                $query->whereNull('deleted_at')->whereNotIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO']);
            } elseif ($stFilter === 'INACTIVOS') {
                $query->where(function($sub) {
                    $sub->whereNotNull('deleted_at')->orWhereIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO']);
                });
            } else {
                $query->where('apprentice_status', $stFilter);
            }
        } elseif ($request->filled('status')) {
            $query->where('apprentice_status', $request->input('status'));
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        $egresados = $query->orderBy('id', 'desc')->paginate(10);
        $apprentices = $egresados;

        // Estadísticas de egresados de este módulo
        $baseCount = Apprentice::withTrashed()->where(function($q) {
            $q->whereHas('person.users.roles', function($rq) {
                $rq->where('slug', 'egresados.egresado');
            })->orWhere('apprentice_status', 'CERTIFICADO');
        });

        $totalEgresados = (clone $baseCount)->count() ?: 6;
        $totalActivos = (clone $baseCount)->whereNull('deleted_at')->whereNotIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO'])->count() ?: $totalEgresados;
        $totalInactivos = max(0, $totalEgresados - $totalActivos);
        $totalEmpleados = (clone $baseCount)->whereNull('deleted_at')->where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = (clone $baseCount)->whereNull('deleted_at')->where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = (clone $baseCount)->whereNull('deleted_at')->where('apprentice_status', 'EN FORMACIÓN')->count();
        $actualizacionPendiente = 0;
        $seguimientosRealizados = $totalEgresados;
        $alertasEnviadas = 0;

        $courses = Course::with('program')->orderBy('code')->get();
        $programs = Program::orderBy('name')->get();

        return view('egresados::instructor.directorio', compact(
            'egresados',
            'apprentices',
            'courses',
            'programs',
            'totalEgresados',
            'totalInactivos',
            'totalActivos',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'actualizacionPendiente',
            'seguimientosRealizados',
            'alertasEnviadas'
        ));
    }

    /**
     * Muestra la vista principal de Reportes para el Instructor.
     */
    public function reportes(Request $request)
    {
        $totalEgresadosCount = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmpleadosCount = $totalEgresadosCount;
        $totalDesempleadosCount = 0;
        
        $rateValue = $totalEgresadosCount > 0 ? 100 : 0;
        $tasaEmpleabilidad = $rateValue . '%';

        $totalGenerados = session('custom_instructor_reports') ? count(session('custom_instructor_reports')) + 5 : 5;
        $totalEgresados = number_format($totalEgresadosCount, 0, ',', '.');

        $courses = Course::with('program')->orderBy('code')->get();
        $programs = Program::orderBy('name')->get();
        $totalProgramas = $programs->count() ?: 12;
        $totalFormatos = 3;

        // Base de reportes idéntica a SuperAdmin
        $reportesController = app(\Modules\Egresados\Http\Controllers\ReportesController::class);
        $baseReports = $reportesController->getBaseReports($totalEgresadosCount, $totalEmpleadosCount, $totalDesempleadosCount, $tasaEmpleabilidad, $rateValue);

        $customReports = session('custom_instructor_reports', []);
        $reportes = array_merge($customReports, $baseReports);
        $reports = $reportes;

        return view('egresados::instructor.reportes.index', compact(
            'reports',
            'reportes',
            'courses',
            'programs',
            'totalGenerados',
            'totalEgresados',
            'totalProgramas',
            'totalFormatos',
            'tasaEmpleabilidad'
        ));
    }

    /**
     * Guarda un nuevo reporte generado por el Instructor.
     */
    public function storeReporte(Request $request)
    {
        $request->validate([
            'nombre_reporte' => 'required|string|max:150',
            'tipo_reporte' => 'required|string',
            'filtro_programa' => 'nullable|string',
            'filtro_ficha' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'formato_exportacion' => 'required|string|in:EXCEL,PDF,CSV',
            'columnas' => 'nullable|array',
        ], [
            'nombre_reporte.required' => 'El nombre del reporte es obligatorio.',
            'tipo_reporte.required' => 'Debe seleccionar un tipo de reporte u origen de datos.',
            'formato_exportacion.required' => 'Debe seleccionar el formato de exportación.',
        ]);

        $customReports = session('custom_instructor_reports', []);
        $count = count($customReports) + 6;
        $newId = 'REP_' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $columnLabels = [
            'datos_personales' => 'Datos Personales',
            'contacto' => 'Contacto',
            'academico' => 'Info. Académica',
            'laboral' => 'Estado Laboral',
            'seguimientos' => 'Trazabilidad y Seguimientos',
        ];

        $selectedColumns = [];
        if ($request->filled('columnas')) {
            foreach ($request->input('columnas') as $colKey) {
                $selectedColumns[] = $columnLabels[$colKey] ?? ucfirst($colKey);
            }
        } else {
            $selectedColumns = ['Datos Personales', 'Contacto', 'Info. Académica', 'Estado Laboral'];
        }

        $programName = $request->input('filtro_programa', 'Todos');
        if ($programName === 'TODOS' || empty($programName)) {
            $programName = 'Todos los programas';
        }

        $pFilter = $request->input('filtro_programa', 'Todos');
        $fichaName = $request->input('filtro_ficha') ?: 'Todas';
        $periodo = ($request->filled('fecha_inicio') && $request->filled('fecha_fin'))
            ? $request->input('fecha_inicio') . ' al ' . $request->input('fecha_fin')
            : 'Histórico Completo';

        $calcQuery = Apprentice::where(function($q) {
            $q->whereHas('person.users.roles', function($rq) {
                $rq->where('slug', 'egresados.egresado');
            })->orWhere('apprentice_status', 'CERTIFICADO');
        });

        if (!empty($pFilter) && !in_array(strtoupper($pFilter), ['TODOS', 'TODOS LOS PROGRAMAS', 'GENERAL', 'TODAS LAS ESPECIALIDADES'])) {
            $calcQuery->whereHas('course.program', function($q) use ($pFilter) {
                $q->where('name', 'like', "%{$pFilter}%");
            });
        }
        if (!empty($fichaName) && !in_array(strtoupper($fichaName), ['TODAS', 'TODOS', 'TODAS LAS FICHAS'])) {
            $calcQuery->whereHas('course', function($q) use ($fichaName) {
                $q->where('code', 'like', "%{$fichaName}%");
            });
        }

        $realCount = $calcQuery->count();
        if ($realCount === 0) {
            $realCount = Apprentice::where(function($q) {
                $q->whereHas('person.users.roles', function($rq) {
                    $rq->where('slug', 'egresados.egresado');
                })->orWhere('apprentice_status', 'CERTIFICADO');
            })->count() ?: 6;
        }

        $totalCalculado = $realCount;
        $empleadosCalculados = $totalCalculado;
        $desempleadosCalculados = 0;
        $rateVal = 100;

        $newReport = [
            'id' => $newId,
            'title' => $request->input('nombre_reporte'),
            'full_title' => $request->input('nombre_reporte'),
            'date' => date('d/m/Y'),
            'generated_by' => auth()->check() ? (auth()->user()->full_name ?? auth()->user()->name ?? 'Instructor') : 'Instructor',
            'program' => $programName,
            'type' => $request->input('tipo_reporte'),
            'format' => $request->input('formato_exportacion'),
            'status' => 'GENERADO',
            'status_pill' => 'status-green',
            'total_egresados' => $totalCalculado,
            'empleados' => $empleadosCalculados,
            'desempleados' => $desempleadosCalculados,
            'rate' => $rateVal . '%',
            'rate_num' => $rateVal,
            'filters' => [
                'programa' => $programName,
                'ficha' => $fichaName,
                'estado' => 'Configurado según origen ' . $request->input('tipo_reporte'),
                'region' => 'Huila / CEFA',
                'periodo' => $periodo,
            ],
            'columns' => $selectedColumns,
        ];

        array_unshift($customReports, $newReport);
        session(['custom_instructor_reports' => $customReports]);

        return redirect()->route('egresados.instructor.reportes.index')
            ->with('success', '¡El reporte "' . $request->input('nombre_reporte') . '" (' . $newId . ') ha sido configurado y generado exitosamente!');
    }

    /**
     * Exporta el reporte solicitado a formato CSV/Excel.
     */

    /**
     * Exporta el reporte solicitado con formato opcional (Excel, PDF).
     */
    public function exportarReporteFormato(Request $request, $id, $formato = 'excel')
    {
        return app(\Modules\Egresados\Http\Controllers\ReportesController::class)->exportar($request, $id, $formato);
    }

    /**
     * Elimina un reporte generado por el Instructor.
     */
    public function destroyReporte($id)
    {
        $customReports = session('custom_instructor_reports', []);
        $filtered = array_filter($customReports, function ($r) use ($id) {
            return ($r['id'] ?? '') !== $id;
        });
        session(['custom_instructor_reports' => array_values($filtered)]);

        return redirect()->route('egresados.instructor.reportes.index')
            ->with('success', '¡Reporte ' . $id . ' eliminado correctamente!');
    }

    public function exportarReporte(Request $request, $id = null)
    {
        $fileName = 'Reporte_Instructor_' . ($id ?? 'Consolidado') . '_' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
            fputcsv($handle, ['Documento', 'Nombres', 'Apellidos', 'Ficha', 'Programa', 'Estado Laboral', 'Empresa', 'Teléfono', 'Correo']);

            $apprentices = Apprentice::with(['person', 'course.program'])->limit(100)->get();
            foreach ($apprentices as $app) {
                fputcsv($handle, [
                    $app->person->document_number ?? 'N/A',
                    $app->person->first_name ?? 'N/A',
                    $app->person->first_last_name ?? 'N/A',
                    $app->course->code ?? 'N/A',
                    $app->course->program->name ?? 'N/A',
                    $app->apprentice_status ?? 'EGRESADO',
                    'CEFA Aliado',
                    $app->person->telephone1 ?? '3100000000',
                    $app->person->misena_email ?? ($app->person->personal_email ?? 'egresado@sena.edu.co')
                ]);
            }
            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    /**
     * Muestra la vista de Eventos para el Instructor.
     */
    public function eventos(Request $request)
    {
        $totalEventos = 4;
        $totalInscritos = 286;
        $tasaAsistencia = '82%';
        $proximoEventoDias = 6;

        $defaultEventos = [
            [
                'id' => 'EVT-INS-001',
                'title' => 'Encuentro de Egresados Fichas ADSO',
                'type' => 'Encuentro de Ficha',
                'date' => '15/11/2026',
                'time' => '02:00 PM - 05:00 PM',
                'location' => 'Ambiente 102 - CEFA La Angostura',
                'program' => 'ADSO (Análisis y Desarrollo de Software)',
                'responsible' => 'Instructor Técnico',
                'status' => 'PROGRAMADO',
                'status_pill' => 'status-blue',
                'description' => 'Socialización de proyectos productivos, experiencias laborales en empresas de desarrollo y retroalimentación curricular.',
                'cupo' => 60,
                'registrados' => 48,
                'pendientes' => 12,
                'rate' => '80%',
                'rate_num' => 80
            ],
            [
                'id' => 'EVT-INS-002',
                'title' => 'Taller Práctico: Entrevistas Técnicas y Portafolio',
                'type' => 'Taller de Empleabilidad',
                'date' => '28/11/2026',
                'time' => '08:30 AM - 12:30 PM',
                'location' => 'Sala de Cómputo 2 / Virtual Teams',
                'program' => 'ADSO / Multimedia / Redes',
                'responsible' => 'Equipo de Instructores TIC',
                'status' => 'PROGRAMADO',
                'status_pill' => 'status-blue',
                'description' => 'Simulación de entrevistas técnicas, revisión de perfiles de GitHub y LinkedIn con evaluadores invitados.',
                'cupo' => 40,
                'registrados' => 38,
                'pendientes' => 2,
                'rate' => '95%',
                'rate_num' => 95
            ],
            [
                'id' => 'EVT-INS-003',
                'title' => 'Mesa Redonda: Innovación Tecnológica en el Huila',
                'type' => 'Conferencia',
                'date' => '05/12/2026',
                'time' => '09:00 AM - 01:00 PM',
                'location' => 'Auditorio Principal CEFA',
                'program' => 'Todos los programas del Centro',
                'responsible' => 'Coordinación e Instructores',
                'status' => 'EN PREPARACIÓN',
                'status_pill' => 'status-amber',
                'description' => 'Panel con egresados destacados que lideran proyectos agro-tecnológicos y de software en la región.',
                'cupo' => 120,
                'registrados' => 92,
                'pendientes' => 28,
                'rate' => '76%',
                'rate_num' => 76
            ],
            [
                'id' => 'EVT-INS-004',
                'title' => 'Feria de Emprendimiento e Innovación CEFA',
                'type' => 'Feria Institucional',
                'date' => '10/10/2026',
                'time' => '08:00 AM - 04:00 PM',
                'location' => 'Plaza Central CEFA',
                'program' => 'Todos los programas',
                'responsible' => 'Fondo Emprender & SENA CEFA',
                'status' => 'FINALIZADO',
                'status_pill' => 'status-gray',
                'description' => 'Exposición de ideas de negocio e innovaciones desarrolladas por egresados del centro.',
                'cupo' => 150,
                'registrados' => 150,
                'pendientes' => 0,
                'rate' => '100%',
                'rate_num' => 100
            ],
        ];

        $customEventos = session('custom_instructor_eventos', []);
        $eventos = array_merge($customEventos, $defaultEventos);

        $courses = Course::with('program')->orderBy('code')->get();

        return view('egresados::instructor.eventos.index', compact(
            'eventos',
            'courses',
            'totalEventos',
            'totalInscritos',
            'tasaAsistencia',
            'proximoEventoDias'
        ));
    }

    /**
     * Guarda un nuevo evento creado por el Instructor.
     */
    public function storeEvento(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required|string',
            'lugar' => 'required|string',
            'cupo' => 'required|numeric',
        ]);

        $customEventos = session('custom_instructor_eventos', []);
        $count = count($customEventos) + 5;
        $newId = 'EVT-INS-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $nuevo = [
            'id' => $newId,
            'title' => $request->titulo,
            'type' => $request->tipo,
            'date' => date('d/m/Y', strtotime($request->fecha)),
            'time' => $request->hora,
            'location' => $request->lugar,
            'program' => $request->programa ?? 'Fichas Asignadas',
            'responsible' => 'Instructor CEFA',
            'status' => 'PROGRAMADO',
            'status_pill' => 'status-blue',
            'description' => $request->descripcion ?? 'Evento organizado por el instructor de seguimiento.',
            'cupo' => (int)$request->cupo,
            'registrados' => 0,
            'pendientes' => (int)$request->cupo,
            'rate' => '0%',
            'rate_num' => 0
        ];

        array_unshift($customEventos, $nuevo);
        session(['custom_instructor_eventos' => $customEventos]);

        return redirect()->route('egresados.instructor.eventos.index')
            ->with('success', '¡Evento "' . $request->titulo . '" programado exitosamente!');
    }
}
