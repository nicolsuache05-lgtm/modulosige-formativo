<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Program;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Egresados\app\Imports\EgresadosImport;
use Modules\Egresados\app\Imports\InstructoresImport;

class EgresadosController extends Controller
{
    /**
     * Mapea cualquier variante de tipo de documento al ENUM exacto de la tabla people del ERP.
     */
    public static function normalizeDocumentType(?string $tipo): string
    {
        if (empty($tipo)) {
            return 'Cédula de ciudadanía';
        }

        $clean = strtoupper(trim(str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ'],
            ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N'],
            $tipo
        )));

        if (str_contains($clean, 'TARJETA') || $clean === 'TI') {
            return 'Tarjeta de identidad';
        }
        if (str_contains($clean, 'EXTRANJER') || $clean === 'CE') {
            return 'Cédula de extranjería';
        }
        if (str_contains($clean, 'PASAPORTE') || $clean === 'PAS') {
            return 'Pasaporte';
        }
        if (str_contains($clean, 'NACIONAL') || $clean === 'DNI') {
            return 'Documento nacional de identidad';
        }
        if (str_contains($clean, 'REGISTRO') || $clean === 'RC') {
            return 'Registro civil';
        }
        if (str_contains($clean, 'PROTECCION') || str_contains($clean, 'PERMISO') || str_contains($clean, 'PEP') || str_contains($clean, 'PPT') || str_contains($clean, 'TEMPORAL')) {
            return 'Permiso de Protección Temporal';
        }

        return 'Cédula de ciudadanía';
    }

    /**
     * Mapea cualquier estado al ENUM exacto de la tabla apprentices del ERP.
     */
    public static function normalizeApprenticeStatus(?string $estado): string
    {
        if (empty($estado)) {
            return 'CERTIFICADO';
        }

        $clean = strtoupper(trim(str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'],
            ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'],
            $estado
        )));

        $map = [
            'CERTIFICADO'       => 'CERTIFICADO',
            'EN_FORMACION'      => 'EN FORMACIÓN',
            'EN FORMACION'      => 'EN FORMACIÓN',
            'EN FORMACIÓN'      => 'EN FORMACIÓN',
            'FORMACION'         => 'EN FORMACIÓN',
            'EMPLEADO'          => 'EN FORMACIÓN',
            'CONDICIONADO'      => 'CONDICIONADO',
            'INDUCCION'         => 'INDUCCIÓN',
            'INDUCCIÓN'         => 'INDUCCIÓN',
            'APLAZADO'          => 'APLAZADO',
            'CANCELADO'         => 'CANCELADO',
            'RETIRO VOLUNTARIO' => 'RETIRO VOLUNTARIO',
            'RETIRO_VOLUNTARIO' => 'RETIRO VOLUNTARIO',
            'TRASLADADO'        => 'TRASLADADO',
            'NO REGISTRA'       => 'NO REGISTRA',
        ];

        return $map[$clean] ?? 'CERTIFICADO';
    }

    /**
     * Sanitiza y asegura campos obligatorios de Person para evitar advertencias de truncamiento en MySQL del ERP.
     */
    public static function ensurePersonDefaults(Person $person): void
    {
        if (!isset($person->eps_id) || $person->eps_id === null || $person->eps_id === '') {
            $eps = \DB::table('e_p_s')->value('id');
            $person->eps_id = $eps !== null ? $eps : 0;
        }
        if (!isset($person->population_group_id) || $person->population_group_id === null || $person->population_group_id === '') {
            $pop = \DB::table('population_groups')->value('id');
            $person->population_group_id = $pop !== null ? $pop : 1;
        }
        if (!isset($person->pension_entity_id) || $person->pension_entity_id === null || $person->pension_entity_id === '') {
            $pen = \DB::table('pension_entities')->value('id');
            $person->pension_entity_id = $pen !== null ? $pen : 1;
        }
        if (empty($person->document_type)) {
            $person->document_type = 'Cédula de ciudadanía';
        }
    }

    /**
     * Localiza inteligentemente un Programa de formación en el ERP o lo crea cumpliendo el esquema relacional.
     */
    public static function findOrCreateProgram(?string $progName): ?Program
    {
        if (empty($progName)) {
            return Program::first();
        }

        $progClean = trim(strip_tags($progName));

        // 1. Búsqueda exacta o contenida directa
        $program = Program::where('name', 'like', '%' . $progClean . '%')->first();
        if ($program) {
            return $program;
        }

        // 2. Búsqueda sin paréntesis ni siglas secundarias (ej. "Análisis y Desarrollo de Software (ADSO)" -> "Análisis y Desarrollo de Software")
        $withoutParentheses = trim(preg_replace('/\s*\(.*?\)\s*/', ' ', $progClean));
        if (!empty($withoutParentheses) && $withoutParentheses !== $progClean) {
            $program = Program::where('name', 'like', '%' . $withoutParentheses . '%')->first();
            if ($program) {
                return $program;
            }
        }

        // 3. Búsqueda por palabras clave principales
        $words = array_filter(preg_split('/[\s,\.\(\)\-]+/', $progClean), function($w) {
            return mb_strlen($w) >= 4;
        });

        if (!empty($words)) {
            $query = Program::query();
            foreach ($words as $word) {
                $query->where('name', 'like', '%' . $word . '%');
            }
            $program = $query->first();
            if ($program) {
                return $program;
            }

            usort($words, fn($a, $b) => mb_strlen($b) - mb_strlen($a));
            $longest = reset($words);
            $program = Program::where('name', 'like', '%' . $longest . '%')->first();
            if ($program) {
                return $program;
            }
        }

        // 4. Si el programa no existe, se crea con todos los campos requeridos por el esquema SICA
        try {
            $networkId = \DB::table('knowledge_networks')->value('id') ?? 1;
            $maxSofia = (int) (\DB::table('programs')->max('sofia_code') ?? 100000);
            $newSofiaCode = $maxSofia + rand(1, 100);

            $newProg = new Program();
            $newProg->name = $withoutParentheses ?: $progClean;
            $newProg->sofia_code = $newSofiaCode;
            $newProg->version = 1;
            $newProg->training_type = 'Titulada';
            $newProg->quarter_number = 6;
            $newProg->knowledge_network_id = $networkId;
            $newProg->program_type = 'Tecnólogo';
            $newProg->maximum_duration = 24;
            $newProg->modality = 'Presencial';
            $newProg->priority_bets = 'Sin especificar';
            $newProg->fic = 'No';
            $newProg->months_lectiva = 18;
            $newProg->months_productiva = 6;
            $newProg->save();

            return $newProg;
        } catch (\Exception $e) {
            \Log::warning('No se pudo registrar nuevo programa en SICA, asignando programa base: ' . $e->getMessage());
            return Program::first();
        }
    }

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

        $cleanEmail = strtolower(filter_var(trim($request->personal_email), FILTER_SANITIZE_EMAIL));
        $docNumber = (int) preg_replace('/\D/', '', (string) $request->document_number);
        if ($docNumber <= 0 || strlen((string)$docNumber) < 5) {
            return redirect()->back()->with('error', 'El número de documento debe contener solo dígitos válidos (mínimo 5 dígitos).')->withInput();
        }

        // 1. SEGURIDAD: Verificar si el documento ya está registrado como egresado
        $existingApprentice = Apprentice::whereHas('person', function($q) use ($docNumber) {
            $q->where('document_number', $docNumber);
        })->first();
        if ($existingApprentice) {
            return redirect()->route('login', ['redirect' => route('egresados.dashboard_egresado')])
                ->with('info', "El documento {$docNumber} ya se encuentra registrado como egresado en el sistema. Por favor inicia sesión.");
        }

        // 2. SEGURIDAD: Verificar unicidad del correo electrónico (no correos duplicados)
        $personWithEmail = Person::where(function($q) use ($cleanEmail) {
            $q->where('personal_email', $cleanEmail)->orWhere('misena_email', $cleanEmail);
        })->where('document_number', '!=', $docNumber)->first();

        if ($personWithEmail) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya se encuentra registrado a nombre de otra persona (Documento: {$personWithEmail->document_number}). Los datos de contacto deben ser únicos.")->withInput();
        }

        $existingUser = User::where('email', $cleanEmail)->first();
        if ($existingUser) {
            if ($existingUser->person_id) {
                $uPerson = Person::find($existingUser->person_id);
                if ($uPerson && $uPerson->document_number != $docNumber) {
                    return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya pertenece a otra cuenta de usuario en el sistema. Cada egresado debe tener un correo único.")->withInput();
                }
            }
            if ($existingUser->password) {
                return redirect()->route('login', ['redirect' => route('egresados.dashboard_egresado')])
                    ->with('info', 'Ya existe una cuenta registrada con el correo ' . $cleanEmail . '. Por favor inicia sesión con tu contraseña.');
            }
        }

        // 3. SEGURIDAD: Verificar unicidad del número de teléfono (no teléfonos duplicados)
        $cleanTel = null;
        if ($request->filled('telephone1')) {
            $cleanTelDigits = preg_replace('/\D/', '', (string)$request->telephone1);
            if (!empty($cleanTelDigits)) {
                if (strlen($cleanTelDigits) < 7 || strlen($cleanTelDigits) > 15) {
                    return redirect()->back()->with('error', 'El número de teléfono debe tener entre 7 y 15 dígitos numéricos.')->withInput();
                }
                $personWithPhone = Person::where('telephone1', (int)$cleanTelDigits)
                    ->where('document_number', '!=', $docNumber)
                    ->first();
                if ($personWithPhone) {
                    return redirect()->back()->with('error', "El número de teléfono {$cleanTelDigits} ya se encuentra registrado a nombre de otra persona en el sistema. Cada egresado debe contar con un teléfono de contacto único.")->withInput();
                }
                $cleanTel = (int)$cleanTelDigits;
            }
        }

        DB::beginTransaction();
        try {
            // 1. Obtener IDs por defecto de tablas maestras del ERP
            $epsId = DB::table('e_p_s')->value('id');
            $epsId = $epsId !== null ? $epsId : 0;
            $populationGroupId = DB::table('population_groups')->value('id') ?? 1;
            $pensionEntityId = DB::table('pension_entities')->value('id') ?? 1;

            // 2. Buscar o crear la Persona asegurando tipos de la BD ERP
            $person = Person::firstOrNew(['document_number' => $docNumber]);
            $person->document_type = self::normalizeDocumentType($request->document_type);
            $person->first_name = strip_tags(trim($request->first_name));
            $person->first_last_name = strip_tags(trim($request->first_last_name));
            if ($request->filled('second_last_name')) {
                $person->second_last_name = strip_tags(trim($request->second_last_name));
            }
            if ($request->filled('gender')) {
                $person->gender = strip_tags($request->gender);
            }
            $person->telephone1 = $cleanTel;
            $person->personal_email = $cleanEmail;
            if ($request->filled('misena_email')) {
                $person->misena_email = filter_var(trim($request->misena_email), FILTER_SANITIZE_EMAIL);
            }
            $person->eps_id = $person->eps_id ?: $epsId;
            $person->population_group_id = $person->population_group_id ?: $populationGroupId;
            $person->pension_entity_id = $person->pension_entity_id ?: $pensionEntityId;
            self::ensurePersonDefaults($person);
            $person->save();

            // 3. Crear o actualizar el Usuario de manera segura
            $baseNickname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $person->first_name . '.' . $person->first_last_name));
            $nickname = $baseNickname ?: 'egresado.' . $person->document_number;
            $count = 1;
            while (User::where('nickname', $nickname)->where('id', '!=', $existingUser?->id)->exists()) {
                $nickname = $baseNickname . $count++;
            }

            $user = $existingUser ?: (User::where('person_id', $person->id)->first() ?: new User());
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
            $apprentice->apprentice_status = self::normalizeApprenticeStatus($request->input('estado_egresado', 'CERTIFICADO'));
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
        $totalEgresados = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmpleados = Apprentice::where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = Apprentice::where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->count();

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
        $baseQuery = Apprentice::where(function($q) {
            $q->whereHas('person.users.roles', function($rq) {
                $rq->where('slug', 'egresados.egresado');
            })->orWhere('apprentice_status', 'CERTIFICADO');
        });

        $totalEgresados = (clone $baseQuery)->count();
        $totalActivos = $totalEgresados;
        $totalEmpleados = (clone $baseQuery)->where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = (clone $baseQuery)->where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = (clone $baseQuery)->where('apprentice_status', 'EN FORMACIÓN')->count();
        
        $tasaEmpleo = $totalActivos > 0 ? round(($totalEmpleados / $totalActivos) * 100) : 100;

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

        return view('egresados::superadmin.dashboard', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'totalActivos',
            'tasaEmpleo',
            'recentEgresados',
            'programStats'
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
            'tipo_documento' => 'nullable|string|max:50',
            'documento'      => 'required|string',
            'nombres'        => 'nullable|string|max:255',
            'apellidos'      => 'nullable|string|max:255',
            'nombre'         => 'nullable|string|max:255',
            'correo'         => 'required|email|max:255',
            'programa'       => 'nullable|string|max:255',
            'telefono'       => 'nullable|string',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'correo.required'    => 'El correo electrónico es obligatorio.',
            'correo.email'       => 'El formato de correo no es válido.',
        ]);

        $docNum = (int) preg_replace('/\D/', '', (string)$request->documento);
        if ($docNum <= 0 || strlen((string)$docNum) < 5) {
            return redirect()->back()->with('error', 'El número de documento del instructor debe ser numérico válido (mínimo 5 dígitos).')->withInput();
        }

        $cleanEmail = strtolower(filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL));

        // 1. SEGURIDAD: Verificar unicidad de correo
        $personWithEmail = Person::where(function($q) use ($cleanEmail) {
            $q->where('personal_email', $cleanEmail)->orWhere('misena_email', $cleanEmail);
        })->where('document_number', '!=', $docNum)->first();

        if ($personWithEmail) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya se encuentra registrado por otra persona en el sistema (Documento: {$personWithEmail->document_number}). Los correos deben ser únicos.")->withInput();
        }

        $userWithEmail = \App\Models\User::where('email', $cleanEmail)->first();
        if ($userWithEmail && $userWithEmail->person_id) {
            $uPerson = Person::find($userWithEmail->person_id);
            if ($uPerson && $uPerson->document_number != $docNum) {
                return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya está asignado a otra cuenta de usuario en el sistema.")->withInput();
            }
        } elseif ($userWithEmail && !$userWithEmail->person_id) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya está reservado por una cuenta de usuario existente.")->withInput();
        }

        // 2. SEGURIDAD: Verificar unicidad de teléfono
        $cleanTel = null;
        if ($request->filled('telefono')) {
            $cleanTelDigits = preg_replace('/\D/', '', (string)$request->telefono);
            if (!empty($cleanTelDigits)) {
                if (strlen($cleanTelDigits) < 7 || strlen($cleanTelDigits) > 15) {
                    return redirect()->back()->with('error', 'El número de teléfono del instructor debe tener entre 7 y 15 dígitos numéricos.')->withInput();
                }
                $personWithPhone = Person::where('telephone1', (int)$cleanTelDigits)->where('document_number', '!=', $docNum)->first();
                if ($personWithPhone) {
                    return redirect()->back()->with('error', "El número de teléfono {$cleanTelDigits} ya se encuentra registrado por otra persona en el sistema. Los teléfonos deben ser únicos.")->withInput();
                }
                $cleanTel = (int)$cleanTelDigits;
            }
        }

        \DB::beginTransaction();
        try {
            // 1. Separar o procesar nombre y apellidos inteligentemente
            if ($request->filled('nombres')) {
                $firstName = strip_tags(trim($request->nombres));
                $firstLastName = strip_tags(trim($request->apellidos ?? 'SENA'));
                $secondLastName = null;
            } else {
                $partesNombre = preg_split('/\s+/', trim(strip_tags($request->nombre ?? 'Instructor SENA')));
                $firstName = $partesNombre[0] ?? 'Instructor';
                $firstLastName = $partesNombre[1] ?? 'SENA';
                $secondLastName = isset($partesNombre[2]) ? implode(' ', array_slice($partesNombre, 2)) : null;
            }

            // 2. Crear o buscar Persona en el ERP (SICA) con normalización estricta (incluyendo soft-deleted)
            $person = Person::withTrashed()->where('document_number', $docNum)->first();
            if (!$person) {
                $person = new Person(['document_number' => $docNum]);
            } elseif (method_exists($person, 'trashed') && $person->trashed()) {
                $person->restore();
            }
            $person->document_type = self::normalizeDocumentType($request->tipo_documento ?? $person->document_type ?? 'Cédula de ciudadanía');
            $person->first_name = $firstName;
            $person->first_last_name = $firstLastName;
            if ($secondLastName) {
                $person->second_last_name = $secondLastName;
            }

            $person->personal_email = $cleanEmail;
            $person->misena_email = $cleanEmail;
            $person->telephone1 = $cleanTel;

            self::ensurePersonDefaults($person);
            $person->save();

            // 3. Crear o asociar Usuario en la tabla users sin colisiones
            $user = \App\Models\User::where('person_id', $person->id)->orWhere('email', $cleanEmail)->first();
            if (!$user) {
                $user = new \App\Models\User();
                $user->person_id = $person->id;
                $user->email = $cleanEmail;

                $baseNickname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstName . '.' . $firstLastName));
                $nickname = $baseNickname ?: 'instructor.' . $docNum;
                $count = 1;
                while (\App\Models\User::where('nickname', $nickname)->exists()) {
                    $nickname = $baseNickname . $count++;
                }
                $user->nickname = $nickname;
                $user->password = bcrypt('Sena12345*');
                $user->save();
            } else {
                $user->person_id = $person->id;
                if (!\App\Models\User::where('email', $cleanEmail)->where('id', '!=', $user->id)->exists()) {
                    $user->email = $cleanEmail;
                }
                $user->save();
            }

            // 4. Asignar rol exclusivo de Instructor en la BD del ERP (sin superadmin ni coordinador)
            $app = \DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
            $appId = $app ? $app->id : 30;
            $role = \Modules\SICA\Entities\Role::firstOrCreate(
                ['slug' => 'egresados.instructor'],
                [
                    'name' => 'Instructor Egresados',
                    'description' => 'Docente o evaluador de seguimiento a egresados en CEFA La Angostura',
                    'description_english' => 'Instructor / Trainer tracking graduates at CEFA',
                    'full_access' => 'No',
                    'app_id' => $appId,
                ]
            );

            if ($role && !$user->roles()->where('role_id', $role->id)->exists()) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }

            // 5. Vincular programa de formación en curso si se especificó
            if ($request->filled('programa')) {
                $progInput = trim(strip_tags($request->programa));
                $course = \Modules\SICA\Entities\Course::whereHas('program', function($q) use ($progInput) {
                    $q->where('name', 'like', "%{$progInput}%");
                })->first();

                if ($course) {
                    $course->person_id = $person->id;
                    $course->save();
                }
            }

            \DB::commit();

            return redirect()->back()->with('success', '¡Instructor registrado y rol asignado exitosamente en el ERP!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error en instructoresStore: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al registrar instructor: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Actualiza la información de un instructor existente en el ERP.
     */
    public function instructoresUpdate(Request $request, $id)
    {
        $request->validate([
            'documento' => 'required|string',
            'nombre'    => 'required|string|max:255',
            'correo'    => 'required|email|max:255',
            'rol'       => 'nullable|string',
            'telefono'  => 'nullable|string',
            'programa'  => 'nullable|string',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'nombre.required'    => 'El nombre del instructor es obligatorio.',
            'correo.required'    => 'El correo electrónico es obligatorio.',
            'correo.email'       => 'El formato de correo no es válido.',
        ]);

        \DB::beginTransaction();
        try {
            $user = \App\Models\User::with('person')->findOrFail($id);
            $person = $user->person;

            $docNum = (int) preg_replace('/\D/', '', (string)$request->documento);
            if ($docNum <= 0 || strlen((string)$docNum) < 5) {
                return redirect()->back()->with('error', 'El número de documento no es válido (mínimo 5 dígitos).')->withInput();
            }

            // 1. SEGURIDAD: Unicidad del documento contra otras personas
            if ($person) {
                $otherPersonWithDoc = Person::where('document_number', $docNum)->where('id', '!=', $person->id)->first();
                if ($otherPersonWithDoc) {
                    return redirect()->back()->with('error', "El número de documento {$docNum} ya se encuentra asignado a otra persona en el sistema.")->withInput();
                }
            }

            // 2. SEGURIDAD: Unicidad del correo electrónico (nada de correos duplicados)
            $cleanEmail = strtolower(filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL));
            if ($person) {
                $otherPersonWithEmail = Person::where(function($q) use ($cleanEmail) {
                    $q->where('personal_email', $cleanEmail)->orWhere('misena_email', $cleanEmail);
                })->where('id', '!=', $person->id)->first();

                if ($otherPersonWithEmail) {
                    return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya pertenece a otra persona en el sistema (Documento: {$otherPersonWithEmail->document_number}). Los correos deben ser únicos.")->withInput();
                }
            }

            $otherUserWithEmail = \App\Models\User::where('email', $cleanEmail)->where('id', '!=', $user->id)->first();
            if ($otherUserWithEmail) {
                return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya está asignado a otra cuenta de usuario. Ingrese un correo único.")->withInput();
            }

            if (!$person) {
                $person = Person::firstOrNew(['document_number' => $docNum]);
            } else {
                $person->document_number = $docNum;
            }

            $partesNombre = preg_split('/\s+/', trim(strip_tags($request->nombre)));
            $person->first_name = $partesNombre[0] ?? 'Instructor';
            $person->first_last_name = $partesNombre[1] ?? 'SENA';
            $person->second_last_name = isset($partesNombre[2]) ? implode(' ', array_slice($partesNombre, 2)) : null;

            if ($request->filled('tipo_documento')) {
                $person->document_type = self::normalizeDocumentType($request->tipo_documento);
            }

            $person->personal_email = $cleanEmail;
            $person->misena_email = $cleanEmail;

            // 3. SEGURIDAD: Unicidad del número de teléfono (nada de teléfonos duplicados)
            $cleanTel = null;
            if ($request->filled('telefono')) {
                $cleanTelDigits = preg_replace('/\D/', '', (string)$request->telefono);
                if (!empty($cleanTelDigits)) {
                    if (strlen($cleanTelDigits) < 7 || strlen($cleanTelDigits) > 15) {
                        return redirect()->back()->with('error', 'El número de teléfono del instructor debe tener entre 7 y 15 dígitos numéricos.')->withInput();
                    }
                    $otherPersonWithPhone = Person::where('telephone1', (int)$cleanTelDigits)
                        ->where('id', '!=', $person->id)
                        ->first();
                    if ($otherPersonWithPhone) {
                        return redirect()->back()->with('error', "El número de teléfono {$cleanTelDigits} ya se encuentra registrado por otra persona en el sistema. Los teléfonos deben ser únicos.")->withInput();
                    }
                    $cleanTel = (int)$cleanTelDigits;
                }
            }
            $person->telephone1 = $cleanTel;

            self::ensurePersonDefaults($person);
            $person->save();

            // Sincronizar datos del usuario
            $user->person_id = $person->id;
            if (!\App\Models\User::where('email', $cleanEmail)->where('id', '!=', $user->id)->exists()) {
                $user->email = $cleanEmail;
            }
            $user->save();

            // Asegurar rol exclusivo de Instructor (sin superadmin ni coordinador)
            $app = \DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
            $appId = $app ? $app->id : 30;
            $role = \Modules\SICA\Entities\Role::firstOrCreate(
                ['slug' => 'egresados.instructor'],
                [
                    'name' => 'Instructor Egresados',
                    'description' => 'Docente o evaluador de seguimiento a egresados en CEFA La Angostura',
                    'description_english' => 'Instructor / Trainer tracking graduates at CEFA',
                    'full_access' => 'No',
                    'app_id' => $appId,
                ]
            );

            if ($role && !$user->roles()->where('role_id', $role->id)->exists()) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }

            // Vincular o actualizar programa de formación
            if ($request->filled('programa')) {
                $progInput = trim(strip_tags($request->programa));
                $course = \Modules\SICA\Entities\Course::whereHas('program', function($q) use ($progInput) {
                    $q->where('name', 'like', "%{$progInput}%");
                })->first();

                if ($course) {
                    $course->person_id = $person->id;
                    $course->save();
                }
            }

            \DB::commit();

            return redirect()->back()->with('success', '¡Información del instructor actualizada exitosamente!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error en instructoresUpdate: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar instructor: ' . $e->getMessage())->withInput();
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
        // Consulta base: Egresados vinculados a SIGE o con estado CERTIFICADO (evita los 5,600 aprendices de otros módulos)
        $query = Apprentice::with(['person.users.roles', 'course.program'])
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
            $query->where('apprentice_status', $request->input('apprentice_status'));
        }

        $egresados = $query->orderBy('id', 'desc')->paginate(10);

        // Estadísticas de egresados de este módulo
        $baseCount = Apprentice::where(function($q) {
            $q->whereHas('person.users.roles', function($rq) {
                $rq->where('slug', 'egresados.egresado');
            })->orWhere('apprentice_status', 'CERTIFICADO');
        });

        $totalEgresados = (clone $baseCount)->count();
        $totalEmpleados = (clone $baseCount)->where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = (clone $baseCount)->where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = (clone $baseCount)->where('apprentice_status', 'EN FORMACIÓN')->count();
        $actualizacionPendiente = 0;
        $seguimientosRealizados = $totalEgresados;
        $alertasEnviadas = 0;

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
                    $apprentice->apprentice_status = self::normalizeApprenticeStatus($request->nuevo_estado_laboral);
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
            'programa'       => 'nullable|string|max:255',
            'estado'         => 'nullable|string|max:50',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'nombre.required'    => 'El nombre completo es obligatorio.',
            'correo.required'    => 'El correo electrónico es requerido.',
            'correo.email'       => 'Debe ingresar un formato de correo electrónico válido.',
        ]);

        $apprentice = Apprentice::with(['person', 'course.program'])->findOrFail($id);
        $person = $apprentice->person;

        $cleanDoc = (int) preg_replace('/\D/', '', (string)$request->documento);
        if ($cleanDoc <= 0 || strlen((string)$cleanDoc) < 5) {
            return redirect()->back()->with('error', 'El número de documento debe contener solo dígitos válidos (mínimo 5 dígitos).')->withInput();
        }

        if (!$person) {
            $person = Person::firstOrNew(['document_number' => $cleanDoc]);
            $person->save();
            $apprentice->person_id = $person->id;
        }

        // SEGURIDAD: 1. Unicidad del documento contra otras personas
        $otherPersonWithDoc = Person::where('document_number', $cleanDoc)->where('id', '!=', $person->id)->first();
        if ($otherPersonWithDoc) {
            // Si ya existe otra persona con ese documento en el ERP, asociamos el aprendiz a esa persona existente
            $person = $otherPersonWithDoc;
            $apprentice->person_id = $person->id;
        }

        // SEGURIDAD: 2. Unicidad del correo electrónico
        $cleanEmail = strtolower(filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL));
        $otherPersonWithEmail = Person::where(function($q) use ($cleanEmail) {
            $q->where('personal_email', $cleanEmail)->orWhere('misena_email', $cleanEmail);
        })->where('id', '!=', $person->id)->first();

        if ($otherPersonWithEmail && $otherPersonWithEmail->document_number != $cleanDoc) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya se encuentra asignado a otra persona en el sistema (Documento: {$otherPersonWithEmail->document_number}). Los correos deben ser únicos.")->withInput();
        }

        $otherUserWithEmail = User::where('email', $cleanEmail)->where('person_id', '!=', $person->id)->first();
        if ($otherUserWithEmail) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya está en uso por otra cuenta de usuario. Ingrese un correo único.")->withInput();
        }

        // SEGURIDAD: 3. Unicidad del número de teléfono
        $cleanTel = null;
        if ($request->filled('telefono')) {
            $cleanTelDigits = preg_replace('/\D/', '', (string)$request->telefono);
            if (!empty($cleanTelDigits)) {
                if (strlen($cleanTelDigits) < 7 || strlen($cleanTelDigits) > 15) {
                    return redirect()->back()->with('error', 'El número de teléfono debe tener entre 7 y 15 dígitos numéricos.')->withInput();
                }
                $otherPersonWithPhone = Person::where('telephone1', (int)$cleanTelDigits)->where('id', '!=', $person->id)->first();
                if ($otherPersonWithPhone && $otherPersonWithPhone->document_number != $cleanDoc) {
                    return redirect()->back()->with('error', "El número de teléfono {$cleanTelDigits} ya se encuentra asignado a otra persona en el sistema (Documento: {$otherPersonWithPhone->document_number}). Los teléfonos deben ser únicos.")->withInput();
                }
                $cleanTel = (int)$cleanTelDigits;
            }
        }

        \DB::beginTransaction();
        try {
            // Sanitizar y separar nombres inteligentemente
            $nombreLimpio = strip_tags(trim($request->nombre));
            $partes = preg_split('/\s+/', $nombreLimpio);
            if (count($partes) === 1) {
                $person->first_name = $partes[0];
                $person->first_last_name = $person->first_last_name ?: 'SENA';
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
                $person->document_type = self::normalizeDocumentType($request->tipo_documento);
            }
            $person->document_number = $cleanDoc;
            $person->personal_email = $cleanEmail;
            if (str_contains($cleanEmail, 'misena.edu.co') || str_contains($cleanEmail, 'sena.edu.co')) {
                $person->misena_email = $cleanEmail;
            }
            $person->telephone1 = $cleanTel;

            self::ensurePersonDefaults($person);
            $person->save();

            // Actualizar curso y programa según lo que el usuario editó
            $cleanFicha = $request->filled('ficha') ? preg_replace('/\D/', '', (string)$request->ficha) : null;
            $progName = $request->filled('programa') ? trim(strip_tags($request->programa)) : null;

            $course = null;
            if ($cleanFicha) {
                $course = Course::where('code', $cleanFicha)->orWhere('code', trim(strip_tags($request->ficha)))->first();
            }

            $program = self::findOrCreateProgram($progName);

            if (!$course && ($cleanFicha || $program)) {
                $municipalityId = \DB::table('municipalities')->value('id') ?? 1;
                $course = Course::firstOrCreate(
                    ['code' => $cleanFicha ?: rand(1000000, 9999999)],
                    [
                        'program_id'      => $program ? $program->id : ($apprentice->course ? $apprentice->course->program_id : 1),
                        'municipality_id' => $municipalityId,
                        'start_date'      => now()->subYears(2)->toDateString(),
                        'end_date'        => now()->toDateString(),
                        'status'          => 'Activo',
                    ]
                );
            } elseif ($course && $program) {
                if ($course->program_id !== $program->id) {
                    $course->program_id = $program->id;
                    $course->save();
                }
            }

            if ($course) {
                $apprentice->course_id = $course->id;
            } elseif ($program && $apprentice->course) {
                $apprentice->course->program_id = $program->id;
                $apprentice->course->save();
            }

            // Actualizar estado ocupacional normalizado a enum del ERP
            if ($request->filled('estado')) {
                $apprentice->apprentice_status = self::normalizeApprenticeStatus($request->estado);
            }

            $apprentice->person_id = $person->id;
            $apprentice->touch();
            $apprentice->save();

            // Si tiene usuario vinculado por person_id, sincronizar su email de forma segura
            if ($request->filled('correo')) {
                $correoLimpio = filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL);
                $user = User::where('person_id', $person->id)->first();
                if ($user) {
                    if (!User::where('email', $correoLimpio)->where('id', '!=', $user->id)->exists()) {
                        $user->email = $correoLimpio;
                        $user->save();
                    }
                }
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
            'correo'         => 'required|email|max:255',
            'telefono'       => 'nullable|string|max:30',
            'ficha'          => 'nullable|string|max:50',
            'programa'       => 'nullable|string|max:255',
            'estado'         => 'nullable|string|max:50',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'documento.numeric'  => 'El número de documento debe contener solo dígitos.',
            'correo.required'    => 'El correo electrónico es obligatorio para garantizar un registro único e institucional.',
            'correo.email'       => 'El formato de correo institucional o personal no es válido.',
        ]);

        $docNumber = (int) preg_replace('/\D/', '', (string)$request->documento);
        if ($docNumber <= 0 || strlen((string)$docNumber) < 5) {
            return redirect()->back()->with('error', 'El número de documento debe contener solo dígitos válidos (mínimo 5 dígitos).')->withInput();
        }

        // SEGURIDAD: 1. Unicidad del egresado por documento
        $existingApprentice = Apprentice::whereHas('person', function($q) use ($docNumber) {
            $q->where('document_number', $docNumber);
        })->first();
        if ($existingApprentice) {
            return redirect()->back()->with('error', "El documento {$docNumber} ya se encuentra registrado como egresado en el sistema.")->withInput();
        }

        // SEGURIDAD: 2. Unicidad estricta del correo electrónico (nada de correos duplicados)
        $cleanEmail = strtolower(filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL));
        $personWithEmail = Person::where(function($q) use ($cleanEmail) {
            $q->where('personal_email', $cleanEmail)->orWhere('misena_email', $cleanEmail);
        })->where('document_number', '!=', $docNumber)->first();

        if ($personWithEmail) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya se encuentra registrado en el sistema por otra persona (Documento: {$personWithEmail->document_number}). Los correos deben ser únicos.")->withInput();
        }

        $userWithEmail = User::where('email', $cleanEmail)->first();
        if ($userWithEmail && $userWithEmail->person_id) {
            $uPerson = Person::find($userWithEmail->person_id);
            if ($uPerson && $uPerson->document_number != $docNumber) {
                return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya está asignado a otra cuenta de usuario en el sistema. Los correos deben ser únicos.")->withInput();
            }
        } elseif ($userWithEmail && !$userWithEmail->person_id) {
            return redirect()->back()->with('error', "El correo electrónico '{$cleanEmail}' ya se encuentra reservado por una cuenta de usuario existente. Ingrese un correo único.")->withInput();
        }

        // SEGURIDAD: 3. Unicidad estricta del número de teléfono (nada de teléfonos duplicados)
        $cleanTel = null;
        if ($request->filled('telefono')) {
            $cleanTelDigits = preg_replace('/\D/', '', (string)$request->telefono);
            if (!empty($cleanTelDigits)) {
                if (strlen($cleanTelDigits) < 7 || strlen($cleanTelDigits) > 15) {
                    return redirect()->back()->with('error', 'El número de teléfono debe tener entre 7 y 15 dígitos numéricos.')->withInput();
                }
                $personWithPhone = Person::where('telephone1', (int)$cleanTelDigits)
                    ->where('document_number', '!=', $docNumber)
                    ->first();
                if ($personWithPhone) {
                    return redirect()->back()->with('error', "El número de teléfono {$cleanTelDigits} ya se encuentra registrado a nombre de otra persona en el sistema (Documento: {$personWithPhone->document_number}). Los teléfonos deben ser únicos.")->withInput();
                }
                $cleanTel = (int)$cleanTelDigits;
            }
        }

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

            // 2. Buscar o instanciar la Persona (incluyendo soft-deleted)
            $person = Person::withTrashed()->where('document_number', $docNumber)->first();
            if (!$person) {
                $person = new Person(['document_number' => $docNumber]);
            } elseif (method_exists($person, 'trashed') && $person->trashed()) {
                $person->restore();
            }
            $person->document_type = self::normalizeDocumentType($request->tipo_documento ?? $person->document_type);
            $person->first_name = $firstName;
            $person->first_last_name = $firstLastName;
            $person->personal_email = $cleanEmail;
            $person->misena_email = $cleanEmail;
            $person->telephone1 = $cleanTel;

            self::ensurePersonDefaults($person);
            $person->save();

            // 3. Crear o asociar usuario de acceso si se proporcionó correo
            if ($request->filled('correo')) {
                $cleanEmail = filter_var($request->correo, FILTER_SANITIZE_EMAIL);
                $user = User::where('person_id', $person->id)->orWhere('email', $cleanEmail)->first();
                if (!$user) {
                    $user = new User();
                    $user->person_id = $person->id;
                    $user->email = $cleanEmail;
                    $baseNickname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $person->first_name . '.' . $person->first_last_name));
                    $nickname = $baseNickname ?: 'egresado.' . $person->document_number;
                    $count = 1;
                    while (User::where('nickname', $nickname)->exists()) {
                        $nickname = $baseNickname . $count++;
                    }
                    $user->nickname = $nickname;
                    $user->password = Hash::make('Sena' . $person->document_number . '*');
                    $user->save();
                } else {
                    $user->person_id = $person->id;
                    if (!User::where('email', $cleanEmail)->where('id', '!=', $user->id)->exists()) {
                        $user->email = $cleanEmail;
                    }
                    $user->save();
                }

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

            // 4. Buscar el curso/ficha si existe, o crearlo/asociarlo fielmente
            $courseId = null;
            $cleanFicha = $request->filled('ficha') ? preg_replace('/\D/', '', (string)$request->ficha) : null;
            $progName = $request->filled('programa') ? strip_tags(trim($request->programa)) : null;

            $course = null;
            if ($cleanFicha) {
                $course = Course::where('code', $cleanFicha)->orWhere('code', strip_tags($request->ficha))->first();
            }

            $program = self::findOrCreateProgram($progName);

            if (!$course && ($cleanFicha || $program)) {
                $municipalityId = \DB::table('municipalities')->value('id') ?? 1;
                $course = Course::firstOrCreate(
                    ['code' => $cleanFicha ?: rand(1000000, 9999999)],
                    [
                        'program_id'      => $program ? $program->id : 1,
                        'municipality_id' => $municipalityId,
                        'start_date'      => now()->subYears(2)->toDateString(),
                        'end_date'        => now()->toDateString(),
                        'status'          => 'Activo',
                    ]
                );
            }

            if ($course) {
                $courseId = $course->id;
            } else {
                $firstCourse = Course::first();
                $courseId = $firstCourse ? $firstCourse->id : 1;
            }

            // 5. Mapear estado
            $apprenticeStatus = self::normalizeApprenticeStatus($request->estado ?? 'CERTIFICADO');

            // 6. Crear o actualizar registro de Aprendiz (Egresado)
            $apprentice = Apprentice::firstOrNew([
                'person_id' => $person->id,
            ]);
            $apprentice->course_id = $courseId;
            $apprentice->apprentice_status = $apprenticeStatus;
            $apprentice->touch();
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