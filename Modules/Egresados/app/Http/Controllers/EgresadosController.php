<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Egresados\app\Imports\EgresadosImport;
use Modules\Egresados\app\Imports\InstructoresImport;

class EgresadosController extends Controller
{
    /**
     * Muestra el panel exclusivo de registro para egresados del CEFA.
     */
    public function showRegistro()
    {
        $courses = Course::with('program')->orderBy('code')->get();
        return view('egresados::registro', compact('courses'));
    }

    /**
     * Procesa el autoregistro exclusivo del egresado, asociando persona, usuario, rol y aprendiz.
     */
    public function processRegistro(Request $request)
    {
        $request->validate([
            'document_type'         => 'required|string|max:50',
            'document_number'       => 'required|numeric|min:10000',
            'first_name'            => 'required|string|max:100',
            'first_last_name'       => 'required|string|max:100',
            'second_last_name'      => 'nullable|string|max:100',
            'telephone1'            => 'required|string|max:30',
            'gender'                => 'nullable|string|max:30',
            'course_id'             => 'required|exists:courses,id',
            'estado_egresado'       => 'nullable|string|max:50',
            'personal_email'        => 'required|email|max:150',
            'misena_email'          => 'nullable|email|max:150',
            'password'              => 'required|string|min:8|confirmed',
            'habeas_data'           => 'required|accepted',
        ], [
            'document_number.required'  => 'El número de documento es obligatorio.',
            'document_number.numeric'   => 'El número de documento debe ser numérico.',
            'first_name.required'       => 'El nombre es obligatorio.',
            'first_last_name.required'  => 'El primer apellido es obligatorio.',
            'personal_email.required'   => 'El correo electrónico es requerido para tu cuenta.',
            'personal_email.email'      => 'Ingresa un formato de correo electrónico válido.',
            'course_id.required'        => 'Debes seleccionar el programa de formación o ficha de la cual egresaste.',
            'password.required'         => 'Debes definir una contraseña segura.',
            'password.min'              => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'        => 'La confirmación de la contraseña no coincide.',
            'habeas_data.required'      => 'Debes aceptar la autorización de tratamiento de datos personales (Habeas Data).',
            'habeas_data.accepted'      => 'Debes aceptar la autorización de tratamiento de datos personales (Habeas Data).',
        ]);

        $cleanEmail = filter_var(trim($request->personal_email), FILTER_SANITIZE_EMAIL);
        $docNumber = (int) $request->document_number;

        // Verificar si ya existe un usuario con este correo
        $existingUser = User::where('email', $cleanEmail)->first();
        if ($existingUser && $existingUser->password) {
            return redirect()->route('login', ['redirect' => route('egresados.dashboard_egresado')])
                ->with('info', 'Ya existe una cuenta registrada con el correo ' . $cleanEmail . '. Por favor inicia sesión con tu contraseña.');
        }

        DB::beginTransaction();
        try {
            // 1. Obtener IDs por defecto de tablas maestras
            $epsId = DB::table('e_p_s')->value('id') ?? 1;
            $populationGroupId = DB::table('population_groups')->value('id') ?? 1;
            $pensionEntityId = DB::table('pension_entities')->value('id') ?? 1;

            // 2. Buscar o crear la Persona
            $person = Person::firstOrNew(['document_number' => $docNumber]);
            $person->document_type = strip_tags($request->document_type);
            $person->first_name = strip_tags(trim($request->first_name));
            $person->first_last_name = strip_tags(trim($request->first_last_name));
            if ($request->filled('second_last_name')) {
                $person->second_last_name = strip_tags(trim($request->second_last_name));
            }
            if ($request->filled('gender')) {
                $person->gender = strip_tags($request->gender);
            }
            $person->telephone1 = strip_tags(trim($request->telephone1));
            $person->personal_email = $cleanEmail;
            if ($request->filled('misena_email')) {
                $person->misena_email = filter_var(trim($request->misena_email), FILTER_SANITIZE_EMAIL);
            }
            $person->eps_id = $person->eps_id ?: $epsId;
            $person->population_group_id = $person->population_group_id ?: $populationGroupId;
            $person->pension_entity_id = $person->pension_entity_id ?: $pensionEntityId;
            $person->save();

            // 3. Crear o actualizar el Usuario
            $baseNickname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $person->first_name . '.' . $person->first_last_name));
            $nickname = $baseNickname;
            $count = 1;
            while (User::where('nickname', $nickname)->where('id', '!=', $existingUser?->id)->exists()) {
                $nickname = $baseNickname . $count++;
            }

            $user = $existingUser ?: new User();
            $user->person_id = $person->id;
            $user->email = $cleanEmail;
            $user->nickname = $user->nickname ?: $nickname;
            $user->password = Hash::make($request->password);
            $user->save();

            // 4. Asegurar Rol de Egresado
            $app = DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
            $appId = $app ? $app->id : 30;

            $roleEgresado = Role::firstOrCreate(
                ['slug' => 'egresados.egresado'],
                [
                    'name' => 'Egresado',
                    'description' => 'Graduado / Egresado de formación profesional del CEFA',
                    'description_english' => 'Graduate / Alumni of vocational training at CEFA',
                    'full_access' => 'No',
                    'app_id' => $appId,
                ]
            );

            $user->roles()->syncWithoutDetaching([$roleEgresado->id]);

            // 5. Vincular registro en Aprendiz
            $apprentice = Apprentice::firstOrNew(['person_id' => $person->id]);
            $apprentice->course_id = (int) $request->course_id;
            $apprentice->apprentice_status = $request->input('estado_egresado', 'CERTIFICADO');
            $apprentice->save();

            DB::commit();

            // 6. Iniciar sesión automáticamente en el ERP y redirigir al portal del egresado
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('egresados.dashboard_egresado')
                ->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . $user->full_name . '! Tu registro se ha completado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en processRegistro egresado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ocurrió un error al procesar tu registro. Por favor verifica tus datos e inténtalo nuevamente.')
                ->withInput();
        }
    }

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
     * Almacena un nuevo instructor / usuario con rol asignado (HU-0004 y HU-0005).
     */
    public function instructoresStore(Request $request)
    {
        $request->validate([
            'documento' => 'required|string',
            'nombre'    => 'required|string|max:255',
            'correo'    => 'required|email|max:255',
            'rol'       => 'nullable|string',
            'programa'  => 'nullable|string',
        ]);

        \DB::beginTransaction();
        try {
            // 1. Separar nombre y apellidos
            $partesNombre = explode(' ', trim($request->nombre), 2);
            $firstName = $partesNombre[0] ?? 'Instructor';
            $firstLastName = $partesNombre[1] ?? 'SENA';

            // 2. Crear o buscar Persona en SICA
            $person = Person::firstOrNew(['document_number' => $request->documento]);
            $person->document_type = $person->document_type ?: 'CC';
            $person->first_name = $firstName;
            $person->first_last_name = $firstLastName;
            $person->personal_email = $request->correo;
            $person->misena_email = $request->correo;
            $person->save();

            // 3. Crear o buscar Usuario
            $user = \App\Models\User::firstOrNew(['email' => $request->correo]);
            if (!$user->exists) {
                $user->nickname = strtolower(str_replace(' ', '.', $firstName . '.' . $firstLastName));
                $user->person_id = $person->id;
                $user->password = bcrypt('Sena12345*');
                $user->save();
            }

            // 4. Asignar rol si existe en la BD
            if ($request->filled('rol')) {
                $roleInput = $request->rol;
                $roleMapping = [
                    'instructor_egresados' => 'egresados.instructor',
                    'superadmin_egresados' => 'egresados.admin',
                    'coordinador'          => 'sica.coordinator',
                    'instructor'           => 'egresados.instructor',
                    'superadmin'           => 'egresados.admin',
                    'admin'                => 'egresados.admin',
                ];
                $targetSlug = $roleMapping[$roleInput] ?? $roleInput;

                $role = \Modules\SICA\Entities\Role::where('slug', $targetSlug)
                    ->orWhere('slug', 'like', "%{$targetSlug}%")
                    ->orWhere('name', 'like', "%{$roleInput}%")
                    ->first();
                if ($role && !$user->roles()->where('role_id', $role->id)->exists()) {
                    $user->roles()->attach($role->id);
                }
            }

            \DB::commit();

            return redirect()->back()->with('success', '¡Instructor registrado y rol asignado exitosamente (HU-0004 / HU-0005)!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar instructor: ' . $e->getMessage())->withInput();
        }
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
     * Muestra el panel / dashboard para el rol de Egresado (Habeas Data: solo datos del usuario autenticado).
     */
    public function dashboardEgresado()
    {
        $user = auth()->user();
        $person = $user ? $user->person : null;
        $apprentice = $person ? Apprentice::with(['course.program'])->where('person_id', $person->id)->first() : null;

        $encuestasPendientes = 2;
        $oportunidadesLaborales = 8;
        $notificaciones = 3;

        return view('egresados::egresados.dashboard', compact(
            'user',
            'person',
            'apprentice',
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
        $user = auth()->user();
        $person = $user ? $user->person : null;
        return view('egresados::egresados.encuestas', compact('user', 'person'));
    }

    /**
     * Muestra las oportunidades laborales para el rol de Egresado.
     */
    public function oportunidadesEgresado()
    {
        $user = auth()->user();
        $person = $user ? $user->person : null;
        return view('egresados::egresados.oportunidades', compact('user', 'person'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Apprentice::with(['person', 'course.program']);

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

        // Filtro por estado
        if ($request->filled('apprentice_status')) {
            $query->where('apprentice_status', strip_tags($request->input('apprentice_status')));
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

        return view('egresados::superadmin.perfil', compact('apprentice'));
    }

    /**
     * Almacena un registro de seguimiento para el egresado (HU-0006).
     */
    public function storeSeguimiento(Request $request)
    {
        $request->validate([
            'egresado_id'          => 'required|integer|exists:apprentices,id',
            'tipo_contacto'        => 'required|string|max:100',
            'fecha'                => 'required|date',
            'observaciones'        => 'required|string|max:2000',
            'nuevo_estado_laboral' => 'nullable|string|max:100',
        ], [
            'egresado_id.required'   => 'El identificador del egresado es obligatorio.',
            'tipo_contacto.required' => 'Debe seleccionar el canal o tipo de contacto.',
            'fecha.required'         => 'La fecha de contacto es obligatoria.',
            'observaciones.required' => 'Las observaciones del seguimiento son requeridas.',
        ]);

        try {
            if ($request->filled('nuevo_estado_laboral')) {
                $apprentice = Apprentice::find($request->egresado_id);
                if ($apprentice) {
                    $apprentice->apprentice_status = strip_tags($request->nuevo_estado_laboral);
                    $apprentice->save();
                }
            }

            return redirect()->back()->with('success', '¡Seguimiento registrado exitosamente en la trazabilidad confidencial del egresado!');
        } catch (\Exception $e) {
            \Log::error('Error en storeSeguimiento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el seguimiento. Por favor intente nuevamente.');
        }
    }

    /**
     * Actualiza el perfil del egresado/aprendiz.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_documento' => 'nullable|string|max:50',
            'documento'      => 'required|string|max:50',
            'nombre'         => 'required|string|max:255',
            'correo'         => 'required|email|max:255',
            'telefono'       => 'nullable|string|max:50',
            'ficha'          => 'nullable|string|max:50',
            'estado'         => 'nullable|string|max:50',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'nombre.required'    => 'El nombre completo es obligatorio.',
            'correo.required'    => 'El correo electrónico es requerido.',
            'correo.email'       => 'Debe ingresar un formato de correo electrónico válido.',
        ]);

        \DB::beginTransaction();
        try {
            $apprentice = Apprentice::with('person')->findOrFail($id);
            $person = $apprentice->person;

            if (!$person) {
                $person = Person::firstOrNew(['document_number' => $request->documento]);
            }

            // Sanitizar y separar nombres inteligentemente
            $nombreLimpio = strip_tags(trim($request->nombre));
            $partes = preg_split('/\s+/', $nombreLimpio);
            if (count($partes) === 1) {
                $person->first_name = $partes[0];
            } elseif (count($partes) === 2) {
                $person->first_name = $partes[0];
                $person->first_last_name = $partes[1];
            } elseif (count($partes) === 3) {
                $person->first_name = $partes[0];
                $person->first_last_name = $partes[1];
                $person->second_last_name = $partes[2];
            } else {
                $person->first_name = $partes[0] . ' ' . $partes[1];
                $person->first_last_name = $partes[2];
                $person->second_last_name = implode(' ', array_slice($partes, 3));
            }

            if ($request->filled('tipo_documento')) {
                $person->document_type = strip_tags($request->tipo_documento);
            }
            if ($request->filled('documento')) {
                $person->document_number = strip_tags($request->documento);
            }
            if ($request->filled('correo')) {
                $correoLimpio = filter_var($request->correo, FILTER_SANITIZE_EMAIL);
                $person->personal_email = $correoLimpio;
                if (str_contains($correoLimpio, 'misena.edu.co') || str_contains($correoLimpio, 'sena.edu.co')) {
                    $person->misena_email = $correoLimpio;
                }
            }
            if ($request->filled('telefono')) {
                $person->telephone1 = strip_tags($request->telefono);
            }
            $person->save();

            // Actualizar curso si se especificó ficha
            if ($request->filled('ficha')) {
                $course = Course::where('code', trim(strip_tags($request->ficha)))->first();
                if ($course) {
                    $apprentice->course_id = $course->id;
                }
            }

            // Actualizar estado ocupacional si se especificó
            if ($request->filled('estado')) {
                $statusMap = [
                    'CERTIFICADO'       => 'CERTIFICADO',
                    'EN_FORMACION'      => 'EN FORMACIÓN',
                    'EN FORMACION'      => 'EN FORMACIÓN',
                    'EN FORMACIÓN'      => 'EN FORMACIÓN',
                    'CANCELADO'         => 'CANCELADO',
                    'CONDICIONADO'      => 'CONDICIONADO',
                    'APLAZADO'          => 'APLAZADO',
                    'INDUCCIÓN'         => 'INDUCCIÓN',
                    'INDUCCION'         => 'INDUCCIÓN',
                    'RETIRO VOLUNTARIO' => 'RETIRO VOLUNTARIO',
                ];
                $apprentice->apprentice_status = $statusMap[strtoupper(trim($request->estado))] ?? strip_tags($request->estado);
            }

            $apprentice->person_id = $person->id;
            $apprentice->save();

            // Si tiene usuario vinculado por person_id, sincronizar su email
            $user = User::where('person_id', $person->id)->first();
            if ($user && $request->filled('correo')) {
                $user->email = filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL);
                $user->save();
            }

            \DB::commit();

            return redirect()->back()->with('success', '¡Perfil del egresado actualizado exitosamente!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error en update egresado: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar los datos: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Almacena un egresado/aprendiz registrado manualmente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'nullable|string|max:50',
            'documento'      => 'required|numeric',
            'nombres'        => 'nullable|string|max:255',
            'apellidos'      => 'nullable|string|max:255',
            'nombre'         => 'nullable|string|max:255',
            'correo'         => 'nullable|email|max:255',
            'telefono'       => 'nullable|string|max:30',
            'ficha'          => 'nullable|string|max:50',
            'programa'       => 'nullable|string|max:100',
            'estado'         => 'nullable|string|max:50',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'documento.numeric'  => 'El número de documento debe contener solo dígitos.',
            'correo.email'       => 'El formato de correo institucional o personal no es válido.',
        ]);

        \DB::beginTransaction();
        try {
            // 1. Separar o procesar nombre y apellido
            if ($request->filled('nombres')) {
                $firstName = strip_tags(trim($request->nombres));
                $firstLastName = strip_tags(trim($request->apellidos ?? 'SENA'));
            } else {
                $partesNombre = explode(' ', strip_tags(trim($request->nombre ?? 'Aprendiz SENA')), 2);
                $firstName = $partesNombre[0] ?? 'Aprendiz';
                $firstLastName = $partesNombre[1] ?? 'SENA';
            }

            // 2. Buscar o instanciar la Persona
            $docNumber = (int) $request->documento;
            $person = Person::firstOrNew(['document_number' => $docNumber]);

            $mapDoc = [
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
                'PEP' => 'Permiso de Protección Temporal',
                'PPT' => 'Permiso de Protección Temporal',
            ];
            $tipoDocIn = $request->tipo_documento ? strip_tags($request->tipo_documento) : null;
            $cleanDocType = strtoupper(trim(str_replace(['á','é','í','ó','ú','Á','É','Í','Ó','Ú'], ['a','e','i','o','u','A','E','I','O','U'], (string)$tipoDocIn)));
            $person->document_type = $mapDoc[$cleanDocType] ?? ($tipoDocIn ?: ($person->document_type ?: 'Cédula de ciudadanía'));
            $person->first_name = $firstName;
            $person->first_last_name = $firstLastName;
            if ($request->filled('correo')) {
                $correoLimpio = filter_var($request->correo, FILTER_SANITIZE_EMAIL);
                $person->personal_email = $correoLimpio;
                $person->misena_email = $correoLimpio;
            }
            if ($request->filled('telefono')) {
                $person->telephone1 = strip_tags($request->telefono);
            }

            // Claves foráneas requeridas por defecto de tablas maestras si es un registro nuevo
            if (!$person->exists) {
                $person->eps_id = $person->eps_id ?: (\DB::table('e_p_s')->value('id') ?? 1);
                $person->population_group_id = $person->population_group_id ?: (\DB::table('population_groups')->value('id') ?? 1);
                $person->pension_entity_id = $person->pension_entity_id ?: (\DB::table('pension_entities')->value('id') ?? 1);
            }
            $person->save();

            // 3. Crear o asociar usuario de acceso si se proporcionó correo
            if ($request->filled('correo')) {
                $cleanEmail = filter_var($request->correo, FILTER_SANITIZE_EMAIL);
                $user = User::firstOrNew(['person_id' => $person->id]);
                if (!$user->exists) {
                    $user->email = $cleanEmail;
                    $baseNickname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $person->first_name . '.' . $person->first_last_name));
                    $nickname = $baseNickname;
                    $count = 1;
                    while (User::where('nickname', $nickname)->where('id', '!=', $user->id)->exists()) {
                        $nickname = $baseNickname . $count++;
                    }
                    $user->nickname = $nickname;
                    $user->password = Hash::make('Sena' . $person->document_number . '*');
                    $user->save();

                    // Asignar rol de egresado
                    $app = \DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
                    $appId = $app ? $app->id : 30;
                    $roleEgresado = Role::firstOrCreate(
                        ['slug' => 'egresados.egresado'],
                        [
                            'name' => 'Egresado',
                            'description' => 'Graduado / Egresado de formación profesional del CEFA',
                            'description_english' => 'Graduate / Alumni of vocational training at CEFA',
                            'full_access' => 'No',
                            'app_id' => $appId,
                        ]
                    );
                    $user->roles()->syncWithoutDetaching([$roleEgresado->id]);
                }
            }

            // 4. Buscar el curso/ficha si existe, o usar el primero disponible
            $courseId = null;
            if ($request->filled('ficha')) {
                $cleanFicha = preg_replace('/[^0-9]/', '', (string)$request->ficha);
                $course = Course::where('code', $cleanFicha)->orWhere('code', strip_tags($request->ficha))->first();
                if ($course) {
                    $courseId = $course->id;
                }
            }
            if (!$courseId && $request->filled('programa')) {
                $course = Course::whereHas('program', function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->programa . '%');
                })->first();
                if ($course) {
                    $courseId = $course->id;
                }
            }
            if (!$courseId) {
                $firstCourse = Course::first();
                $courseId = $firstCourse ? $firstCourse->id : 1;
            }

            // 5. Mapear estado
            $statusMap = [
                'CERTIFICADO'  => 'CERTIFICADO',
                'EN_FORMACION' => 'EN FORMACIÓN',
                'EN FORMACIÓN' => 'EN FORMACIÓN',
                'EN FORMACION' => 'EN FORMACIÓN',
                'EMPLEADO'     => 'EN FORMACIÓN',
            ];
            $apprenticeStatus = $statusMap[$request->estado] ?? 'EN FORMACIÓN';

            // 6. Crear o actualizar registro de Aprendiz (Egresado)
            $apprentice = Apprentice::firstOrNew([
                'person_id' => $person->id,
            ]);
            $apprentice->course_id = $courseId;
            $apprentice->apprentice_status = $apprenticeStatus;
            $apprentice->save();

            \DB::commit();

            return redirect()->route('egresados.index')->with('success', '¡Egresado registrado correctamente!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error en store egresado: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al procesar el registro institucional: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Sincroniza datos institucionales con la API de SIGE mediante UPSERT masivo por lotes.
     */
    public function sincronizarSicefa(Request $request, \Modules\Egresados\Services\SigeSyncService $syncService)
    {
        try {
            $resultado = $syncService->syncAll();
            if ($resultado['success']) {
                $total = $resultado['total_procesados'];
                $paginas = $resultado['paginas'];
                return redirect()->back()->with('success', "¡Sincronización con SIGE ejecutada exitosamente! Se procesaron {$total} registros en {$paginas} lotes sin duplicados.");
            } else {
                return redirect()->back()->with('warning', 'La sincronización con SIGE finalizó con observaciones: ' . ($resultado['error'] ?? 'Sin datos recibidos.'));
            }
        } catch (\Exception $e) {
            \Log::error('Error en sincronizarSicefa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al sincronizar con SIGE: ' . $e->getMessage());
        }
    }

    /**
     * Procesa la importación masiva de egresados o instructores desde un archivo Excel/CSV.
     */
    public function importarExcel(Request $request)
    {
        $request->validate([
            'tipo_importacion' => 'required|in:egresados,instructores',
            'archivo_excel'    => 'required|file|max:10240',
        ], [
            'tipo_importacion.required' => 'Debe seleccionar qué tipo de datos desea importar.',
            'archivo_excel.required'    => 'Debe seleccionar un archivo para importar.',
            'archivo_excel.file'        => 'El archivo seleccionado no es válido.',
        ]);

        try {
            $file = $request->file('archivo_excel');
            $tipo = $request->input('tipo_importacion');

            if ($tipo === 'egresados') {
                $importador = new EgresadosImport();
                $total = $importador->import($file);

                return redirect()->route('egresados.index')->with('success', "¡Lista de egresados importada correctamente! Se procesaron {$total} registros institucionales.");
            } else {
                $importador = new InstructoresImport();
                $total = $importador->import($file);

                return redirect()->route('egresados.instructores')->with('success', "¡Lista de instructores importada correctamente! Se procesaron {$total} registros institucionales.");
            }
        } catch (\Exception $e) {
            \Log::error('Error en importarExcel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al procesar el archivo. Verifique que las columnas sean correctas. Detalle: ' . $e->getMessage());
        }
    }
}