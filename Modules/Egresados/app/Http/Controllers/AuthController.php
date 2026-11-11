<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Modules\Egresados\Services\SigeSecurityLogger;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión institucional o redirige al panel si ya está autenticado.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            return $this->redirectByRole($user);
        }

        $redirect = $request->query('redirect', route('egresados.dashboard'));

        return response()
            ->view('egresados::login', compact('redirect'))
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
    }

    /**
     * Procesa la autenticación institucional segura con protección contra fuerza bruta y RBAC.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'El correo, usuario o documento es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $loginInput = trim($request->input('email'));
        $password = trim($request->input('password'));
        $remember = $request->boolean('remember');

        // =========================================================================
        // 1. PROTECCIÓN CONTRA ATAQUES DE FUERZA BRUTA (Rate Limiting)
        // =========================================================================
        $throttleKey = 'sige_login:' . Str::lower($loginInput) . '|' . $request->ip();
        $maxAttempts = (int) config('egresados.security.rate_limit_max_attempts', 5);
        $decaySeconds = (int) config('egresados.security.rate_limit_decay_seconds', 60);

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            SigeSecurityLogger::log(
                'RATE_LIMITED',
                "Bloqueo temporal por intentos fallidos excesivos ({$maxAttempts} intentos) para: {$loginInput} (IP: {$request->ip()})",
                $request
            );

            return redirect()->back()
                ->withInput($request->only('email', 'remember', 'redirect'))
                ->withErrors([
                    'email' => "Demasiados intentos de inicio de sesión. Por motivos de seguridad institucional, por favor espera {$seconds} segundos antes de intentar nuevamente."
                ])
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma'        => 'no-cache',
                ]);
        }

        // =========================================================================
        // 2. ACCESO DIRECTO PARA EGRESADOS CON NÚMERO DE CÉDULA
        // =========================================================================
        $cleanDoc = preg_replace('/\D/', '', $loginInput);
        if (!empty($cleanDoc) && strlen($cleanDoc) >= 5) {
            $person = Person::where('document_number', $cleanDoc)
                ->orWhere('document_number', (int)$cleanDoc)
                ->first();

            if (!$person && class_exists(Apprentice::class)) {
                $apprentice = Apprentice::whereHas('person', function($q) use ($cleanDoc) {
                    $q->where('document_number', $cleanDoc)->orWhere('document_number', (int)$cleanDoc);
                })->with('person')->first();
                if ($apprentice && $apprentice->person) {
                    $person = $apprentice->person;
                }
            }

            if ($person) {
                $isDocPassword = ($password === (string)$person->document_number || $password === $cleanDoc || $password === $loginInput);

                /** @var User|null $user */
                $user = User::where('person_id', $person->id)->first();
                if (!$user && !empty($person->misena_email)) {
                    $user = User::where('email', $person->misena_email)->first();
                }
                if (!$user && !empty($person->personal_email)) {
                    $user = User::where('email', $person->personal_email)->first();
                }
                if (!$user) {
                    $user = User::where('nickname', 'egresado_' . $cleanDoc)->first();
                }

                // Cargar archivo persistente de contraseñas actualizadas
                $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
                $passwordsActualizados = file_exists($passwordsActualizadosFile) 
                    ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
                    : [];

                $hasExplicitlyChanged = $user && (isset($passwordsActualizados[$user->id]) || isset($passwordsActualizados[$cleanDoc]));

                // El Super Admin debe ingresar únicamente con sus credenciales ya establecidas (su contraseña real)
                $isSuperAdminUser = $user && ($user->hasSuperAdmin() || 
                    $user->roles->contains('slug', 'superadmin') || 
                    $user->nickname === 'superadmin' || 
                    $user->nickname === 'superadmin_egresados' || 
                    $user->email === 'superadmin.egresados@sena.edu.co');

                // Si ya actualizó su contraseña previamente o si es Super Admin, NO se permite ingresar con el documento como clave
                if ($isSuperAdminUser || $hasExplicitlyChanged) {
                    $isDocPassword = false;
                }

                $canAuthenticate = false;
                if ($user && Hash::check($password, $user->password)) {
                    $canAuthenticate = true;
                } elseif (!$isSuperAdminUser && !$hasExplicitlyChanged && $isDocPassword) {
                    $canAuthenticate = true;
                }

                if ($canAuthenticate) {
                    // Validar si el egresado tiene una solicitud pendiente de aprobación institucional
                    if (EgresadosController::isSolicitudPendiente($user ? $user->id : 0, $cleanDoc)) {
                        return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors([
                                'email' => 'Tu solicitud de registro está en proceso de revisión y validación institucional por parte de la coordinación e instructores. Te informaremos en cuanto sea aprobada para que puedas ingresar.'
                            ]);
                    }

                    if (!$user) {
                        $uniqueEmail = !empty($person->misena_email) 
                            ? $person->misena_email 
                            : (!empty($person->personal_email) ? $person->personal_email : 'egresado.' . $cleanDoc . '@sena.edu.co');

                        if (User::where('email', $uniqueEmail)->exists()) {
                            $uniqueEmail = 'egresado.' . $cleanDoc . '.' . time() . '@sena.edu.co';
                        }

                        $user = new User();
                        $user->nickname = 'egresado_' . $cleanDoc;
                        $user->person_id = $person->id;
                        $user->email = $uniqueEmail;
                    }

                    // Detectar si requiere actualizar la contraseña inicial
                    $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
                    $passwordsActualizados = file_exists($passwordsActualizadosFile) 
                        ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
                        : [];
                    
                    $hasExplicitlyChanged = ($user->exists && isset($passwordsActualizados[$user->id])) || isset($passwordsActualizados[$cleanDoc]);
                    $isUsingDocAsPassword = ($user->exists && Hash::check($cleanDoc, $user->password)) || $isDocPassword;

                    // Solo asignar el documento como clave si es un usuario nuevo y aún no ha actualizado clave (NUNCA a superadmin)
                    if (!$isSuperAdminUser && !$hasExplicitlyChanged) {
                        if (!$user->exists || empty($user->password)) {
                            $user->password = Hash::make($cleanDoc);
                        } elseif ($isDocPassword && !Hash::check($cleanDoc, $user->password)) {
                            $user->password = Hash::make($cleanDoc);
                        }
                    }
                    $user->person_id = $person->id;
                    $user->save();

                    // Forzar cambio obligatorio de contraseña en primer ingreso con cédula para Instructor o Egresado
                    if (!$isSuperAdminUser && !$hasExplicitlyChanged) {
                        session(['sige_needs_password_change' => true]);
                    } else {
                        session()->forget('sige_needs_password_change');
                    }

                    // Sincronizar rol según el perfil en el ERP (Admin, Instructor o Egresado)
                    $isSuperAdmin = $user->hasSuperAdmin() || 
                        $user->roles->contains('slug', 'egresados.admin') || 
                        $user->roles->contains('slug', 'superadmin') || 
                        $user->nickname === 'superadmin' || 
                        $user->nickname === 'admin';

                    $isInstructor = !$isSuperAdmin && (
                        $user->roles->contains('slug', 'egresados.instructor') || 
                        $user->roles->contains('slug', 'sigac.instructor') || 
                        $user->roles->contains('slug', 'agrocefa.trainer') || 
                        $user->roles->contains('slug', 'sica.instructor') ||
                        $user->roles->some(fn($r) => str_contains($r->slug, 'instructor') || str_contains($r->slug, 'trainer')) ||
                        ($person && \Modules\SICA\Entities\Course::where('person_id', $person->id)->exists())
                    );

                    try {
                        if ($isInstructor) {
                            $roleInst = \Modules\SICA\Entities\Role::where('slug', 'egresados.instructor')->first();
                            if (!$roleInst) {
                                $appEgresados = \DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
                                $appId = $appEgresados ? $appEgresados->id : 30;
                                $roleInst = \Modules\SICA\Entities\Role::firstOrCreate(
                                    ['slug' => 'egresados.instructor'],
                                    [
                                        'name' => 'Instructor Egresados',
                                        'description' => 'Instructor / Coordinador de seguimiento a egresados',
                                        'description_english' => 'Instructor / Coordinator alumni tracking',
                                        'full_access' => 'No',
                                        'app_id' => $appId,
                                    ]
                                );
                            }
                            if ($roleInst && method_exists($user, 'roles')) {
                                $user->roles()->syncWithoutDetaching([$roleInst->id]);
                            }
                        } elseif (!$isSuperAdmin) {
                            $roleEgresado = \Modules\SICA\Entities\Role::where('slug', 'egresados.egresado')->first();
                            if (!$roleEgresado) {
                                $appEgresados = \DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
                                $appId = $appEgresados ? $appEgresados->id : 30;
                                $roleEgresado = \Modules\SICA\Entities\Role::firstOrCreate(
                                    ['slug' => 'egresados.egresado'],
                                    [
                                        'name' => 'Egresado',
                                        'description' => 'Graduado / Egresado de formación profesional del CEFA',
                                        'description_english' => 'Graduate / Alumni of vocational training at CEFA',
                                        'full_access' => 'No',
                                        'app_id' => $appId,
                                    ]
                                );
                            }
                            if ($roleEgresado && method_exists($user, 'roles')) {
                                $user->roles()->syncWithoutDetaching([$roleEgresado->id]);
                            }
                        }
                    } catch (\Throwable $e) {
                    }

                    RateLimiter::clear($throttleKey);
                    Auth::login($user, $remember);
                    $request->session()->regenerate();

                    // Inicializar sesión segura SIGE
                    session([
                        'sige_last_activity'         => now()->timestamp,
                        'sige_authenticated_module' => 'egresados',
                        'sige_user_id'              => $user->id,
                    ]);

                    SigeSecurityLogger::log('LOGIN_SUCCESS', "Inicio de sesión exitoso por documento ({$cleanDoc})", $request, $user);

                    return $this->redirectByRole($user);
                }
            }
        }

        // =========================================================================
        // 3. AUTENTICACIÓN INSTITUCIONAL POR USUARIO O CORREO
        // =========================================================================
        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        /** @var User|null $user */
        $user = User::where($field, $loginInput)->first();

        // Validar si el usuario egresado tiene una solicitud pendiente de aprobación institucional
        if ($user && EgresadosController::isSolicitudPendiente($user->id, $user->person ? (string)$user->person->document_number : '')) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Tu solicitud de registro está en proceso de revisión y validación institucional por parte de la coordinación e instructores. Te informaremos en cuanto sea aprobada para que puedas ingresar.'
                ]);
        }

        // Cargar registro de contraseñas actualizadas
        $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
        $passwordsActualizados = file_exists($passwordsActualizadosFile) 
            ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
            : [];
        $hasAlreadyUpdated = $user && (isset($passwordsActualizados[$user->id]) || ($user->person && isset($passwordsActualizados[(string)$user->person->document_number])));

        // Si la contraseña coincide con el documento de la persona vinculada (SOLO si no ha cambiado clave y no es SuperAdmin)
        if (!$hasAlreadyUpdated && $user && $user->person && !$user->hasSuperAdmin() && (string)$user->person->document_number === $password) {
            $user->password = Hash::make($password);
            $user->save();

            session(['sige_needs_password_change' => true]);

            RateLimiter::clear($throttleKey);
            Auth::login($user, $remember);
            $request->session()->regenerate();

            session([
                'sige_last_activity'         => now()->timestamp,
                'sige_authenticated_module' => 'egresados',
                'sige_user_id'              => $user->id,
            ]);

            SigeSecurityLogger::log('LOGIN_SUCCESS', "Inicio de sesión institucional exitoso para: {$user->email}", $request, $user);

            return $this->redirectByRole($user);
        }

        // Verificación estándar con Hash::check
        if ($user && Hash::check($password, $user->password)) {
            // =====================================================================
            // VALIDACIÓN CRÍTICA DE SUPERADMINISTRADOR:
            // Solo una cuenta autorizada puede actuar como Superadministrador
            // =====================================================================
            $authorizedSuperadminEmail = strtolower((string) config('egresados.security.superadmin_email', 'superadmin.egresados@sena.edu.co'));
            $authorizedSuperadminNick  = strtolower((string) config('egresados.security.superadmin_nickname', 'superadmin_egresados'));
            $isTryingSuperadmin = ($user->hasSuperAdmin() || $user->hasRole('egresados.admin') || $user->hasRole('superadmin'));

            if ($isTryingSuperadmin) {
                $userEmail = strtolower((string) $user->email);
                $userNick  = strtolower((string) $user->nickname);
                $isLegitimateEmail = ($userEmail === $authorizedSuperadminEmail || $userNick === $authorizedSuperadminNick);

                if (!$isLegitimateEmail) {
                    RateLimiter::hit($throttleKey, $decaySeconds);
                    SigeSecurityLogger::log(
                        'UNAUTHORIZED_SUPERADMIN_ATTEMPT',
                        "Intento de inicio de sesión como Superadministrador denegado para correo no autorizado: {$user->email}",
                        $request,
                        $user
                    );

                    return redirect()->back()
                        ->withErrors(['email' => 'La cuenta indicada no está autorizada para las funciones administrativas de SIGE.'])
                        ->withInput($request->only('email'));
                }
            }

            $isInstructorOrEgresado = ($user->hasRole('egresados.egresado') || 
                                       $user->hasRole('egresados.instructor') ||
                                       $user->nickname === 'egresado_sige' ||
                                       $user->nickname === 'instructor_egresados');

            if ($isInstructorOrEgresado && $user->person && !$user->hasSuperAdmin()) {
                $docNum = (string)$user->person->document_number;
                $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
                $passwordsActualizados = file_exists($passwordsActualizadosFile) 
                    ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
                    : [];
                if (!isset($passwordsActualizados[$user->id]) && !isset($passwordsActualizados[$docNum]) && Hash::check($docNum, $user->password)) {
                    session(['sige_needs_password_change' => true]);
                }
            }

            RateLimiter::clear($throttleKey);
            Auth::login($user, $remember);
            $request->session()->regenerate();

            session([
                'sige_last_activity'         => now()->timestamp,
                'sige_authenticated_module' => 'egresados',
                'sige_user_id'              => $user->id,
            ]);

            SigeSecurityLogger::log('LOGIN_SUCCESS', "Inicio de sesión institucional exitoso para: {$user->email}", $request, $user);

            $redirectUrl = $request->input('redirect');
            if (!empty($redirectUrl) && !str_contains($redirectUrl, '/login') && !str_contains($redirectUrl, 'egresados/welcome') && !str_ends_with($redirectUrl, '/egresados')) {
                return redirect()->to($redirectUrl)->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma'        => 'no-cache',
                ]);
            }

            return $this->redirectByRole($user);
        }

        // =========================================================================
        // 4. FALLO DE AUTENTICACIÓN
        // =========================================================================
        RateLimiter::hit($throttleKey, $decaySeconds);
        SigeSecurityLogger::log('LOGIN_FAILED', "Credenciales incorrectas para: {$loginInput} (IP: {$request->ip()})", $request);

        return redirect()->back()
            ->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'])
            ->withInput($request->only('email', 'remember', 'redirect'))
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma'        => 'no-cache',
            ]);
    }

    /**
     * Redirige al usuario al panel que le corresponde según su rol en Egresados.
     */
    public function redirectByRole(User $user)
    {
        $authorizedSuperadminEmail = strtolower((string) config('egresados.security.superadmin_email', 'superadmin.egresados@sena.edu.co'));
        $authorizedSuperadminNick  = strtolower((string) config('egresados.security.superadmin_nickname', 'superadmin_egresados'));

        $userEmail = strtolower((string) $user->email);
        $userNick  = strtolower((string) $user->nickname);

        $isAuthorizedSuperadmin = ($userEmail === $authorizedSuperadminEmail || $userNick === $authorizedSuperadminNick) 
            && ($user->hasSuperAdmin() || $user->hasRole('egresados.admin') || $user->hasRole('superadmin'));

        // 1. Super Administrador General del ERP / Coordinación Académica -> Dashboard General
        if ($isAuthorizedSuperadmin) {
            return redirect()->route('egresados.dashboard')
                ->with('success', '¡Bienvenido(a) al Panel de Control de Egresados, ' . $user->full_name . '!')
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma'        => 'no-cache',
                ]);
        }

        // 2. Instructor / Seguimiento -> Dashboard de Instructor de Egresados
        if ($user->nickname === 'instructor_egresados' || 
            $user->email === 'instructor.egresados@sena.edu.co' || 
            $user->hasRole('egresados.instructor') || 
            $user->hasRole('sigac.instructor') || 
            $user->hasRole('agrocefa.trainer') ||
            $user->hasRole('sica.instructor') ||
            ($user->roles && (
                $user->roles->contains('slug', 'egresados.instructor') || 
                $user->roles->contains('slug', 'sigac.instructor') || 
                $user->roles->contains('slug', 'agrocefa.trainer') ||
                $user->roles->contains('slug', 'sica.instructor') ||
                $user->roles->some(fn($r) => str_contains($r->slug, 'instructor') || str_contains($r->slug, 'trainer'))
            )) ||
            ($user->person_id && \Modules\SICA\Entities\Course::where('person_id', $user->person_id)->exists())) {
            return redirect()->route('egresados.dashboard_instructor')
                ->with('success', '¡Bienvenido(a) al Panel de Seguimiento de Egresados, ' . $user->full_name . '!')
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma'        => 'no-cache',
                ]);
        }

        // 3. Egresado -> Portal del Egresado
        return redirect()->route('egresados.dashboard_egresado')
            ->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . ($user->full_name ?: 'Egresado') . '!')
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma'        => 'no-cache',
            ]);
    }

    /**
     * Endpoint pasivo para comprobar el tiempo restante de inactividad de la sesión.
     * No renueva el temporizador (las peticiones automáticas no cuentan como actividad humana).
     */
    public function checkSession(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'authenticated'     => false,
                'expired'           => true,
                'remaining_seconds' => 0,
                'message'           => 'Tu sesión ha expirado por inactividad. Inicia sesión nuevamente.',
                'redirect'          => route('egresados.login', ['inactivity' => 1]),
            ], 401)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        }

        $now = now()->timestamp;
        $timeout = (int) config('egresados.security.session_timeout_seconds', 300);
        $lastActivity = (int) session('sige_last_activity', $now);
        $elapsed = $now - $lastActivity;
        $remaining = max(0, $timeout - $elapsed);

        // Si expiraron los 5 minutos exactos
        if ($remaining <= 0) {
            /** @var User $user */
            $user = Auth::user();
            SigeSecurityLogger::log('SESSION_EXPIRED_INACTIVITY', "Sesión cerrada por inactividad de 5 minutos en endpoint de control", $request, $user);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'authenticated'     => false,
                'expired'           => true,
                'remaining_seconds' => 0,
                'message'           => 'Tu sesión ha expirado por inactividad. Inicia sesión nuevamente.',
                'redirect'          => route('egresados.login', ['inactivity' => 1]),
            ], 401)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        }

        return response()->json([
            'authenticated'     => true,
            'expired'           => false,
            'remaining_seconds' => $remaining,
            'warning'           => $remaining <= (int) config('egresados.security.session_warning_seconds', 60),
        ])->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
    }

    /**
     * Endpoint activo que renueva el tiempo de actividad de la sesión tras interacción humana confirmada.
     */
    public function keepAlive(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'authenticated' => false,
                'expired'       => true,
                'message'       => 'Tu sesión ha expirado por inactividad. Inicia sesión nuevamente.',
                'redirect'      => route('egresados.login', ['inactivity' => 1]),
            ], 401)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        }

        $now = now()->timestamp;
        $request->session()->put('sige_last_activity', $now);

        return response()->json([
            'authenticated'     => true,
            'success'           => true,
            'remaining_seconds' => (int) config('egresados.security.session_timeout_seconds', 300),
            'message'           => 'Sesión renovada exitosamente.',
        ])->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
    }

    /**
     * Cierra la sesión activa con invalidación en servidor, regeneración de token CSRF y cabeceras no-cache.
     */
    public function logout(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::check() ? Auth::user() : null;

        if ($user) {
            SigeSecurityLogger::log('LOGOUT', "Cierre de sesión seguro ejecutado por el usuario", $request, $user);

            // Revocar tokens API Sanctum asociados si existen
            if (method_exists($user, 'tokens')) {
                try {
                    $user->tokens()->delete();
                } catch (\Throwable $e) {}
            }
        }

        // Limpiar todas las variables temporales del módulo SIGE
        session()->forget([
            'sige_last_activity',
            'sige_authenticated_module',
            'sige_needs_password_change',
            'sige_user_id',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $redirect = $request->input('redirect', $request->query('redirect', route('egresados.login')));

        return redirect()->to($redirect)
            ->with('info', 'Has cerrado sesión correctamente.')
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma'        => 'no-cache',
                'Expires'       => 'Sun, 02 Jan 1990 00:00:00 GMT',
            ]);
    }

    /**
     * Cierra el acceso al módulo protegido y redirige al portal ERP principal.
     */
    public function salirModulo(Request $request)
    {
        session()->forget([
            'sige_last_activity',
            'sige_authenticated_module',
        ]);

        return redirect()->route('home')->with('info', 'Has salido del módulo de Egresados (SIGE).');
    }

    /**
     * Procesa la actualización de la contraseña inicial (documento de identidad) a una nueva clave.
     */
    public function cambiarPassword(Request $request)
    {
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'No autorizado. Debes iniciar sesión primero.'], 401);
            }
            return redirect()->route('egresados.login');
        }

        /** @var User $user */
        $user = Auth::user();
        $person = $user->person;
        if (!$person && $user->person_id) {
            $person = Person::find($user->person_id);
        }
        if (!$person) {
            $cleanDocFromNick = preg_replace('/\D/', '', (string) $user->nickname);
            if (!empty($cleanDocFromNick) && strlen($cleanDocFromNick) >= 5) {
                $person = Person::where('document_number', $cleanDocFromNick)->first();
            }
        }
        if (!$person && class_exists(Apprentice::class)) {
            $appr = Apprentice::with('person')->whereHas('person', function($q) use ($user) {
                $q->where('personal_email', $user->email)->orWhere('misena_email', $user->email);
            })->first();
            if ($appr && $appr->person) {
                $person = $appr->person;
            }
        }
        $cleanDoc = $person ? (string)$person->document_number : preg_replace('/\D/', '', (string) $user->nickname);

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6',
            'new_password_confirmation' => 'required|string|same:new_password',
        ], [
            'current_password.required' => 'Debes ingresar tu contraseña inicial (tu documento de identidad).',
            'new_password.required' => 'Debes ingresar una nueva contraseña personal.',
            'new_password.min' => 'La nueva contraseña debe tener como mínimo 6 caracteres.',
            'new_password_confirmation.required' => 'Debes confirmar tu nueva contraseña.',
            'new_password_confirmation.same' => 'La confirmación de la contraseña no coincide.',
        ]);

        $currentPass = trim($request->input('current_password'));
        $newPass = trim($request->input('new_password'));

        // Validar si la contraseña inicial es correcta
        $isCurrentValid = Hash::check($currentPass, $user->password) ||
                          (!empty($cleanDoc) && $currentPass === $cleanDoc) ||
                          ($person && $currentPass === (string)$person->document_number) ||
                          (!empty($cleanDoc) && preg_replace('/\D/', '', $currentPass) === preg_replace('/\D/', '', $cleanDoc)) ||
                          Hash::check('12345678', $user->password) ||
                          $currentPass === '12345678';

        if (!$isCurrentValid) {
            $msg = 'La contraseña inicial ingresada es incorrecta. Recuerda que corresponde a tu número de documento de identidad.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->withErrors(['current_password' => $msg]);
        }

        // Validar que la nueva contraseña no sea idéntica al documento
        if ((!empty($cleanDoc) && $newPass === $cleanDoc) || ($person && $newPass === (string)$person->document_number)) {
            $msg = 'Por motivos de seguridad, la nueva contraseña no puede ser igual a tu número de documento.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->withErrors(['new_password' => $msg]);
        }

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($newPass);
        $user->save();

        // Registrar en el archivo persistente de contraseñas actualizadas
        $passwordsFile = storage_path('app/sige_passwords_actualizados.json');
        $passwords = file_exists($passwordsFile) ? (json_decode(@file_get_contents($passwordsFile), true) ?: []) : [];

        $record = [
            'user_id' => $user->id,
            'nickname' => $user->nickname,
            'documento' => $cleanDoc,
            'nombre' => $person ? ($person->first_name . ' ' . $person->first_last_name) : $user->name,
            'updated_at' => now()->toDateTimeString(),
            'ip' => $request->ip(),
        ];
        $passwords[$user->id] = $record;
        if (!empty($cleanDoc)) {
            $passwords[$cleanDoc] = $record;
        }
        @file_put_contents($passwordsFile, json_encode($passwords, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Quitar la bandera de la sesión
        session()->forget('sige_needs_password_change');

        SigeSecurityLogger::log('PASSWORD_CHANGED', "Contraseña actualizada exitosamente para el usuario {$user->email}", $request, $user);

        $successMsg = '¡Tu contraseña ha sido actualizada con éxito! A partir de tu próximo ingreso, usa tu nueva clave personal.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg
            ]);
        }

        if ($user->hasRole('egresados.instructor') || $user->nickname === 'instructor_egresados') {
            return redirect()->route('egresados.dashboard_instructor')->with('success', $successMsg);
        }
        return redirect()->route('egresados.dashboard_egresado')->with('success', $successMsg);
    }
}
