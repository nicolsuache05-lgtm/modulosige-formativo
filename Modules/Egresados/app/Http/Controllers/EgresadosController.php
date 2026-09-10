<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;

class EgresadosController extends Controller
{
    /**
     * Muestra la página de bienvenida / portal público de SIGE.
     */
    public function welcome()
    {
        $totalEgresados = Apprentice::count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'CONDICIONADO')->count();

        return view('egresados::welcome', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes'
        ));
    }

    /**
     * Muestra el panel / dashboard principal de superadmin de SIGE.
     */
    public function dashboard()
    {
        $totalEgresados = Apprentice::count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'CONDICIONADO')->count();
        
        $totalActivos = $totalEgresados;
        $tasaEmpleo = 45;

        $recentEgresados = Apprentice::with(['person', 'course.program'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('egresados::superadmin.dashboard', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'totalActivos',
            'tasaEmpleo',
            'recentEgresados'
        ));
    }

    /**
     * Muestra la vista de Gestión de Instructores para el Superadmin.
     */
    public function instructoresIndex(Request $request)
    {
        $query = \App\Models\User::with(['person', 'roles'])
            ->whereHas('roles', function ($q) {
                $q->where('slug', 'like', '%instructor%')
                  ->orWhere('slug', 'like', '%trainer%')
                  ->orWhere('name', 'like', '%instructor%');
            });

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%")
                  ->orWhereHas('person', function ($qp) use ($search) {
                      $qp->where('first_name', 'like', "%{$search}%")
                         ->orWhere('first_last_name', 'like', "%{$search}%")
                         ->orWhere('document_number', 'like', "%{$search}%");
                  });
            });
        }

        $instructores = $query->orderBy('id', 'desc')->paginate(10);

        // Métricas superiores (5 métricas)
        $totalInstructores = \App\Models\User::whereHas('roles', function ($q) {
            $q->where('slug', 'like', '%instructor%')
              ->orWhere('slug', 'like', '%trainer%')
              ->orWhere('name', 'like', '%instructor%');
        })->count() ?: 48;

        $activos = 42;
        $programas = 12;
        $fichasActivas = 36;
        $evaluaciones = 15;

        return view('egresados::superadmin.instructores', compact(
            'instructores',
            'totalInstructores',
            'activos',
            'programas',
            'fichasActivas',
            'evaluaciones'
        ));
    }

    /**
     * Muestra la vista de Gestión de Encuestas para el Superadmin.
     */
    public function encuestasSuperadminIndex(Request $request)
    {
        // 5 Métricas Superiores
        $totalCreadas = 25;
        $totalEnviadas = 320;
        $totalPendientes = 78;
        $totalRespondidas = 242;
        $tasaRespuestaGeneral = '75%';

        // Listado de Encuestas
        $encuestas = [
            [
                'id' => 'ENC-025',
                'title' => 'Inserción Laboral',
                'full_title' => 'Encuesta Inserción Laboral',
                'date' => '12/06/2026',
                'status' => 'ACTIVA',
                'status_pill' => 'status-green',
                'target' => 'Egresado ADSO',
                'enviadas' => 120,
                'respondidas' => 90,
                'pendientes' => 30,
                'rate' => '75%',
                'rate_num' => 75
            ],
            [
                'id' => 'ENC-024',
                'title' => 'Impacto y Empleabilidad 2025',
                'full_title' => 'Seguimiento Impacto Productivo 2025',
                'date' => '05/05/2026',
                'status' => 'ACTIVA',
                'status_pill' => 'status-green',
                'target' => 'Egresados Tecnólogos',
                'enviadas' => 80,
                'respondidas' => 68,
                'pendientes' => 12,
                'rate' => '85%',
                'rate_num' => 85
            ],
            [
                'id' => 'ENC-023',
                'title' => 'Satisfacción Formativa CEFA',
                'full_title' => 'Evaluación de Calidad Formativa CEFA',
                'date' => '20/04/2026',
                'status' => 'ACTIVA',
                'status_pill' => 'status-green',
                'target' => 'Todas las Especialidades',
                'enviadas' => 150,
                'respondidas' => 105,
                'pendientes' => 45,
                'rate' => '70%',
                'rate_num' => 70
            ],
            [
                'id' => 'ENC-022',
                'title' => 'Competencias Blandas e Idiomas',
                'full_title' => 'Diagnóstico de Habilidades y Bilingüismo',
                'date' => '10/03/2026',
                'status' => 'CERRADA',
                'status_pill' => 'status-gray',
                'target' => 'Egresados ADSO / Multimedia',
                'enviadas' => 95,
                'respondidas' => 88,
                'pendientes' => 7,
                'rate' => '92%',
                'rate_num' => 92
            ],
            [
                'id' => 'ENC-021',
                'title' => 'Emprendimiento Fondo Emprender',
                'full_title' => 'Sondeo de Proyectos Productivos',
                'date' => '15/02/2026',
                'status' => 'CERRADA',
                'status_pill' => 'status-gray',
                'target' => 'Egresados Emprendedores',
                'enviadas' => 60,
                'respondidas' => 42,
                'pendientes' => 18,
                'rate' => '70%',
                'rate_num' => 70
            ],
        ];

        return view('egresados::superadmin.encuestas', compact(
            'encuestas',
            'totalCreadas',
            'totalEnviadas',
            'totalPendientes',
            'totalRespondidas',
            'tasaRespuestaGeneral'
        ));
    }

    /**
     * Muestra la vista de Gestión de Reportes para el Superadmin.
     */
    public function reportesSuperadminIndex(Request $request)
    {
        // 5 Métricas Superiores
        $totalGenerados = 245;
        $totalEgresados = '1.250';
        $tasaEmpleabilidad = '78%';
        $totalEncuestas = 890;
        $totalVisitas = '3.420';

        // Listado de Reportes
        $reportes = [
            [
                'id' => 'REP_002',
                'title' => 'Reporte Egresados ADSO',
                'full_title' => 'Reporte de empleabilidad ADSO',
                'date' => '12/06/2026',
                'generated_by' => 'Coordinación Académica',
                'program' => 'ADSO',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'total_egresados' => 350,
                'empleados' => 280,
                'desempleados' => 70,
                'rate' => '80%',
                'rate_num' => 80,
                'filters' => [
                    'programa' => 'ADSO',
                    'ficha' => 'Todas',
                    'estado' => 'Todos',
                    'region' => 'Huila',
                    'periodo' => '01/01/2026 - 12/06/2026'
                ]
            ],
            [
                'id' => 'REP_001',
                'title' => 'Consolidado Empleabilidad CEFA',
                'full_title' => 'Consolidado General de Empleabilidad 2026',
                'date' => '08/06/2026',
                'generated_by' => 'Super Administrador',
                'program' => 'Todas las Especialidades',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'total_egresados' => 1250,
                'empleados' => 975,
                'desempleados' => 275,
                'rate' => '78%',
                'rate_num' => 78,
                'filters' => [
                    'programa' => 'Todos',
                    'ficha' => 'Todas',
                    'estado' => 'Todos',
                    'region' => 'Huila & Regional',
                    'periodo' => '01/01/2026 - 08/06/2026'
                ]
            ],
            [
                'id' => 'REP_003',
                'title' => 'Seguimiento Fichas Agroempresariales',
                'full_title' => 'Seguimiento Fichas de Gestión Agroempresarial',
                'date' => '01/06/2026',
                'generated_by' => 'Instructor Líder',
                'program' => 'Gestión Agroempresarial',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'total_egresados' => 240,
                'empleados' => 196,
                'desempleados' => 44,
                'rate' => '82%',
                'rate_num' => 82,
                'filters' => [
                    'programa' => 'Gestión Agroempresarial',
                    'ficha' => '2694551, 2694552',
                    'estado' => 'Certificado / Empleado',
                    'region' => 'Huila',
                    'periodo' => '01/01/2026 - 01/06/2026'
                ]
            ],
            [
                'id' => 'REP_004',
                'title' => 'Diagnóstico Producción Agrícola',
                'full_title' => 'Diagnóstico Laboral Producción Agrícola',
                'date' => '25/05/2026',
                'generated_by' => 'Coordinación Académica',
                'program' => 'Producción Agrícola',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'total_egresados' => 180,
                'empleados' => 126,
                'desempleados' => 54,
                'rate' => '70%',
                'rate_num' => 70,
                'filters' => [
                    'programa' => 'Producción Agrícola',
                    'ficha' => 'Todas',
                    'estado' => 'Todos',
                    'region' => 'Huila / Campoalegre',
                    'periodo' => '01/01/2026 - 25/05/2026'
                ]
            ],
            [
                'id' => 'REP_005',
                'title' => 'Evaluación de Bilingüismo & TIC',
                'full_title' => 'Informe de Competencias en Lenguas y TIC',
                'date' => '15/05/2026',
                'generated_by' => 'Super Administrador',
                'program' => 'ADSO / Multimedia',
                'status' => 'GENERADO',
                'status_pill' => 'status-green',
                'total_egresados' => 195,
                'empleados' => 165,
                'desempleados' => 30,
                'rate' => '85%',
                'rate_num' => 85,
                'filters' => [
                    'programa' => 'ADSO / Tecnologías',
                    'ficha' => '2712345',
                    'estado' => 'Empleado / Certificado',
                    'region' => 'Huila',
                    'periodo' => '01/01/2026 - 15/05/2026'
                ]
            ],
        ];

        return view('egresados::superadmin.reportes', compact(
            'reportes',
            'totalGenerados',
            'totalEgresados',
            'tasaEmpleabilidad',
            'totalEncuestas',
            'totalVisitas'
        ));
    }

    /**
     * Muestra la vista de Gestión de Eventos para el Superadmin.
     */
    public function eventosSuperadminIndex(Request $request)
    {
        // 5 Métricas Superiores
        $totalProgramados = 12;
        $totalParticipantes = 856;
        $totalRealizados = 8;
        $totalProximos = 4;
        $promedioSatisfaccion = '4.6/5';

        // Listado de Eventos
        $eventos = [
            [
                'id' => 'EVT-012',
                'title' => 'Feria laboral 2026',
                'type' => 'Feria laboral',
                'date' => '20/06/2026',
                'time' => '09:00 AM - 04:00 PM',
                'location' => 'Auditorio Principal',
                'program' => 'ADSO-GAE',
                'responsible' => 'Coordinación Académica',
                'status' => 'PROGRAMADO',
                'status_pill' => 'status-blue',
                'description' => 'Feria laboral dirigida a Egresados para conectar con empresas aliadas y conocer oportunidades de empleo y prácticas profesionales.',
                'cupo' => 200,
                'registrados' => 156,
                'pendientes' => 12,
                'rate' => '78%',
                'rate_num' => 78
            ],
            [
                'id' => 'EVT-011',
                'title' => 'Taller Hoja de Vida & LinkedIn',
                'type' => 'Taller práctico',
                'date' => '15/06/2026',
                'time' => '02:00 PM - 06:00 PM',
                'location' => 'Sala TIC 3',
                'program' => 'Todos los programas',
                'responsible' => 'Agencia Pública de Empleo (APE)',
                'status' => 'PROGRAMADO',
                'status_pill' => 'status-blue',
                'description' => 'Taller intensivo sobre optimización de CV, perfil profesional en LinkedIn y preparación para entrevistas de trabajo en sector TIC y agropecuario.',
                'cupo' => 50,
                'registrados' => 45,
                'pendientes' => 5,
                'rate' => '90%',
                'rate_num' => 90
            ],
            [
                'id' => 'EVT-010',
                'title' => 'Encuentro Egresados Agropecuarios',
                'type' => 'Encuentro institucional',
                'date' => '28/05/2026',
                'time' => '08:30 AM - 01:00 PM',
                'location' => 'Plaza Central CEFA',
                'program' => 'Gestión Agroempresarial',
                'responsible' => 'Coordinación Agropecuaria',
                'status' => 'REALIZADO',
                'status_pill' => 'status-green',
                'description' => 'Espacio de integración y relacionamiento para egresados del área agropecuaria con socialización de proyectos de Fondo Emprender.',
                'cupo' => 180,
                'registrados' => 180,
                'pendientes' => 0,
                'rate' => '100%',
                'rate_num' => 100
            ],
            [
                'id' => 'EVT-009',
                'title' => 'Hackathon TIC & Desarrollo Software',
                'type' => 'Concurso / Reto',
                'date' => '10/05/2026',
                'time' => '08:00 AM - 08:00 PM',
                'location' => 'Laboratorio TIC 1 & 2',
                'program' => 'ADSO',
                'responsible' => 'Instructores TIC',
                'status' => 'REALIZADO',
                'status_pill' => 'status-green',
                'description' => 'Maratón de desarrollo de soluciones tecnológicas aplicadas al campo con premiación para los mejores prototipos funcionales.',
                'cupo' => 100,
                'registrados' => 85,
                'pendientes' => 0,
                'rate' => '85%',
                'rate_num' => 85
            ],
            [
                'id' => 'EVT-008',
                'title' => 'Conferencia: Innovación y Sostenibilidad',
                'type' => 'Conferencia',
                'date' => '22/04/2026',
                'time' => '10:00 AM - 12:30 PM',
                'location' => 'Aula Magna CEFA',
                'program' => 'Producción Agrícola',
                'responsible' => 'Líder de Sennova',
                'status' => 'REALIZADO',
                'status_pill' => 'status-green',
                'description' => 'Conferencia internacional sobre tecnologías de agricultura de precisión y sostenibilidad ambiental en la región del Huila.',
                'cupo' => 150,
                'registrados' => 120,
                'pendientes' => 0,
                'rate' => '80%',
                'rate_num' => 80
            ],
        ];

        return view('egresados::superadmin.eventos', compact(
            'eventos',
            'totalProgramados',
            'totalParticipantes',
            'totalRealizados',
            'totalProximos',
            'promedioSatisfaccion'
        ));
    }

    /**
     * Muestra el panel / dashboard especializado para el rol de Instructor.
     */
    public function dashboardInstructor(Request $request)
    {
        $courses = Course::with('program')->get();
        $totalEgresados = Apprentice::count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'CONDICIONADO')->count();

        $query = Apprentice::with(['person', 'course.program']);

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

        return view('egresados::admin.dashboard', compact(
            'courses',
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'egresadosSeguimiento'
        ));
    }

    /**
     * Muestra el panel / dashboard para el rol de Egresado.
     */
    public function dashboardEgresado()
    {
        // Dummy data for now matching the image
        $encuestasPendientes = 2;
        $oportunidadesLaborales = 8;
        $notificaciones = 3;

        return view('egresados::egresados.dashboard', compact(
            'encuestasPendientes',
            'oportunidadesLaborales',
            'notificaciones'
        ));
    }

    /**
     * Muestra la vista de encuestas para el rol de Egresado.
     */
    public function encuestasEgresado()
    {
        return view('egresados::egresados.encuestas');
    }

    /**
     * Muestra las oportunidades laborales para el rol de Egresado.
     */
    public function oportunidadesEgresado()
    {
        return view('egresados::egresados.oportunidades');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Apprentice::with(['person', 'course.program']);

        // Búsqueda por nombre, apellido o número de documento
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('first_last_name', 'like', "%{$search}%")
                  ->orWhere('second_last_name', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($request->filled('apprentice_status')) {
            $query->where('apprentice_status', $request->input('apprentice_status'));
        }

        $egresados = $query->orderBy('id', 'desc')->paginate(10);

        // Estadísticas rápidas para las tarjetas superiores
        $totalEgresados = Apprentice::count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'CONDICIONADO')->count();
        $actualizacionPendiente = Apprentice::whereIn('apprentice_status', ['CONDICIONADO', 'CANCELADO', 'APLAZADO'])->count() ?: 189;
        $seguimientosRealizados = 300;
        $alertasEnviadas = 243;

        return view('egresados::superadmin.index', compact(
            'egresados',
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'actualizacionPendiente',
            'seguimientosRealizados',
            'alertasEnviadas'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::with('program')->get();
        return view('egresados::create', compact('courses'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $apprentice = Apprentice::with(['person', 'course.program'])->findOrFail($id);
        return view('egresados::show', compact('apprentice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $apprentice = Apprentice::with(['person', 'course.program'])->findOrFail($id);
        return view('egresados::edit', compact('apprentice'));
    }
}

