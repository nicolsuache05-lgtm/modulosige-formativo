<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $totalEgresados = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();

        $query = Apprentice::where('apprentice_status', 'CERTIFICADO')->with(['person', 'course.program']);

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        $egresadosSeguimiento = $query->orderBy('id', 'desc')->paginate(8);

        return view('egresados::instructor.dashboard', compact(
            'courses',
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'egresadosSeguimiento'
        ));
    }

    /**
     * Muestra el directorio exclusivo de egresados para el Instructor.
     */
    public function directorio(Request $request)
    {
        // Métricas de seguimiento para el instructor
        $totalEgresadosCount = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEgresados = $totalEgresadosCount;
        $actualizacionPendiente = 0;
        $seguimientosRealizados = 300;

        // Cursos y programas para filtros
        $courses = Course::with('program')->orderBy('code')->get();
        $programs = Program::orderBy('name')->get();

        // Consulta de egresados con relaciones
        $query = Apprentice::where('apprentice_status', 'CERTIFICADO')->with(['person', 'course.program']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        if ($request->filled('status')) {
            $query->where('apprentice_status', $request->input('status'));
        }

        $apprentices = $query->orderBy('id', 'desc')->paginate(12);

        return view('egresados::instructor.directorio', compact(
            'apprentices',
            'courses',
            'programs',
            'totalEgresados',
            'actualizacionPendiente',
            'seguimientosRealizados'
        ));
    }

    /**
     * Muestra la vista principal de Reportes para el Instructor.
     */
    public function reportes(Request $request)
    {
        $totalEgresadosCount = Apprentice::count() ?: 5634;
        $totalEmpleadosCount = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count() ?: 3799;
        $rateValue = $totalEgresadosCount > 0 ? round(($totalEmpleadosCount / $totalEgresadosCount) * 100) : 67;
        $tasaEmpleabilidad = $rateValue . '%';

        $totalGenerados = session('custom_instructor_reports') ? count(session('custom_instructor_reports')) + 4 : 4;
        $totalEgresados = number_format($totalEgresadosCount, 0, ',', '.');
        $totalEncuestas = 242;
        $seguimientosMes = 85;

        $courses = Course::with('program')->orderBy('code')->get();
        $programs = Program::orderBy('name')->get();

        $defaultReports = [
            [
                'id' => 'REP-INS-001',
                'title' => 'Consolidado Egresados Fichas Asignadas',
                'full_title' => 'Reporte Integral de Seguimiento y Estado Laboral por Ficha',
                'date' => '24/10/2026',
                'type' => 'Seguimiento Fichas',
                'format' => 'EXCEL',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'program' => 'ADSO / Multimedia',
                'total_egresados' => 145,
                'empleados' => 112,
                'pendientes' => 33,
                'rate' => '77%',
                'rate_num' => 77,
            ],
            [
                'id' => 'REP-INS-002',
                'title' => 'Inserción Laboral Sector Productivo',
                'full_title' => 'Diagnóstico de Empleabilidad en Empresas de la Región',
                'date' => '15/10/2026',
                'type' => 'Empleabilidad',
                'format' => 'PDF',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'program' => 'ADSO',
                'total_egresados' => 88,
                'empleados' => 74,
                'pendientes' => 14,
                'rate' => '84%',
                'rate_num' => 84,
            ],
            [
                'id' => 'REP-INS-003',
                'title' => 'Respuestas a Encuesta Inserción 2026',
                'full_title' => 'Informe de Participación y Hallazgos Formativos',
                'date' => '02/10/2026',
                'type' => 'Encuestas',
                'format' => 'EXCEL',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'program' => 'Todos los programas',
                'total_egresados' => 120,
                'empleados' => 90,
                'pendientes' => 30,
                'rate' => '75%',
                'rate_num' => 75,
            ],
            [
                'id' => 'REP-INS-004',
                'title' => 'Egresados con Actualización Pendiente',
                'full_title' => 'Listado de Contacto para Validación de Datos SENA',
                'date' => '18/09/2026',
                'type' => 'Actualización Datos',
                'format' => 'CSV',
                'status' => 'GENERADO',
                'status_pill' => 'status-amber',
                'program' => 'Agroindustria / ADSO',
                'total_egresados' => 56,
                'empleados' => 30,
                'pendientes' => 26,
                'rate' => '53%',
                'rate_num' => 53,
            ]
        ];

        $customReports = session('custom_instructor_reports', []);
        $reports = array_merge($customReports, $defaultReports);

        return view('egresados::instructor.reportes.index', compact(
            'reports',
            'courses',
            'programs',
            'totalGenerados',
            'totalEgresados',
            'tasaEmpleabilidad',
            'totalEncuestas',
            'seguimientosMes'
        ));
    }

    /**
     * Guarda un nuevo reporte generado por el Instructor.
     */
    public function storeReporte(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|string',
            'formato' => 'required|string',
        ]);

        $customReports = session('custom_instructor_reports', []);
        $count = count($customReports) + 5;
        $newId = 'REP-INS-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $nuevo = [
            'id' => $newId,
            'title' => $request->titulo,
            'full_title' => $request->titulo,
            'date' => date('d/m/Y'),
            'type' => $request->tipo,
            'format' => strtoupper($request->formato),
            'status' => 'GENERADO',
            'status_pill' => 'status-green',
            'program' => $request->programa ?? 'Fichas Seleccionadas',
            'total_egresados' => rand(40, 150),
            'empleados' => rand(25, 120),
            'pendientes' => rand(5, 30),
            'rate' => rand(65, 95) . '%',
            'rate_num' => rand(65, 95),
        ];

        array_unshift($customReports, $nuevo);
        session(['custom_instructor_reports' => $customReports]);

        return redirect()->route('egresados.instructor.reportes.index')
            ->with('success', '¡Reporte "' . $request->titulo . '" generado exitosamente!');
    }

    /**
     * Exporta el reporte solicitado a formato CSV/Excel.
     */
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
