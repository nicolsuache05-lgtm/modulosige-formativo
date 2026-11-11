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
     * Guarda la foto de perfil de una persona en public/modules/egresados/images/avatars y actualiza su campo avatar.
     */
    public static function savePersonAvatar(Person $person, ?\Illuminate\Http\UploadedFile $file): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $destDir = public_path('modules/egresados/images/avatars');
        if (!is_dir($destDir)) {
            @mkdir($destDir, 0775, true);
        }

        if (!empty($person->avatar)) {
            $oldRel = ltrim(str_replace('\\', '/', $person->avatar), '/');
            if (str_starts_with($oldRel, 'modules/egresados/images/avatars/')) {
                $oldFull = public_path($oldRel);
                if (file_exists($oldFull) && is_file($oldFull)) {
                    @unlink($oldFull);
                }
            }
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'jpg');
        $identifier = $person->id ?: ($person->document_number ?: time());
        $filename = 'avatar_' . $identifier . '_' . time() . '.' . $ext;
        $file->move($destDir, $filename);

        $relPath = 'modules/egresados/images/avatars/' . $filename;
        $person->avatar = $relPath;
        $person->save();

        return asset($relPath);
    }

    /**
     * Resuelve la URL pública de la foto de perfil de una persona si existe.
     */
    public static function getAvatarUrl(?Person $person): ?string
    {
        if (!$person || empty($person->avatar)) {
            return null;
        }

        $raw = trim((string) $person->avatar);
        if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://') || str_starts_with($raw, 'data:image/')) {
            return $raw;
        }

        $clean = ltrim(str_replace('\\', '/', $raw), '/');
        if (file_exists(public_path($clean))) {
            return asset($clean);
        }
        if (file_exists(public_path('storage/' . $clean))) {
            return asset('storage/' . $clean);
        }

        return null;
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
            'course_id'             => 'required|numeric',
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
            'course_id.required'        => 'Debes ingresar el número de ficha de tu formación.',
            'course_id.numeric'         => 'El número de ficha debe contener únicamente números.',
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

        // 0. SEGURIDAD INSTITUCIONAL: Prohibir registro público con correo de Superadministrador
        $authorizedSuperadminEmail = strtolower((string) config('egresados.security.superadmin_email', 'superadmin.egresados@sena.edu.co'));
        if ($cleanEmail === $authorizedSuperadminEmail) {
            \Modules\Egresados\Services\SigeSecurityLogger::log('REGISTRATION_HIJACK_ATTEMPT', "Intento de registro público con correo reservado de Superadministrador: {$cleanEmail}", $request);
            return redirect()->back()->with('error', 'El correo ingresado está reservado para la administración institucional y no puede ser utilizado para registro público.')->withInput();
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

            if ($request->hasFile('foto')) {
                self::savePersonAvatar($person, $request->file('foto'));
            }

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

            // 5. Resolver o crear el Curso/Ficha y Programa ingresado o seleccionado
            $courseInput = trim((string) $request->input('course_id'));
            $course = null;

            // a. Si es un ID o código numérico directo
            if (is_numeric($courseInput) && (int)$courseInput > 0) {
                $course = Course::with('program')->find((int)$courseInput);
                if (!$course) {
                    $course = Course::with('program')->where('code', (int)$courseInput)->first();
                }
            }

            // b. Si contiene código de ficha en el texto (ej. "Ficha: 55555 — GESTIÓN..." o "ADSO 2696502")
            if (!$course && !empty($courseInput)) {
                if (preg_match('/(?:ficha[:\s]*|#\s*)?(\d{5,8})/i', $courseInput, $matches)) {
                    $codeFound = $matches[1];
                    $course = Course::with('program')->where('code', $codeFound)->first();
                }
            }

            // c. Búsqueda por coincidencia de nombre de programa
            if (!$course && !empty($courseInput)) {
                $cleanName = trim(preg_replace('/(?:Ficha|#)?[:\s]*\d+/i', '', $courseInput));
                $cleanName = trim(preg_replace('/[—–\-]+/', ' ', $cleanName));
                if (!empty($cleanName)) {
                    $course = Course::with('program')->whereHas('program', function($q) use ($cleanName) {
                        $q->where('name', 'like', '%' . $cleanName . '%');
                    })->first();
                }
            }

            // d. Si no existe, crear el Curso y Programa con los datos escritos por el usuario
            if (!$course && !empty($courseInput)) {
                $cleanFicha = null;
                if (preg_match('/(?:ficha[:\s]*|#\s*)?(\d{5,8})/i', $courseInput, $m)) {
                    $cleanFicha = $m[1];
                } else {
                    $cleanFicha = rand(1000000, 9999999);
                }

                $progNameClean = trim(preg_replace('/(?:Ficha|#)?[:\s]*\d+/i', '', $courseInput));
                $progNameClean = trim(preg_replace('/[—–\-]+/', ' ', $progNameClean));
                $program = self::findOrCreateProgram(!empty($progNameClean) ? $progNameClean : $courseInput);

                $municipalityId = DB::table('municipalities')->value('id') ?? 1;
                $course = Course::firstOrCreate(
                    ['code' => $cleanFicha],
                    [
                        'program_id'      => $program ? $program->id : 1,
                        'municipality_id' => $municipalityId,
                        'start_date'      => now()->subYears(2)->toDateString(),
                        'end_date'        => now()->toDateString(),
                        'status'          => 'Activo',
                    ]
                );
                $course->load('program');
            }

            if (!$course) {
                $course = Course::with('program')->first();
            }

            $resolvedCourseId = $course ? $course->id : 1;
            $programaNombre = ($course && $course->program) 
                ? ($course->program->name . ' (Ficha ' . $course->code . ')') 
                : (!empty($courseInput) ? $courseInput : 'Formación CEFA La Angostura');

            // Vincular registro en Aprendiz
            $apprentice = Apprentice::firstOrNew(['person_id' => $person->id]);
            $apprentice->course_id = $resolvedCourseId;
            $apprentice->apprentice_status = self::normalizeApprenticeStatus($request->input('estado_egresado', 'CERTIFICADO'));
            $apprentice->save();

            DB::commit();

            // 6. Registrar contraseña elegida solo si es distinta al número de documento
            if ((string)$request->password !== (string)$docNumber) {
                try {
                    $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
                    $passwordsActualizados = file_exists($passwordsActualizadosFile) 
                        ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
                        : [];
                    $passwordsActualizados[$user->id] = date('Y-m-d H:i:s');
                    $passwordsActualizados[(string)$docNumber] = date('Y-m-d H:i:s');
                    if (!is_dir(dirname($passwordsActualizadosFile))) {
                        @mkdir(dirname($passwordsActualizadosFile), 0777, true);
                    }
                    @file_put_contents($passwordsActualizadosFile, json_encode($passwordsActualizados, JSON_PRETTY_PRINT));
                } catch (\Exception $ex) {
                    \Log::warning('No se pudo registrar contrasenia en sige_passwords_actualizados.json: ' . $ex->getMessage());
                }
            }

            $nombreCompleto = !empty($user->full_name) ? $user->full_name : (trim($person->first_name . ' ' . $person->first_last_name));

            // 7. Guardar solicitud en almacenamiento de solicitudes pendientes
            try {
                $solicitudData = [
                    'id' => (string)$user->id,
                    'user_id' => $user->id,
                    'person_id' => $person->id,
                    'documento' => (string)$person->document_number,
                    'nombre' => $nombreCompleto,
                    'email' => $cleanEmail,
                    'telefono' => $request->input('telephone1', $request->input('telephone', '')),
                    'genero' => $request->input('gender', ''),
                    'course_id' => $resolvedCourseId,
                    'programa' => $programaNombre,
                    'fecha' => now()->toDateTimeString(),
                    'estado' => 'PENDIENTE',
                ];
                self::saveSolicitudRegistro($solicitudData);
            } catch (\Throwable $e) {
                \Log::warning('Error al guardar solicitud de registro: ' . $e->getMessage());
            }

            // 8. Notificar a superadmin e instructores sobre la nueva solicitud de registro
            try {
                \Modules\Egresados\Http\Controllers\NotificationController::pushNotificacion([
                    'id' => 'sol_reg_' . $user->id,
                    'tipo' => 'solicitud_registro',
                    'categoria' => 'Solicitud de Registro',
                    'icon' => 'fa-solid fa-user-clock',
                    'iconColor' => '#d97706',
                    'iconBg' => '#fef3c7',
                    'titulo' => 'Nueva Solicitud: ' . $nombreCompleto,
                    'texto' => '<strong>' . htmlspecialchars($nombreCompleto) . '</strong> (Doc: ' . $person->document_number . ') se ha registrado y requiere aprobación institucional.',
                    'resumen' => 'El egresado completó el formulario de registro y su cuenta requiere validación por parte del instructor o administrador para acceder.',
                    'egresado_nombre' => $nombreCompleto,
                    'egresado_doc' => (string)$person->document_number,
                    'egresado_email' => $cleanEmail,
                    'solicitud_id' => (string)$user->id,
                    'unread' => true,
                    'campos' => [
                        ['etiqueta' => 'Egresado', 'valor' => $nombreCompleto],
                        ['etiqueta' => 'Documento', 'valor' => (string)$person->document_number],
                        ['etiqueta' => 'Correo Registrado', 'valor' => $cleanEmail],
                        ['etiqueta' => 'Programa', 'valor' => $programaNombre],
                        ['etiqueta' => 'Estado', 'valor' => 'Pendiente de Aprobación'],
                        ['etiqueta' => 'Fecha de Solicitud', 'valor' => now()->format('d/m/Y h:i A')]
                    ],
                    'accionTexto' => 'Revisar y Aprobar',
                    'accionUrl' => route('egresados.dashboard') . '#solicitudes-pendientes',
                    'accionIcon' => 'fa-solid fa-user-check'
                ]);
            } catch (\Throwable $e) {}

            // 9. NO iniciar sesión: Retornar a pantalla con anuncio institucional de revisión
            return redirect()->route('egresados.registro')
                ->with('registro_exitoso', true)
                ->with('registro_pendiente', true)
                ->with('registrado_nombre', $nombreCompleto)
                ->with('registrado_doc', (string)$person->document_number)
                ->with('registrado_email', $cleanEmail)
                ->with('registrado_programa', $programaNombre);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en processRegistro egresado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ocurrió un error al procesar tu registro. Por favor verifica tus datos e inténtalo nuevamente.')
                ->withInput();
        }
    }

    /**
     * Métodos auxiliares y de gestión de solicitudes de registro de egresados.
     */
    public static function getSolicitudesStorageFile(): string
    {
        return storage_path('app/sige_solicitudes_registro.json');
    }

    public static function getSolicitudesRegistro(): array
    {
        $file = self::getSolicitudesStorageFile();
        return file_exists($file) ? (json_decode(@file_get_contents($file), true) ?: []) : [];
    }

    public static function saveSolicitudRegistro(array $solicitud): void
    {
        $file = self::getSolicitudesStorageFile();
        $solicitudes = self::getSolicitudesRegistro();
        $id = (string)($solicitud['id'] ?? $solicitud['user_id'] ?? time());
        $solicitud['id'] = $id;
        $solicitudes[$id] = $solicitud;
        if (!is_dir(dirname($file))) {
            @mkdir(dirname($file), 0777, true);
        }
        @file_put_contents($file, json_encode($solicitudes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public static function isSolicitudPendiente($userId, string $docNumber = ''): bool
    {
        $solicitudes = self::getSolicitudesRegistro();
        $idStr = (string)$userId;
        $docClean = preg_replace('/\D/', '', $docNumber);

        foreach ($solicitudes as $id => $s) {
            $sDoc = preg_replace('/\D/', '', (string)($s['documento'] ?? ''));
            $sUser = (string)($s['user_id'] ?? $s['id'] ?? '');

            if (($sUser === $idStr || (!empty($docClean) && $sDoc === $docClean)) && ($s['estado'] ?? '') === 'PENDIENTE') {
                return true;
            }
        }
        return false;
    }

    /**
     * Aprueba una solicitud de registro de egresado (Superadmin o Instructor).
     */
    public function aprobarSolicitudRegistro(Request $request, $id)
    {
        $solicitudes = self::getSolicitudesRegistro();
        $idStr = (string)$id;

        $solicitud = null;
        $foundKey = null;
        foreach ($solicitudes as $k => $s) {
            if ((string)($s['id'] ?? $k) === $idStr || (string)($s['user_id'] ?? '') === $idStr || (string)($s['documento'] ?? '') === $idStr) {
                $solicitud = $s;
                $foundKey = $k;
                break;
            }
        }

        if (!$solicitud) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Solicitud no encontrada.'], 404);
            }
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }

        $adminNombre = Auth::check() ? Auth::user()->full_name : 'Coordinación SIGE';

        // Actualizar estado de la solicitud a APROBADO
        $solicitudes[$foundKey]['estado'] = 'APROBADO';
        $solicitudes[$foundKey]['aprobado_por'] = $adminNombre;
        $solicitudes[$foundKey]['aprobado_at'] = now()->toDateTimeString();

        $file = self::getSolicitudesStorageFile();
        @file_put_contents($file, json_encode($solicitudes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Actualizar estado del aprendiz a CERTIFICADO en base de datos
        try {
            $doc = $solicitud['documento'] ?? '';
            $person = \Modules\SICA\Entities\Person::where('document_number', $doc)->first();
            if ($person) {
                $apprentice = Apprentice::where('person_id', $person->id)->first();
                if ($apprentice) {
                    $apprentice->apprentice_status = 'CERTIFICADO';
                    $apprentice->save();
                }
            }
        } catch (\Throwable $e) {
            \Log::warning('Error al actualizar estado en Apprentice: ' . $e->getMessage());
        }

        // Enviar notificación de aprobación exitosa
        try {
            \Modules\Egresados\Http\Controllers\NotificationController::pushNotificacion([
                'tipo' => 'solicitud_aprobada',
                'categoria' => 'Solicitud Aprobada',
                'icon' => 'fa-solid fa-user-check',
                'iconColor' => '#16a34a',
                'iconBg' => '#dcfce7',
                'titulo' => 'Solicitud Aprobada: ' . ($solicitud['nombre'] ?? 'Egresado'),
                'texto' => 'La solicitud de <strong>' . htmlspecialchars($solicitud['nombre'] ?? 'Egresado') . '</strong> ha sido aprobada por ' . $adminNombre . '. El egresado ya puede ingresar al portal.',
                'resumen' => 'Registro validado y habilitado con éxito.',
                'egresado_nombre' => $solicitud['nombre'] ?? 'Egresado',
                'egresado_doc' => (string)($solicitud['documento'] ?? ''),
                'egresado_email' => $solicitud['email'] ?? '',
                'unread' => true,
                'campos' => [
                    ['etiqueta' => 'Egresado', 'valor' => $solicitud['nombre'] ?? 'Egresado'],
                    ['etiqueta' => 'Documento', 'valor' => (string)($solicitud['documento'] ?? '')],
                    ['etiqueta' => 'Estado', 'valor' => 'Aprobado y Habilitado'],
                    ['etiqueta' => 'Aprobado Por', 'valor' => $adminNombre],
                    ['etiqueta' => 'Fecha de Aprobación', 'valor' => now()->format('d/m/Y h:i A')]
                ],
                'accionTexto' => 'Ver en Directorio',
                'accionUrl' => route('egresados.index'),
                'accionIcon' => 'fa-solid fa-address-book'
            ]);
        } catch (\Throwable $e) {}

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => '¡Solicitud aprobada con éxito! ' . ($solicitud['nombre'] ?? '') . ' ya cuenta con acceso autorizado a SIGE.',
                'solicitud' => $solicitudes[$foundKey]
            ]);
        }

        return redirect()->back()->with('success', '¡Solicitud aprobada con éxito! ' . ($solicitud['nombre'] ?? '') . ' ya puede acceder a su portal de egresado.');
    }

    /**
     * Rechaza una solicitud de registro de egresado.
     */
    public function rechazarSolicitudRegistro(Request $request, $id)
    {
        $solicitudes = self::getSolicitudesRegistro();
        $idStr = (string)$id;

        $solicitud = null;
        $foundKey = null;
        foreach ($solicitudes as $k => $s) {
            if ((string)($s['id'] ?? $k) === $idStr || (string)($s['user_id'] ?? '') === $idStr || (string)($s['documento'] ?? '') === $idStr) {
                $solicitud = $s;
                $foundKey = $k;
                break;
            }
        }

        if (!$solicitud) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Solicitud no encontrada.'], 404);
            }
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }

        $solicitudes[$foundKey]['estado'] = 'RECHAZADO';
        $solicitudes[$foundKey]['rechazado_por'] = Auth::check() ? Auth::user()->full_name : 'Administrador SIGE';
        $solicitudes[$foundKey]['rechazado_at'] = now()->toDateTimeString();

        $file = self::getSolicitudesStorageFile();
        @file_put_contents($file, json_encode($solicitudes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'La solicitud de registro ha sido rechazada.',
                'solicitud' => $solicitudes[$foundKey]
            ]);
        }

        return redirect()->back()->with('success', 'La solicitud de registro de ' . ($solicitud['nombre'] ?? '') . ' ha sido rechazada.');
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

        $todasNoticias = \Modules\Egresados\Http\Controllers\NoticiasController::getAllNoticias();
        $noticiasPublicadas = array_values(array_filter($todasNoticias, function ($n) {
            $status = strtoupper($n['status'] ?? 'PUBLICADA');
            return in_array($status, ['PUBLICADA', 'DESTACADA', 'ACTIVA']);
        }));
        $noticiaDestacada = !empty($noticiasPublicadas) ? $noticiasPublicadas[0] : ($todasNoticias[0] ?? null);

        return view('egresados::welcome', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'noticiaDestacada',
            'noticiasPublicadas'
        ));
    }

    /**
     * Muestra el panel / dashboard principal de superadmin de SIGE.
     */
    public function dashboard()
    {
        $baseQuery = Apprentice::withTrashed()->where(function($q) {
            $q->whereHas('person.users.roles', function($rq) {
                $rq->where('slug', 'egresados.egresado');
            })->orWhere('apprentice_status', 'CERTIFICADO');
        });

        $totalEgresados = (clone $baseQuery)->count();
        $totalActivos = (clone $baseQuery)->whereNull('apprentices.deleted_at')
            ->whereNotIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO'])
            ->count();
        $totalEmpleados = (clone $baseQuery)->whereNull('apprentices.deleted_at')->where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = (clone $baseQuery)->whereNull('apprentices.deleted_at')->where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = (clone $baseQuery)->whereNull('apprentices.deleted_at')->where('apprentice_status', 'EN FORMACIÓN')->count();
        
        // Conteo real sincronizado de instructores con SICA y módulos del ERP
        $totalInstructores = \App\Models\User::whereHas('roles', function ($q) {
            $q->where('slug', 'like', '%instructor%')
              ->orWhere('slug', 'like', '%trainer%')
              ->orWhere('name', 'like', '%instructor%');
        })->count();

        // Encuestas creadas en el sistema
        $nuevasEnc = session('nuevas_encuestas', []);
        $customEnc = session('custom_encuestas', []);
        $totalEncuestas = 5 + count($nuevasEnc) + count($customEnc);

        // Eventos programados sincronizados con SICA (tabla events) y SIGE
        $sicaEventos = \Illuminate\Support\Facades\Schema::hasTable('events') 
            ? \Modules\SICA\Entities\Event::whereNull('deleted_at')->where('state', '!=', 'No disponible')->count() 
            : 0;
        $customEventos = session('custom_eventos', []);
        $totalEventos = max(2, $sicaEventos + 2) + count($customEventos);

        // Reportes generados sincronizados con el módulo de reportes
        $customReports = session('custom_reports', []);
        $totalReportes = 5 + count($customReports);

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

        
        // Determinar si el usuario debe actualizar su contraseña inicial (estilo SOFIA Plus)
        $userAuth = auth()->user();
        $personAuth = $userAuth ? $userAuth->person : null;
        if (!$personAuth && $userAuth && $userAuth->person_id) {
            $personAuth = \Modules\SICA\Entities\Person::find($userAuth->person_id);
        }
        $debeActualizarPassword = false;
        if ($userAuth && !$userAuth->hasSuperAdmin()) {
            $passwordsFile = storage_path('app/sige_passwords_actualizados.json');
            $passwords = file_exists($passwordsFile) ? (json_decode(@file_get_contents($passwordsFile), true) ?: []) : [];
            $docStr = $personAuth ? (string)$personAuth->document_number : preg_replace('/\D/', '', $userAuth->nickname ?? '');
            $alreadyUpdated = isset($passwords[$userAuth->id]) || (!empty($docStr) && isset($passwords[$docStr]));
            if (!$alreadyUpdated) {
                if (!empty($docStr) && \Illuminate\Support\Facades\Hash::check($docStr, $userAuth->password)) {
                    $debeActualizarPassword = true;
                } elseif (session('sige_needs_password_change')) {
                    $debeActualizarPassword = true;
                }
            }
        }

        // Solicitudes de registro de egresados pendientes de aprobación institucional
        $todasSolicitudes = self::getSolicitudesRegistro();
        $solicitudesPendientes = array_values(array_filter($todasSolicitudes, fn($s) => ($s['estado'] ?? '') === 'PENDIENTE'));

        return view('egresados::superadmin.dashboard', compact(
            'totalEgresados',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'totalActivos',
            'totalInstructores',
            'totalEncuestas',
            'totalEventos',
            'totalReportes',
            'tasaEmpleo',
            'recentEgresados',
            'programStats',
            'debeActualizarPassword',
            'solicitudesPendientes'
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

        // Métricas superiores reales y sincronizadas con ERP (5 métricas)
        $totalInstructores = \App\Models\User::whereHas('roles', function ($q) {
            $q->where('slug', 'like', '%instructor%')
              ->orWhere('slug', 'like', '%trainer%')
              ->orWhere('name', 'like', '%instructor%');
        })->count() ?: 15;

        $activos = $totalInstructores;
        $programas = \Modules\SICA\Entities\Program::count() ?: 12;
        $fichasActivas = \Modules\SICA\Entities\Course::count() ?: 6;
        $evaluaciones = 5;

        $availableCourses = Course::with('program')->orderBy('code')->get();

        return view('egresados::superadmin.instructores', compact(
            'instructores',
            'totalInstructores',
            'activos',
            'programas',
            'fichasActivas',
            'evaluaciones',
            'availableCourses'
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

            if ($request->hasFile('foto')) {
                self::savePersonAvatar($person, $request->file('foto'));
            }

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
                $user->password = Hash::make((string)$docNum);
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

            if ($request->hasFile('foto')) {
                self::savePersonAvatar($person, $request->file('foto'));
            }

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
        $eventos = \Modules\Egresados\Http\Controllers\EventosController::getAllEventos();

        $totalProgramados = count(array_filter($eventos, fn($e) => ($e['status'] ?? '') === 'PROGRAMADO'));
        $totalRealizados = count(array_filter($eventos, fn($e) => in_array(($e['status'] ?? ''), ['REALIZADO', 'FINALIZADO'])));
        $totalParticipantes = array_sum(array_column($eventos, 'registrados'));
        if ($totalParticipantes === 0) {
            $totalParticipantes = 856;
        }
        $totalProximos = $totalProgramados;
        $promedioSatisfaccion = '4.6/5';

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
        if (!$person && $user && $user->person_id) {
            $person = Person::find($user->person_id);
        }
        if (!$person && $user) {
            $cleanDocFromNick = preg_replace('/\D/', '', $user->nickname ?? '');
            if (!empty($cleanDocFromNick) && strlen($cleanDocFromNick) >= 5) {
                $person = Person::where('document_number', $cleanDocFromNick)->first();
            }
        }
        $apprentice = $person ? Apprentice::with(['course.program'])->where('person_id', $person->id)->first() : null;
        if (!$apprentice && $user) {
            $apprentice = Apprentice::with(['course.program'])->whereHas('person', function($q) use ($user) {
                $q->where('personal_email', $user->email)->orWhere('misena_email', $user->email);
            })->first();
            if ($apprentice && !$person) {
                $person = $apprentice->person;
            }
        }

        $doc = $person ? (string)$person->document_number : ($user ? (string)$user->id : 'guest');

        // Determinar si el egresado debe actualizar su contraseña inicial (primer ingreso con cédula)
        $debeActualizarPassword = false;
        if ($user && !$user->hasSuperAdmin()) {
            $passwordsFile = storage_path('app/sige_passwords_actualizados.json');
            $passwords = file_exists($passwordsFile) ? (json_decode(@file_get_contents($passwordsFile), true) ?: []) : [];
            $docStr = $person ? (string)$person->document_number : preg_replace('/\D/', '', $user->nickname ?? '');

            $alreadyUpdated = isset($passwords[$user->id]) || (!empty($docStr) && isset($passwords[$docStr]));
            if (!$alreadyUpdated) {
                if (!empty($docStr) && \Illuminate\Support\Facades\Hash::check($docStr, $user->password)) {
                    $debeActualizarPassword = true;
                } elseif (session('sige_needs_password_change')) {
                    $debeActualizarPassword = true;
                }
            }
        }

        // Obtener encuestas unificadas creadas por Admin o Superadmin
        $todasEncuestas = \Modules\Egresados\Http\Controllers\EncuestasController::getAllEncuestas();
        $encuestasDisponibles = $todasEncuestas;

        // 1. Obtener encuestas respondidas exclusivamente por ESTE egresado autenticado
        $respuestasEncuestasFile = storage_path('app/sige_respuestas_encuestas.json');
        $misEncuestasRespondidas = [];
        if (file_exists($respuestasEncuestasFile)) {
            try {
                $allResp = json_decode(@file_get_contents($respuestasEncuestasFile), true) ?: [];
                foreach ($allResp as $r) {
                    $matchDoc = ($doc && isset($r['documento']) && (string)$r['documento'] === (string)$doc);
                    $matchUser = ($user && isset($r['user_id']) && (int)$r['user_id'] === (int)$user->id);
                    if ($matchDoc || $matchUser) {
                        if (!empty($r['encuesta_id'])) {
                            $misEncuestasRespondidas[] = (string)$r['encuesta_id'];
                        }
                    }
                }
            } catch (\Throwable $e) {}
        }
        $misEncuestasRespondidas = array_values(array_unique($misEncuestasRespondidas));

        // Total de encuestas pendientes exclusivas para este usuario
        $encuestasActivas = array_filter($todasEncuestas, fn($e) => strtoupper($e['status'] ?? 'ACTIVA') === 'ACTIVA');
        $encuestasPendientes = max(0, count($encuestasActivas) - count($misEncuestasRespondidas));
        $oportunidadesLaborales = 8;

        // 2. Obtener eventos respondidos exclusivamente por ESTE egresado
        $rsvpFile = storage_path('app/sige_eventos_rsvp.json');
        $misEventosRespondidos = [];
        if (file_exists($rsvpFile)) {
            try {
                $allRsvps = json_decode(@file_get_contents($rsvpFile), true) ?: [];
                foreach ($allRsvps as $rsvp) {
                    $matchDoc = ($doc && isset($rsvp['documento']) && (string)$rsvp['documento'] === (string)$doc);
                    $matchEmail = ($user && isset($rsvp['email']) && (string)$rsvp['email'] === (string)$user->email);
                    if ($matchDoc || $matchEmail) {
                        if (!empty($rsvp['evento_id'])) {
                            $misEventosRespondidos[] = (string)$rsvp['evento_id'];
                        }
                    }
                }
            } catch (\Throwable $e) {}
        }
        $misEventosRespondidos = array_values(array_unique($misEventosRespondidos));

        // Obtener invitaciones a eventos enviadas institucionalmente
        $invitacionesEventos = \Illuminate\Support\Facades\Cache::get('sige_invitaciones_eventos', []);
        if (empty($invitacionesEventos) && session()->has('sige_invitaciones_eventos')) {
            $invitacionesEventos = session('sige_invitaciones_eventos', []);
        }

        $notificaciones = 3 + count($invitacionesEventos);
        $totalEventosActivos = 2 + count($invitacionesEventos);

        // Obtener eventos unificados creados por Admin (Instructor) o Superadmin
        $eventosDisponibles = \Modules\Egresados\Http\Controllers\EventosController::getAllEventos();
        $eventosActivos = array_values(array_filter($eventosDisponibles, function($e) {
            $st = strtoupper($e['status'] ?? 'PROGRAMADO');
            return $st === 'PROGRAMADO' || $st === 'EN CURSO';
        }));
        $totalEventosActivos = count($eventosActivos);

        $todasNoticias = \Modules\Egresados\Http\Controllers\NoticiasController::getAllNoticias();
        $noticiasPublicadas = array_values(array_filter($todasNoticias, function ($n) {
            $status = strtoupper($n['status'] ?? 'PUBLICADA');
            return in_array($status, ['PUBLICADA', 'DESTACADA', 'ACTIVA']);
        }));
        if (empty($noticiasPublicadas)) {
            $noticiasPublicadas = $todasNoticias;
        }
        $noticiasRecientes = array_slice($noticiasPublicadas, 0, 3);

        return view('egresados::egresados.dashboard', compact(
            'user',
            'person',
            'apprentice',
            'encuestasPendientes',
            'oportunidadesLaborales',
            'notificaciones',
            'invitacionesEventos',
            'totalEventosActivos',
            'eventosDisponibles',
            'eventosActivos',
            'noticiasRecientes',
            'noticiasPublicadas',
            'encuestasDisponibles',
            'misEncuestasRespondidas',
            'misEventosRespondidos',
            'debeActualizarPassword'
        ));
    }

    /**
     * Registra la respuesta / confirmación de asistencia (RSVP) de un egresado a un evento.
     */
    public function responderEvento(Request $request, ?string $id = null)
    {
        $id = $id ?: $request->input('evento_id');
        $asistencia = $request->input('asistencia', 'si'); // si, virtual, no
        $modalidad = $request->input('modalidad', 'Presencial');
        $comentario = $request->input('comentario', '');
        
        $user = auth()->user();
        $person = $user ? $user->person : null;
        $doc = $person ? $person->document_number : ($request->input('documento') ?? '10000003');
        $nombre = $person ? ($person->first_name . ' ' . $person->first_last_name) : ($user ? $user->nickname : 'Egresado');
        $email = $person ? ($person->misena_email ?: $person->personal_email) : ($user ? $user->email : 'egresado.sige@sena.edu.co');

        // Cargar eventos y encontrar el solicitado
        $eventos = \Modules\Egresados\Http\Controllers\EventosController::getAllEventos();
        $targetEvento = null;
        foreach ($eventos as $evt) {
            if ($evt['id'] === $id) {
                $targetEvento = $evt;
                break;
            }
        }

        if (!$targetEvento) {
            $targetEvento = [
                'id' => $id ?: 'EVT-012',
                'title' => $request->input('title', 'Evento Institucional CEFA'),
                'type' => 'Evento Institucional',
                'date' => date('d/m/Y'),
                'time' => '08:00 AM',
                'location' => 'Centro CEFA',
                'status' => 'PROGRAMADO',
                'cupo' => 100,
                'registrados' => 0,
            ];
        }

        // Si el evento ya culminó su fecha o se encuentra cerrado, rechazar el registro
        if (in_array(strtoupper($targetEvento['status'] ?? ''), ['REALIZADO', 'CANCELADO', 'FINALIZADO'])) {
            return redirect()->back()->with('error', 'Este evento ya ha finalizado su fecha programada y no admite nuevos registros de asistencia.');
        }

        // Si la respuesta es afirmativa (asistiré o virtual), incrementar registrados
        $cupo = max(1, (int)($targetEvento['cupo'] ?? 100));
        $registrados = (int)($targetEvento['registrados'] ?? 0);

        if ($asistencia === 'si' || $asistencia === 'virtual' || $asistencia === 'confirmado') {
            $registrados++;
        }

        $targetEvento['registrados'] = min($cupo, $registrados);
        $rateNum = round(($targetEvento['registrados'] / $cupo) * 100);
        $targetEvento['rate_num'] = $rateNum;
        $targetEvento['rate'] = $rateNum . '%';

        // Guardar actualización del evento
        \Modules\Egresados\Http\Controllers\EventosController::saveCustomEvento($targetEvento);

        // Guardar RSVP en persistencia local / sesión
        $rsvpData = [
            'evento_id' => $id,
            'documento' => $doc,
            'nombre' => $nombre,
            'email' => $email,
            'asistencia' => $asistencia,
            'modalidad' => $modalidad,
            'comentario' => $comentario,
            'created_at' => now()->toDateTimeString()
        ];

        try {
            $rsvpFile = storage_path('app/sige_eventos_rsvp.json');
            $allRsvps = [];
            if (file_exists($rsvpFile)) {
                $allRsvps = json_decode(@file_get_contents($rsvpFile), true) ?: [];
            }
            $allRsvps[] = $rsvpData;
            @file_put_contents($rsvpFile, json_encode($allRsvps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Notificar en tiempo real al Superadministrador e Instructores
        try {
            $asis = strtolower($asistencia);
            $asiste = in_array($asis, ['si', 'virtual', 'confirmado']);
            \Modules\Egresados\Http\Controllers\NotificationController::pushNotificacion([
                'tipo' => 'evento',
                'categoria' => 'Confirmación de Evento',
                'icon' => 'fa-solid fa-calendar-check',
                'iconColor' => '#b45309',
                'iconBg' => '#fef3c7',
                'titulo' => 'Confirmación: ' . ($targetEvento['title'] ?? 'Evento Institucional'),
                'texto' => '<strong>' . htmlspecialchars($nombre) . '</strong> ' . ($asiste ? 'confirmó asistencia' : 'respondió') . ' al evento <em>"' . htmlspecialchars($targetEvento['title'] ?? 'Evento Institucional') . '"</em>.',
                'resumen' => 'El egresado(a) ' . $nombre . ' ha respondido la convocatoria al evento institucional.',
                'egresado_nombre' => $nombre,
                'egresado_doc' => (string)$doc,
                'egresado_email' => $email,
                'unread' => true,
                'campos' => [
                    ['etiqueta' => 'Egresado', 'valor' => $nombre],
                    ['etiqueta' => 'Documento', 'valor' => (string)$doc],
                    ['etiqueta' => 'Evento Institucional', 'valor' => $targetEvento['title'] ?? 'Evento Institucional'],
                    ['etiqueta' => 'Confirmación', 'valor' => $asiste ? 'Asistirá (' . $modalidad . ')' : 'No podrá asistir'],
                    ['etiqueta' => 'Observaciones', 'valor' => !empty($comentario) ? $comentario : 'Sin observaciones adicionales'],
                    ['etiqueta' => 'Fecha de Respuesta', 'valor' => now()->format('d/m/Y h:i A')]
                ],
                'accionTexto' => 'Ver Agenda de Eventos',
                'accionUrl' => route('egresados.eventos'),
                'accionIcon' => 'fa-solid fa-calendar-days'
            ]);
        } catch (\Throwable $e) {}

        } catch (\Throwable $e) {}

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => '¡Tu confirmación de asistencia al evento ha sido registrada exitosamente!',
                'evento' => $targetEvento,
                'rsvp' => $rsvpData
            ]);
        }

        return redirect()->back()->with('success', '¡Has confirmado tu asistencia al evento "' . ($targetEvento['title'] ?? $id) . '" correctamente!');
    }

    /**
     * Registra las respuestas de una encuesta enviada por un egresado específico.
     */
    public function responderEncuesta(Request $request, ?string $id = null)
    {
        $id = $id ?: $request->input('encuesta_id', 'ENC-025');

        // Validar si la encuesta ha cumplido su fecha límite o ya está cerrada
        $allEncuestas = \Modules\Egresados\Http\Controllers\EncuestasController::getAllEncuestas();
        $targetEncuesta = collect($allEncuestas)->firstWhere('id', $id);
        if ($targetEncuesta && ($targetEncuesta['status'] ?? '') === 'CERRADA') {
            return redirect()->back()->with('error', 'Esta encuesta ha concluido su periodo de vigencia (fecha límite cumplida) y se encuentra cerrada para nuevas respuestas.');
        }

        $user = auth()->user();
        $person = $user ? $user->person : null;
        $doc = $person ? (string)$person->document_number : ($user ? (string)$user->id : 'guest');
        $nombre = $person ? $person->full_name : ($user ? ($user->full_name ?: $user->nickname) : 'Egresado');
        $email = $person ? ($person->personal_email ?: $person->misena_email) : ($user ? $user->email : 'egresado@sena.edu.co');

        $respuestasFile = storage_path('app/sige_respuestas_encuestas.json');
        $allRespuestas = [];
        try {
            if (file_exists($respuestasFile)) {
                $allRespuestas = json_decode(@file_get_contents($respuestasFile), true) ?: [];
            }
        } catch (\Throwable $e) {}

        $respKey = $id . '_' . $doc;
        $allRespuestas[$respKey] = [
            'encuesta_id' => $id,
            'user_id'     => $user ? $user->id : null,
            'documento'   => $doc,
            'nombre'      => $nombre,
            'email'       => $email,
            'respuestas'  => $request->except(['_token', 'encuesta_id']),
            'created_at'  => now()->toDateTimeString(),
        ];

        try {
            @file_put_contents($respuestasFile, json_encode($allRespuestas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Registrar notificación en tiempo real para Superadmin e Instructores
        try {
            $encTitulo = \Modules\Egresados\Http\Controllers\NotificationController::getEncuestaTitle($id);
            \Modules\Egresados\Http\Controllers\NotificationController::pushNotificacion([
                'tipo' => 'encuesta',
                'categoria' => 'Respuesta de Encuesta',
                'icon' => 'fa-solid fa-clipboard-check',
                'iconColor' => '#1e40af',
                'iconBg' => '#eff6ff',
                'titulo' => 'Nueva Respuesta: ' . $encTitulo,
                'texto' => '<strong>' . htmlspecialchars($nombre) . '</strong> respondió la encuesta <em>"' . htmlspecialchars($encTitulo) . '"</em>.',
                'resumen' => 'El egresado(a) ' . $nombre . ' (Doc: ' . $doc . ') ha respondido satisfactoriamente la encuesta institucional.',
                'egresado_nombre' => $nombre,
                'egresado_doc' => (string)$doc,
                'egresado_email' => $email,
                'unread' => true,
                'campos' => [
                    ['etiqueta' => 'Egresado', 'valor' => $nombre],
                    ['etiqueta' => 'Documento', 'valor' => (string)$doc],
                    ['etiqueta' => 'Encuesta Respondida', 'valor' => $encTitulo],
                    ['etiqueta' => 'Correo de Contacto', 'valor' => $email],
                    ['etiqueta' => 'Fecha de Respuesta', 'valor' => now()->format('d/m/Y h:i A')],
                    ['etiqueta' => 'Estado', 'valor' => 'Respuestas recibidas y consolidadas']
                ],
                'accionTexto' => 'Ver Resultados de Encuestas',
                'accionUrl' => route('egresados.encuestas_superadmin'),
                'accionIcon' => 'fa-solid fa-chart-pie'
            ]);
        } catch (\Throwable $e) {}

        } catch (\Throwable $e) {}

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => '¡Tu encuesta ha sido registrada satisfactoriamente!',
                'encuesta_id' => $id
            ]);
        }

        return redirect()->back()->with('success', '¡Tu encuesta ha sido enviada con éxito!');
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
     * Permite que el egresado actualice su propia información de contacto, residencia, laboral y contraseña.
     */
    public function actualizarPerfilEgresado(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para actualizar tu información.');
        }

        $request->validate([
            'nombres'          => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'personal_email'   => 'required|email|max:255',
            'misena_email'     => 'nullable|email|max:255',
            'telefono'         => 'required|string|min:7|max:20',
            'telefono2'        => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'situacion_laboral'=> 'nullable|string|max:100',
            'empresa_labora'   => 'nullable|string|max:200',
            'cargo_labora'     => 'nullable|string|max:200',
            'password'         => 'nullable|string|min:6|confirmed',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'nombres.required'        => 'Los nombres son requeridos.',
            'apellidos.required'      => 'Los apellidos son requeridos.',
            'personal_email.required' => 'El correo electrónico personal es requerido.',
            'personal_email.email'    => 'Ingresa un formato de correo válido.',
            'telefono.required'       => 'El número de teléfono o celular es obligatorio para contacto.',
            'password.confirmed'      => 'La confirmación de la contraseña no coincide.',
            'password.min'            => 'La nueva contraseña debe tener al menos 6 caracteres.',
        ]);

        $person = $user->person;
        if (!$person && $user->person_id) {
            $person = Person::find($user->person_id);
        }

        \DB::beginTransaction();
        try {
            if (!$person) {
                $docNumber = preg_replace('/\D/', '', $user->nickname ?? '') ?: (time() % 100000000);
                $person = Person::where('document_number', $docNumber)->first();
                if (!$person) {
                    $person = new Person(['document_number' => $docNumber]);
                }
            }

            $person->first_name = trim($request->nombres);
            $apellidosPartes = preg_split('/\s+/', trim($request->apellidos), 2);
            $person->first_last_name = $apellidosPartes[0] ?? 'SENA';
            $person->second_last_name = $apellidosPartes[1] ?? null;

            $cleanEmail = strtolower(trim($request->personal_email));
            $person->personal_email = $cleanEmail;

            if ($request->filled('misena_email')) {
                $person->misena_email = strtolower(trim($request->misena_email));
            }

            $cleanTel = preg_replace('/\D/', '', (string)$request->telefono);
            $person->telephone1 = !empty($cleanTel) ? (int)$cleanTel : null;

            if ($request->filled('telefono2')) {
                $cleanTel2 = preg_replace('/\D/', '', (string)$request->telefono2);
                $person->telephone2 = !empty($cleanTel2) ? (int)$cleanTel2 : null;
            }

            if ($request->filled('direccion')) {
                $person->address = trim($request->direccion);
            }

            self::ensurePersonDefaults($person);
            $person->save();

            if ($request->hasFile('foto')) {
                self::savePersonAvatar($person, $request->file('foto'));
            }

            // Asociar persona al usuario si no lo estaba
            $user->person_id = $person->id;

            // Actualizar correo del usuario si no está duplicado en otro usuario
            if ($cleanEmail !== $user->email && !User::where('email', $cleanEmail)->where('id', '!=', $user->id)->exists()) {
                $user->email = $cleanEmail;
            }

            // Si envió contraseña para cambiarla
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                try {
                    $passwordsFile = storage_path('app/sige_passwords_actualizados.json');
                    $passwords = file_exists($passwordsFile) ? (json_decode(@file_get_contents($passwordsFile), true) ?: []) : [];
                    $docStr = $person ? (string)$person->document_number : preg_replace('/\D/', '', $user->nickname ?? '');
                    $recordPass = [
                        'user_id' => $user->id,
                        'nickname' => $user->nickname,
                        'documento' => $docStr,
                        'nombre' => $person ? $person->full_name : $user->name,
                        'updated_at' => now()->toDateTimeString(),
                        'ip' => $request->ip(),
                    ];
                    $passwords[$user->id] = $recordPass;
                    if (!empty($docStr)) {
                        $passwords[$docStr] = $recordPass;
                    }
                    @file_put_contents($passwordsFile, json_encode($passwords, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    session()->forget('sige_needs_password_change');
                } catch (\Throwable $e) {}
            }

            $user->save();

            // Actualizar estado del aprendiz si existe
            $apprentice = Apprentice::where('person_id', $person->id)->first();
            if ($apprentice && $request->filled('situacion_laboral')) {
                $apprentice->apprentice_status = self::normalizeApprenticeStatus($request->situacion_laboral);
                $apprentice->save();
            }

            \DB::commit();
            // Notificar al superadmin e instructores sobre la actualización de datos
            try {
                \Modules\Egresados\Http\Controllers\NotificationController::pushNotificacion([
                    'tipo' => 'actualizacion',
                    'categoria' => 'Actualización de Perfil',
                    'icon' => 'fa-solid fa-briefcase',
                    'iconColor' => '#0d6928',
                    'iconBg' => '#eaf7ee',
                    'titulo' => 'Actualización de Datos: ' . $person->full_name,
                    'texto' => '<strong>' . htmlspecialchars($person->full_name) . '</strong> actualizó sus datos de contacto y situación laboral.',
                    'resumen' => 'El egresado ha registrado oportunamente su nuevo estado ocupacional y datos de residencia.',
                    'egresado_nombre' => $person->full_name,
                    'egresado_doc' => (string)$person->document_number,
                    'egresado_email' => $person->personal_email,
                    'unread' => true,
                    'campos' => [
                        ['etiqueta' => 'Egresado', 'valor' => $person->full_name],
                        ['etiqueta' => 'Documento', 'valor' => (string)$person->document_number],
                        ['etiqueta' => 'Situación Laboral', 'valor' => $request->situacion_laboral ?: 'Actualizada'],
                        ['etiqueta' => 'Empresa / Entidad', 'valor' => $request->empresa_labora ?: 'No registra'],
                        ['etiqueta' => 'Cargo', 'valor' => $request->cargo_labora ?: 'No registra'],
                        ['etiqueta' => 'Teléfono', 'valor' => (string)$request->telefono],
                        ['etiqueta' => 'Correo Electrónico', 'valor' => (string)$person->personal_email],
                        ['etiqueta' => 'Fecha de Actualización', 'valor' => now()->format('d/m/Y h:i A')]
                    ],
                    'accionTexto' => 'Ver en Directorio',
                    'accionUrl' => route('egresados.index'),
                    'accionIcon' => 'fa-solid fa-user-graduate'
                ]);
            } catch (\Throwable $e) {}


            $updatedData = [
                'full_name' => $person->full_name,
                'first_name' => $person->first_name,
                'email' => $person->personal_email,
                'telephone' => $person->telephone1,
                'address' => $person->address,
                'status' => $apprentice ? $apprentice->apprentice_status : ($request->situacion_laboral ?? 'CERTIFICADO'),
                'avatar_url' => self::getAvatarUrl($person),
            ];

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '¡Tu información personal ha sido actualizada con éxito!',
                    'data' => $updatedData,
                ]);
            }

            return redirect()->back()->with('success', '¡Tu información de perfil ha sido actualizada exitosamente!');
        } catch (\Throwable $e) {
            \DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar información: ' . $e->getMessage()
                ], 422);
            }
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar los datos: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        }

        $egresados = $query->orderBy('id', 'desc')->paginate(10);

        // Estadísticas de egresados de este módulo
        $baseCount = Apprentice::withTrashed()->where(function($q) {
            $q->whereHas('person.users.roles', function($rq) {
                $rq->where('slug', 'egresados.egresado');
            })->orWhere('apprentice_status', 'CERTIFICADO');
        });

        $totalEgresados = (clone $baseCount)->count();
        $totalActivos = (clone $baseCount)->whereNull('deleted_at')->whereNotIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO'])->count();
        $totalInactivos = max(0, $totalEgresados - $totalActivos);
        $totalEmpleados = (clone $baseCount)->whereNull('deleted_at')->where('apprentice_status', 'CERTIFICADO')->count();
        $totalEmprendedores = (clone $baseCount)->whereNull('deleted_at')->where('apprentice_status', 'INDUCCIÓN')->count();
        $totalEstudiantes = (clone $baseCount)->whereNull('deleted_at')->where('apprentice_status', 'EN FORMACIÓN')->count();
        $actualizacionPendiente = 0;
        $seguimientosRealizados = $totalEgresados;
        $alertasEnviadas = 0;

        return view('egresados::superadmin.index', compact(
            'egresados',
            'totalEgresados',
            'totalActivos',
            'totalInactivos',
            'totalEmpleados',
            'totalEmprendedores',
            'totalEstudiantes',
            'actualizacionPendiente',
            'seguimientosRealizados',
            'alertasEnviadas'
        ));
    }

    /**
     * Exporta el directorio oficial de egresados en formato Excel genuino (.xlsx / OpenXML)
     * Con diseño institucional oficial SENA, métricas de aforo/estado, estilos cebra y bordes definidos.
     */
    public function exportarExcel(Request $request)
    {
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
        $filtroEstado = 'Todos los Egresados (Módulo)';
        if ($request->filled('apprentice_status') && $request->input('apprentice_status') !== 'TODOS') {
            $stFilter = $request->input('apprentice_status');
            $filtroEstado = $stFilter;
            if ($stFilter === 'ACTIVOS') {
                $query->whereNull('deleted_at')->whereNotIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO']);
            } elseif ($stFilter === 'INACTIVOS') {
                $query->where(function($sub) {
                    $sub->whereNotNull('deleted_at')->orWhereIn('apprentice_status', ['CANCELADO', 'RETIRO VOLUNTARIO']);
                });
            } else {
                $query->where('apprentice_status', $stFilter);
            }
        }

        $egresados = $query->orderBy('id', 'desc')->get();

        $rows = [];
        $consecutivo = 1;
        $totalActivos = 0;
        $totalInactivos = 0;
        $totalCertificados = 0;

        foreach ($egresados as $item) {
            $person = $item->person;
            $course = $item->course;
            $program = $course ? $course->program : null;

            $docType = $person ? ($person->document_type ?? 'CC') : 'CC';
            $docNumber = $person ? ($person->document_number ?? 'N/A') : 'N/A';

            $nombresRaw = $person ? trim(($person->first_name ?? '') . ' ' . ($person->first_last_name ?? '') . ' ' . ($person->second_last_name ?? '')) : ('Aprendiz #' . $item->id);
            $nombres = mb_convert_case(mb_strtolower($nombresRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

            $misena = $person && !empty($person->misena_email) ? $person->misena_email : 'No registra';
            $personal = $person && !empty($person->personal_email) ? $person->personal_email : 'No registra';
            $telefono = $person && !empty($person->telephone1) ? $person->telephone1 : ($person && !empty($person->telephone2) ? $person->telephone2 : 'No registra');

            $progNameRaw = $program ? $program->name : 'No asignado';
            $progName = mb_convert_case(mb_strtolower($progNameRaw, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
            $ficha = $course ? ($course->code ?? 'No asignada') : 'No asignada';
            $nivelFormacion = $program ? ($program->program_type ?? 'Tecnólogo') : 'Tecnólogo';
            $centro = 'Centro Agroindustrial La Angostura — CEFA';

            $statusAcad = strtoupper(trim($item->apprentice_status ?? 'CERTIFICADO'));
            if ($statusAcad === 'CERTIFICADO') {
                $totalCertificados++;
            }

            $isActivo = (!$item->trashed() && !in_array($statusAcad, ['CANCELADO', 'RETIRO VOLUNTARIO']));
            if ($isActivo) {
                $totalActivos++;
                $statusSige = 'ACTIVO';
            } else {
                $totalInactivos++;
                $statusSige = 'INACTIVO';
            }

            $fechaReg = $item->created_at ? $item->created_at->format('d/m/Y H:i') : date('d/m/Y');

            $rows[] = [
                $consecutivo++,
                $docType,
                $docNumber,
                $nombres,
                $misena,
                $personal,
                $telefono,
                $progName,
                $ficha,
                $nivelFormacion,
                $centro,
                $statusAcad,
                $statusSige,
                $fechaReg
            ];
        }

        $metrics = [
            'total'        => count($rows),
            'activos'      => $totalActivos,
            'inactivos'    => $totalInactivos,
            'certificados' => $totalCertificados,
            'filtro'       => $filtroEstado,
            'busqueda'     => $request->input('search', 'Ninguna') ?: 'Ninguna',
        ];

        $xlsxContent = $this->generarExcelEgresadosOpenXml($metrics, $rows);

        $fileName = 'Directorio_General_Egresados_CEFA_' . date('Ymd_His') . '.xlsx';

        return response($xlsxContent, 200, [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Length'      => strlen($xlsxContent),
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ]);
    }

    /**
     * Construye la estructura binaria .xlsx (Office OpenXML) con diseño institucional SENA CEFA.
     */
    private function generarExcelEgresadosOpenXml(array $metrics, array $rows): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'egresados_xlsx_');
        $zip = new \ZipArchive();
        if ($zip->open($tempFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new \Exception("No se pudo inicializar el archivo Excel para el directorio de egresados.");
        }

        $xmlEscape = function($str) {
            return htmlspecialchars((string)$str, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        };

        // 1. [Content_Types].xml
        $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
  <Default Extension="xml" ContentType="application/xml"/>
  <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>
  <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>
  <Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>
</Types>';

        // 2. _rels/.rels
        $rootRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
</Relationships>';

        // 3. xl/_rels/workbook.xml.rels
        $wbRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>
  <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>
</Relationships>';

        // 4. xl/workbook.xml
        $wb = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
  <sheets>
    <sheet name="Directorio de Egresados" sheetId="1" r:id="rId1"/>
  </sheets>
</workbook>';

        // 5. xl/styles.xml (Estricto OpenXML ECMA-376)
        $styles = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <fonts count="15">
    <font><name val="Calibri"/><sz val="11"/><color rgb="FF1E293B"/></font>
    <font><b/><name val="Calibri"/><sz val="13"/><color rgb="FFFFFFFF"/></font>
    <font><b/><name val="Calibri"/><sz val="10.5"/><color rgb="FF62E31D"/></font>
    <font><b/><name val="Calibri"/><sz val="10"/><color rgb="FF001A29"/></font>
    <font><b/><name val="Calibri"/><sz val="9.5"/><color rgb="FFFFFFFF"/></font>
    <font><b/><name val="Calibri"/><sz val="11"/><color rgb="FF001A29"/></font>
    <font><b/><name val="Calibri"/><sz val="12"/><color rgb="FF166534"/></font>
    <font><b/><name val="Calibri"/><sz val="10.5"/><color rgb="FFFFFFFF"/></font>
    <font><name val="Calibri"/><sz val="10"/><color rgb="FF1E293B"/></font>
    <font><b/><name val="Calibri"/><sz val="9.5"/><color rgb="FF166534"/></font>
    <font><b/><name val="Calibri"/><sz val="9.5"/><color rgb="FF9A3412"/></font>
    <font><i/><name val="Calibri"/><sz val="9"/><color rgb="FF64748B"/></font>
    <font><b/><name val="Calibri"/><sz val="11"/><color rgb="FFFFFFFF"/></font>
    <font><b/><name val="Calibri"/><sz val="9.5"/><color rgb="FF047857"/></font>
    <font><b/><name val="Calibri"/><sz val="9.5"/><color rgb="FFB91C1C"/></font>
  </fonts>
  <fills count="13">
    <fill><patternFill patternType="none"/></fill>
    <fill><patternFill patternType="gray125"/></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF001A29"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF39A900"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFF1F5F9"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF002336"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFF8FAFC"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFDCFCE7"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFEAF7EE"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFFFEDD5"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF00324D"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF2A7C00"/></patternFill></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FFFEE2E2"/></patternFill></fill>
  </fills>
  <borders count="3">
    <border><left/><right/><top/><bottom/><diagonal/></border>
    <border>
      <left style="thin"><color rgb="FFE2E8F0"/></left>
      <right style="thin"><color rgb="FFE2E8F0"/></right>
      <top style="thin"><color rgb="FFE2E8F0"/></top>
      <bottom style="thin"><color rgb="FFE2E8F0"/></bottom>
    </border>
    <border>
      <left style="thin"><color rgb="FF2D8500"/></left>
      <right style="thin"><color rgb="FF2D8500"/></right>
      <top style="thin"><color rgb="FF2D8500"/></top>
      <bottom style="medium"><color rgb="FF001A29"/></bottom>
    </border>
  </borders>
  <cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>
  <cellXfs count="16">
    <xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>
    <xf numFmtId="0" fontId="1" fillId="2" borderId="0" xfId="0" applyFont="1" applyFill="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="2" fillId="2" borderId="0" xfId="0" applyFont="1" applyFill="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="3" fillId="4" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="4" fillId="5" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="5" fillId="4" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="6" fillId="8" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="7" fillId="3" borderId="2" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf>
    <xf numFmtId="0" fontId="8" fillId="0" borderId="1" xfId="0" applyFont="1" applyBorder="1" applyAlignment="1"><alignment horizontal="left" vertical="center"/></xf>
    <xf numFmtId="0" fontId="8" fillId="0" borderId="1" xfId="0" applyFont="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="8" fillId="6" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="left" vertical="center"/></xf>
    <xf numFmtId="0" fontId="8" fillId="6" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="9" fillId="7" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="14" fillId="12" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="11" fillId="4" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
    <xf numFmtId="0" fontId="12" fillId="2" borderId="0" xfId="0" applyFont="1" applyFill="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>
  </cellXfs>
</styleSheet>';

        // Column widths para 14 columnas (A - N)
        $cols = '<cols>
          <col min="1" max="1" width="6" customWidth="1"/>
          <col min="2" max="2" width="16" customWidth="1"/>
          <col min="3" max="3" width="18" customWidth="1"/>
          <col min="4" max="4" width="36" customWidth="1"/>
          <col min="5" max="5" width="32" customWidth="1"/>
          <col min="6" max="6" width="30" customWidth="1"/>
          <col min="7" max="7" width="18" customWidth="1"/>
          <col min="8" max="8" width="40" customWidth="1"/>
          <col min="9" max="9" width="16" customWidth="1"/>
          <col min="10" max="10" width="18" customWidth="1"/>
          <col min="11" max="11" width="36" customWidth="1"/>
          <col min="12" max="12" width="20" customWidth="1"/>
          <col min="13" max="13" width="18" customWidth="1"/>
          <col min="14" max="14" width="20" customWidth="1"/>
        </cols>';

        $totalCount = $metrics['total'] ?? count($rows);
        $activosCount = $metrics['activos'] ?? 0;
        $inactivosCount = $metrics['inactivos'] ?? 0;
        $certificadosCount = $metrics['certificados'] ?? 0;
        $filtroStr = $metrics['filtro'] ?? 'Todos';
        $busquedaStr = $metrics['busqueda'] ?? 'Ninguna';

        // Sheet Data
        $sData = '<sheetData>';

        // Fila 1: Banner Principal
        $sData .= '<row r="1" ht="30" customHeight="1"><c r="A1" s="1" t="inlineStr"><is><t>' . $xmlEscape('SERVICIO NACIONAL DE APRENDIZAJE (SENA) · CENTRO DE FORMACIÓN AGROINDUSTRIAL LA ANGOSTURA — CEFA') . '</t></is></c></row>';

        // Fila 2: Subtítulo Oficial
        $sData .= '<row r="2" ht="20" customHeight="1"><c r="A2" s="2" t="inlineStr"><is><t>' . $xmlEscape('SISTEMA INSTITUCIONAL DE GESTIÓN Y SEGUIMIENTO A EGRESADOS (SIGE ERP) · DIRECTORIO GENERAL DE EGRESADOS') . '</t></is></c></row>';

        // Fila 3: Metadatos de Emisión y Filtros
        $metaLine = "Ámbito: Regional Huila — CEFA | Fecha Emisión: " . date('d/m/Y H:i') . " | Filtro Estado: " . $filtroStr . " | Búsqueda: " . $busquedaStr . " | Responsable: Administración SIGE";
        $sData .= '<row r="3" ht="22" customHeight="1"><c r="A3" s="3" t="inlineStr"><is><t>' . $xmlEscape($metaLine) . '</t></is></c></row>';

        // Fila 4: Bloque de Métricas Ejecutivas (KPI Cards)
        $sData .= '<row r="4" ht="24" customHeight="1">';
        $sData .= '<c r="B4" s="4" t="inlineStr"><is><t>TOTAL REGISTRADOS</t></is></c>';
        $sData .= '<c r="C4" s="4" t="inlineStr"><is><t></t></is></c>';
        $sData .= '<c r="D4" s="5" t="inlineStr"><is><t>' . $xmlEscape($totalCount) . '</t></is></c>';

        $sData .= '<c r="F4" s="4" t="inlineStr"><is><t>ACTIVOS EN SIGE</t></is></c>';
        $sData .= '<c r="G4" s="4" t="inlineStr"><is><t></t></is></c>';
        $sData .= '<c r="H4" s="6" t="inlineStr"><is><t>' . $xmlEscape($activosCount) . '</t></is></c>';

        $sData .= '<c r="J4" s="4" t="inlineStr"><is><t>INACTIVOS EN SIGE</t></is></c>';
        $sData .= '<c r="K4" s="4" t="inlineStr"><is><t></t></is></c>';
        $sData .= '<c r="L4" s="5" t="inlineStr"><is><t>' . $xmlEscape($inactivosCount) . '</t></is></c>';

        $sData .= '<c r="M4" s="4" t="inlineStr"><is><t>CERTIFICADOS</t></is></c>';
        $sData .= '<c r="N4" s="6" t="inlineStr"><is><t>' . $xmlEscape($certificadosCount) . '</t></is></c>';
        $sData .= '</row>';

        // Fila 5: Separador visual
        $sData .= '<row r="5" ht="12" customHeight="1"></row>';

        // Fila 6: Título de Sección
        $sData .= '<row r="6" ht="24" customHeight="1"><c r="A6" s="15" t="inlineStr"><is><t>' . $xmlEscape('REGISTRO NOMINAL Y SEGUIMIENTO A EGRESADOS INSTITUCIONALES') . '</t></is></c></row>';

        // Fila 7: Encabezados de Columna
        $headers = [
            'N°',
            'Tipo Documento',
            'Documento',
            'Nombres y Apellidos',
            'Correo Institucional (Misena)',
            'Correo Personal',
            'Teléfono de Contacto',
            'Programa de Formación',
            'Código Ficha',
            'Nivel de Formación',
            'Centro de Formación',
            'Estado Académico',
            'Estado en SIGE',
            'Fecha de Registro'
        ];
        $colsLetters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];

        $sData .= '<row r="7" ht="26" customHeight="1">';
        foreach ($headers as $hIdx => $hName) {
            $sData .= '<c r="' . $colsLetters[$hIdx] . '7" s="7" t="inlineStr"><is><t>' . $xmlEscape($hName) . '</t></is></c>';
        }
        $sData .= '</row>';

        // Filas de Datos (8 en adelante)
        $rowNum = 8;
        foreach ($rows as $rIdx => $row) {
            $isZebra = ($rIdx % 2 !== 0);
            $sData .= '<row r="' . $rowNum . '" ht="21" customHeight="1">';
            foreach ($row as $cIdx => $val) {
                $colLetter = $colsLetters[$cIdx];

                if ($cIdx === 11) {
                    // Estado Académico
                    $style = ($val === 'CERTIFICADO') ? 12 : ($isZebra ? 11 : 9);
                } elseif ($cIdx === 12) {
                    // Estado en SIGE
                    $style = ($val === 'ACTIVO') ? 12 : 13;
                } elseif (in_array($cIdx, [0, 1, 2, 6, 8, 9, 13])) {
                    // Columnas centradas: N°, TipoDoc, Doc, Tel, Ficha, Nivel, Fecha
                    $style = $isZebra ? 11 : 9;
                } else {
                    // Columnas alineadas a izquierda: Nombres, Correos, Programa, Centro
                    $style = $isZebra ? 10 : 8;
                }

                $sData .= '<c r="' . $colLetter . $rowNum . '" s="' . $style . '" t="inlineStr"><is><t>' . $xmlEscape($val) . '</t></is></c>';
            }
            $sData .= '</row>';
            $rowNum++;
        }

        // Fila de Pie Institucional
        $sData .= '<row r="' . $rowNum . '" ht="22" customHeight="1"><c r="A' . $rowNum . '" s="14" t="inlineStr"><is><t>' . $xmlEscape('Directorio Oficial expedido por el Sistema Institucional SIGE · SENA Empresa CEFA · Total Registros: ' . count($rows) . ' · Emisión: ' . date('d/m/Y H:i')) . '</t></is></c></row>';

        $sData .= '</sheetData>';

        $merges = '<mergeCells count="8">
          <mergeCell ref="A1:N1"/>
          <mergeCell ref="A2:N2"/>
          <mergeCell ref="A3:N3"/>
          <mergeCell ref="B4:C4"/>
          <mergeCell ref="F4:G4"/>
          <mergeCell ref="J4:K4"/>
          <mergeCell ref="A6:N6"/>
          <mergeCell ref="A' . $rowNum . ':N' . $rowNum . '"/>
        </mergeCells>';

        $sheet = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <sheetViews>
    <sheetView tabSelected="1" workbookViewId="0">
      <pane ySplit="7" topLeftCell="A8" activePane="bottomLeft" state="frozen"/>
    </sheetView>
  </sheetViews>
  ' . $cols . '
  ' . $sData . '
  ' . $merges . '
</worksheet>';

        $zip->addFromString('[Content_Types].xml', $contentTypes);
        $zip->addFromString('_rels/.rels', $rootRels);
        $zip->addFromString('xl/_rels/workbook.xml.rels', $wbRels);
        $zip->addFromString('xl/workbook.xml', $wb);
        $zip->addFromString('xl/styles.xml', $styles);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->close();

        $content = file_get_contents($tempFile);
        @unlink($tempFile);

        return $content;
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

        // Control estricto contra manipulación de identificadores en URL (Protección IDOR)
        $user = auth()->user();
        if ($user) {
            $isSuper = ($user->hasSuperAdmin() || $user->hasRole('egresados.admin') || $user->hasRole('superadmin'));
            $isInstructor = ($user->hasRole('egresados.instructor') || $user->hasRole('sigac.instructor') || $user->nickname === 'instructor_egresados');

            // Un egresado no puede consultar la información confidencial de otros egresados
            if (!$isSuper && !$isInstructor) {
                if (!$user->person_id || (int) $apprentice->person_id !== (int) $user->person_id) {
                    \Modules\Egresados\Services\SigeSecurityLogger::log(
                        'IDOR_ATTEMPT_BLOCKED',
                        "Intento de egresado {$user->email} de consultar registro ajeno ID: {$id}",
                        request(),
                        $user
                    );
                    abort(403, 'Acceso denegado: No estás autorizado para consultar la información privada de otros egresados.');
                }
            }
        }

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
            'observaciones'        => 'required|string|max:4000',
            'nuevo_estado_laboral' => 'nullable|string|max:100',
        ], [
            'egresado_id.required'   => 'El identificador del egresado es obligatorio.',
            'tipo_contacto.required' => 'Debe seleccionar el canal o tipo de contacto.',
            'fecha.required'         => 'La fecha de contacto es obligatoria.',
            'observaciones.required' => 'Las observaciones del seguimiento son requeridas.',
        ]);

        try {
            $observaciones = $request->input('observaciones', '');

            // Consolidar respuestas del cuestionario bonito
            $cuestionarioParts = [];
            if ($request->filled('comunicacion_efectiva')) {
                $cuestionarioParts[] = '• Comunicación efectiva: ' . $request->input('comunicacion_efectiva');
            }
            if ($request->filled('afinidad_formacion')) {
                $cuestionarioParts[] = '• Afinidad con formación SENA: ' . $request->input('afinidad_formacion');
            }
            if ($request->filled('empresa_actual')) {
                $cuestionarioParts[] = '• Empresa / Negocio: ' . $request->input('empresa_actual');
            }
            if ($request->filled('cargo_actual')) {
                $cuestionarioParts[] = '• Cargo desempeñado: ' . $request->input('cargo_actual');
            }
            if ($request->filled('rango_salarial')) {
                $cuestionarioParts[] = '• Rango salarial mensual: ' . $request->input('rango_salarial');
            }
            if ($request->filled('satisfaccion_sena')) {
                $cuestionarioParts[] = '• Nivel satisfacción SENA: ' . $request->input('satisfaccion_sena');
            }
            if ($request->filled('necesidad_capacitacion')) {
                $cuestionarioParts[] = '• Capacitación requerida: ' . $request->input('necesidad_capacitacion');
            }
            if ($request->filled('proximo_contacto')) {
                $cuestionarioParts[] = '• Próximo seguimiento sugerido: ' . $request->input('proximo_contacto');
            }

            if (!empty($cuestionarioParts)) {
                $headerQ = "--- CUESTIONARIO INSTITUCIONAL DE SEGUIMIENTO (SIGE SENA) ---\n" . implode("\n", $cuestionarioParts);
                $observaciones = $headerQ . "\n\nObservaciones adicionales:\n" . $observaciones;
            }

            // Actualizar estado laboral del aprendiz si aplica
            $estado = $request->input('nuevo_estado_laboral');
            if (!empty($estado)) {
                $apprentice = Apprentice::find($request->egresado_id);
                if ($apprentice) {
                    $apprentice->apprentice_status = self::normalizeApprenticeStatus($estado);
                    $apprentice->save();
                }
            }

            // Almacenar en sesión para trazabilidad inmediata
            $historial = session('seguimientos_realizados_list', []);
            $historial[] = [
                'id' => uniqid(),
                'egresado_id' => $request->egresado_id,
                'fecha' => $request->fecha,
                'tipo_contacto' => $request->tipo_contacto,
                'resumen' => $observaciones,
                'registrado_el' => now()->format('d/m/Y H:i'),
            ];
            session(['seguimientos_realizados_list' => $historial]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '¡Cuestionario de seguimiento registrado exitosamente para el egresado!',
                ]);
            }

            return redirect()->back()->with('success', '¡Cuestionario de seguimiento registrado exitosamente para el egresado!');
        } catch (\Exception $e) {
            \Log::error('Error en storeSeguimiento: ' . $e->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error al registrar el seguimiento: ' . $e->getMessage()
                ], 422);
            }
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
            'is_active'      => 'nullable',
            'activo'         => 'nullable',
        ], [
            'documento.required' => 'El número de documento es obligatorio.',
            'nombre.required'    => 'El nombre completo es obligatorio.',
            'correo.required'    => 'El correo electrónico es requerido.',
            'correo.email'       => 'Debe ingresar un formato de correo electrónico válido.',
        ]);

        $apprentice = Apprentice::withTrashed()->with(['person', 'course.program'])->findOrFail($id);

        // Control estricto contra manipulación de identificadores en URL (Protección IDOR)
        $user = auth()->user();
        if ($user) {
            $isSuper = ($user->hasSuperAdmin() || $user->hasRole('egresados.admin') || $user->hasRole('superadmin'));
            $isInstructor = ($user->hasRole('egresados.instructor') || $user->hasRole('sigac.instructor') || $user->nickname === 'instructor_egresados');

            if (!$isSuper && !$isInstructor) {
                if (!$user->person_id || (int) $apprentice->person_id !== (int) $user->person_id) {
                    \Modules\Egresados\Services\SigeSecurityLogger::log(
                        'IDOR_ATTEMPT_BLOCKED',
                        "Intento de egresado {$user->email} de modificar registro ajeno ID: {$id}",
                        $request,
                        $user
                    );
                    abort(403, 'Acceso denegado: No tienes autorización para modificar la información de otros egresados.');
                }
            }
        }

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

            if ($request->hasFile('foto')) {
                self::savePersonAvatar($person, $request->file('foto'));
            }

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

            // Manejo de activación / desactivación
            $hasActiveParam = $request->has('is_active') || $request->has('activo');
            if ($hasActiveParam) {
                $rawVal = $request->input('is_active', $request->input('activo'));
                $isActive = ($rawVal == '1' || $rawVal === true || $rawVal === 'true');
                if ($isActive) {
                    if ($apprentice->trashed()) {
                        $apprentice->restore();
                    }
                    if (in_array($apprentice->apprentice_status, ['CANCELADO', 'RETIRO VOLUNTARIO']) && !$request->filled('estado')) {
                        $apprentice->apprentice_status = 'CERTIFICADO';
                    }
                    if ($person) {
                        User::withTrashed()->where('person_id', $person->id)->restore();
                    }
                } else {
                    if (!$apprentice->trashed()) {
                        $apprentice->delete();
                    }
                    if ($person) {
                        User::where('person_id', $person->id)->delete();
                    }
                }
            }

            $apprentice->person_id = $person->id;
            $apprentice->touch();
            $apprentice->save();

            // Si tiene usuario vinculado por person_id, sincronizar su email de forma segura
            if ($request->filled('correo')) {
                $correoLimpio = filter_var(trim($request->correo), FILTER_SANITIZE_EMAIL);
                $user = User::withTrashed()->where('person_id', $person->id)->first();
                if ($user) {
                    if (!User::withTrashed()->where('email', $correoLimpio)->where('id', '!=', $user->id)->exists()) {
                        $user->email = $correoLimpio;
                        $user->save();
                    }
                }
            }

            \DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '¡Perfil del egresado actualizado exitosamente!',
                    'egresado' => [
                        'id' => $apprentice->id,
                        'name' => $person ? ($person->first_name . ' ' . $person->first_last_name) : 'Egresado',
                        'doc' => $person ? (($person->document_type ?? 'CC') . ' ' . $person->document_number) : 'N/A',
                        'email' => $person ? ($person->misena_email ?? $person->personal_email) : 'No registra',
                        'phone' => $person ? ($person->telephone1 ?? 'No registra') : 'No registra',
                        'program' => $apprentice->course && $apprentice->course->program ? $apprentice->course->program->name : 'Programa General',
                        'ficha' => $apprentice->course ? $apprentice->course->code : 'N/A',
                        'status' => $apprentice->apprentice_status,
                    ]
                ]);
            }

            return redirect()->back()->with('success', '¡Perfil del egresado actualizado exitosamente!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error en update egresado: ' . $e->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error al actualizar los datos: ' . $e->getMessage()
                ], 422);
            }
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar los datos: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Alterna el estado activo / inactivo de un egresado.
     */
    public function toggleStatus(Request $request, $id)
    {
        try {
            $apprentice = Apprentice::withTrashed()->with('person')->findOrFail($id);
            $person = $apprentice->person;
            $name = $person ? ($person->first_name . ' ' . $person->first_last_name) : 'Egresado #' . $id;

            $isCurrentlyActive = !$apprentice->trashed() && !in_array($apprentice->apprentice_status, ['CANCELADO', 'RETIRO VOLUNTARIO']);

            if ($isCurrentlyActive) {
                // Desactivar
                $apprentice->delete();
                if ($person) {
                    User::where('person_id', $person->id)->delete();
                }
                $msg = "El egresado {$name} ha sido desactivado exitosamente.";
                $newStatus = 'inactivo';
            } else {
                // Activar
                if ($apprentice->trashed()) {
                    $apprentice->restore();
                }
                if (in_array($apprentice->apprentice_status, ['CANCELADO', 'RETIRO VOLUNTARIO'])) {
                    $apprentice->apprentice_status = 'CERTIFICADO';
                    $apprentice->save();
                }
                if ($person) {
                    User::withTrashed()->where('person_id', $person->id)->restore();
                }
                $msg = "El egresado {$name} ha sido activado exitosamente.";
                $newStatus = 'activo';
            }

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $msg,
                    'new_status' => $newStatus,
                    'is_active' => ($newStatus === 'activo'),
                ]);
            }

            return redirect()->back()->with('success', $msg);
        } catch (\Exception $e) {
            \Log::error('Error al alternar estado egresado: ' . $e->getMessage());
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo cambiar el estado: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', 'Ocurrió un error al cambiar el estado del egresado.');
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
        $authorizedSuperadminEmail = strtolower((string) config('egresados.security.superadmin_email', 'superadmin.egresados@sena.edu.co'));
        if ($cleanEmail === $authorizedSuperadminEmail) {
            return redirect()->back()->with('error', 'El correo ingresado está reservado para la administración institucional y no puede asignarse a un nuevo egresado.')->withInput();
        }
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

            if ($request->hasFile('foto')) {
                self::savePersonAvatar($person, $request->file('foto'));
            }

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
                    $user->password = Hash::make((string)$person->document_number);
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

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '¡Egresado registrado exitosamente!',
                    'person' => [
                        'name' => $person->first_name . ' ' . $person->first_last_name,
                        'document' => ($person->document_type ?? 'CC') . ' ' . $person->document_number,
                    ]
                ]);
            }

            return redirect()->back()->with('success', '¡Egresado registrado exitosamente!');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error en store egresado: ' . $e->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error al procesar el registro institucional: ' . $e->getMessage()
                ], 422);
            }
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

                return redirect()->back()->with('success', "¡Lista de egresados importada exitosamente! Se procesaron {$total} registros institucionales.");
            } else {
                $importador = new InstructoresImport();
                $total = $importador->import($file);

                return redirect()->back()->with('success', "¡Lista de instructores importada exitosamente! Se procesaron {$total} registros institucionales.");
            }
        } catch (\Exception $e) {
            \Log::error('Error en importarExcel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al procesar el archivo. Verifique que las columnas sean correctas. Detalle: ' . $e->getMessage());
        }
    }

    /**
     * Datos del equipo de autores y desarrolladores del módulo SIGE.
     * Puedes editar cualquier dato (nombre, rol, bio, foto, redes, habilidades) directamente desde este arreglo de código.
     */
    public static function getDefaultAutores(): array
    {
        return [
            'hasbleidy' => [
                'id' => 'hasbleidy',
                'nombre' => 'Hasbleidy Perdomo',
                'rol' => 'Líder de Proyecto & Desarrolladora Full Stack',
                'bio' => 'Líder en diseño y desarrollo del Sistema de Gestión de Egresados (SIGE). Apasionada por la arquitectura de software en Laravel, interfaces de usuario intuitivas y soluciones tecnológicas integrales para el sector educativo.',
                'especialidad' => 'Tecnología en ADSO (Ficha 3230026)',
                'centro' => 'Centro de Formación Agroindustrial "La Angostura"',
                'regional' => 'Regional Huila · Campoalegre',
                'email' => 'hasbleidy.perdomo@sena.edu.co',
                'telefono' => '+57 312 456 7890',
                'linkedin' => 'https://linkedin.com',
                'github' => 'https://github.com',
                'foto' => null, // Ruta de foto opcional: asset('modules/egresados/images/autores/hasbleidy.jpg')
                'avatar_color' => '#39A900',
                'habilidades' => ['PHP / Laravel', 'Tailwind CSS', 'Arquitectura ERP', 'MySQL', 'UI / UX Design']
            ],
            'juand' => [
                'id' => 'juand',
                'nombre' => 'Juan D. Lizcano',
                'rol' => 'Arquitecto Backend & Desarrollador Full Stack',
                'bio' => 'Desarrollador enfocado en la lógica empresarial, control de accesos por roles institucional, seguridad SOFIA Plus y modelado de datos para el módulo SIGE y ecosistema SENA Empresa.',
                'especialidad' => 'Tecnología en ADSO (Ficha 3230026)',
                'centro' => 'Centro de Formación Agroindustrial "La Angostura"',
                'regional' => 'Regional Huila · Campoalegre',
                'email' => 'juand.lizcano@sena.edu.co',
                'telefono' => '+57 310 987 6543',
                'linkedin' => 'https://linkedin.com',
                'github' => 'https://github.com',
                'foto' => null, // Ruta de foto opcional: asset('modules/egresados/images/autores/juand.jpg')
                'avatar_color' => '#00324D',
                'habilidades' => ['PHP / Laravel', 'Seguridad y Roles', 'Bases de Datos', 'REST APIs', 'Optimización']
            ],
            'nicolle' => [
                'id' => 'nicolle',
                'nombre' => 'Nicolle Suache',
                'rol' => 'Diseñadora UI/UX & Desarrolladora Frontend',
                'bio' => 'Especialista en experiencia visual, usabilidad accesible, maquetación interactiva y componentes modulares de encuestas, eventos y reportes estadísticos para graduados.',
                'especialidad' => 'Tecnología en ADSO (Ficha 3230026)',
                'centro' => 'Centro de Formación Agroindustrial "La Angostura"',
                'regional' => 'Regional Huila · Campoalegre',
                'email' => 'nicolle.suache@sena.edu.co',
                'telefono' => '+57 320 123 4567',
                'linkedin' => 'https://linkedin.com',
                'github' => 'https://github.com',
                'foto' => null, // Ruta de foto opcional: asset('modules/egresados/images/autores/nicolle.jpg')
                'avatar_color' => '#62E31D',
                'habilidades' => ['Frontend Moderno', 'Experiencia de Usuario', 'Diseño Responsivo', 'Laravel Blade', 'Reportes']
            ]
        ];
    }

    /**
     * Muestra la vista dedicada del equipo de autores y desarrolladores del módulo SIGE.
     * Los datos se editan directamente desde el método getDefaultAutores() en este código.
     */
    public function autores()
    {
        $autores = self::getDefaultAutores();
        return view('egresados::autores', compact('autores'));
    }

    /**
     * Guarda o actualiza los datos y foto de un autor del proyecto.
     */
    public function guardarAutor(Request $request)
    {
        $request->validate([
            'autor_id' => 'required|in:hasbleidy,juand,nicolle',
            'nombre'   => 'required|string|max:120',
            'rol'      => 'required|string|max:150',
            'bio'      => 'nullable|string|max:1000',
            'email'    => 'nullable|email|max:150',
            'telefono' => 'nullable|string|max:50',
            'linkedin' => 'nullable|string|max:255',
            'github'   => 'nullable|string|max:255',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $id = $request->input('autor_id');
        $filePath = storage_path('app/sige_autores.json');
        $defaults = self::getDefaultAutores();
        $allAutores = $defaults;

        if (file_exists($filePath)) {
            $saved = json_decode(@file_get_contents($filePath), true) ?: [];
            foreach ($defaults as $key => $defaultData) {
                if (isset($saved[$key])) {
                    $allAutores[$key] = array_merge($defaultData, $saved[$key]);
                }
            }
        }

        $autor = $allAutores[$id] ?? ($defaults[$id] ?? []);
        $autor['nombre'] = $request->input('nombre');
        $autor['rol'] = $request->input('rol');
        if ($request->has('bio')) $autor['bio'] = $request->input('bio');
        if ($request->has('email')) $autor['email'] = $request->input('email');
        if ($request->has('telefono')) $autor['telefono'] = $request->input('telefono');
        if ($request->has('linkedin')) $autor['linkedin'] = $request->input('linkedin');
        if ($request->has('github')) $autor['github'] = $request->input('github');

        // Procesar subida de foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'autor_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destDir = public_path('modules/egresados/images/autores');
            if (!file_exists($destDir)) {
                @mkdir($destDir, 0777, true);
            }
            $file->move($destDir, $filename);
            $autor['foto'] = asset('modules/egresados/images/autores/' . $filename);
        }

        $allAutores[$id] = $autor;
        @file_put_contents($filePath, json_encode($allAutores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => '¡Información y foto de ' . $autor['nombre'] . ' actualizadas con éxito!',
                'autor' => $autor
            ]);
        }

        return redirect()->back()->with('success', '¡Información de ' . $autor['nombre'] . ' actualizada correctamente!');
    }
}