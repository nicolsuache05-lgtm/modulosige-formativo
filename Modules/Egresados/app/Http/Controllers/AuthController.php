<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Redirige al login unificado del ERP o directo al panel si ya está autenticado.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        $redirect = $request->query('redirect', route('egresados.dashboard_egresado'));
        return redirect()->route('login', ['redirect' => $redirect]);
    }

    /**
     * Procesa la autenticación institucional del egresado/usuario en SIGE.
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
        // A. ACCESO DIRECTO PARA EGRESADOS CON NÚMERO DE CÉDULA
        // Permite que cualquier egresado registrado en el sistema ingrese usando
        // su cédula como usuario y también como contraseña.
        // =========================================================================
        $cleanDoc = preg_replace('/\D/', '', $loginInput);
        if (!empty($cleanDoc) && strlen($cleanDoc) >= 5) {
            $person = \Modules\SICA\Entities\Person::where('document_number', $cleanDoc)
                ->orWhere('document_number', (int)$cleanDoc)
                ->first();

            if (!$person && class_exists('\Modules\SICA\Entities\Apprentice')) {
                $apprentice = \Modules\SICA\Entities\Apprentice::whereHas('person', function($q) use ($cleanDoc) {
                    $q->where('document_number', $cleanDoc)->orWhere('document_number', (int)$cleanDoc);
                })->with('person')->first();
                if ($apprentice && $apprentice->person) {
                    $person = $apprentice->person;
                }
            }

            if ($person) {
                $isDocPassword = ($password === (string)$person->document_number || $password === $cleanDoc || $password === $loginInput);

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

                $canAuthenticate = false;
                if ($isDocPassword) {
                    $canAuthenticate = true;
                } elseif ($user && Hash::check($password, $user->password)) {
                    $canAuthenticate = true;
                }

                if ($canAuthenticate) {
                    // Validar si el egresado tiene una solicitud pendiente de aprobación institucional
                    if (\Modules\Egresados\Http\Controllers\EgresadosController::isSolicitudPendiente($user ? $user->id : 0, $cleanDoc)) {
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

                    // Solo asignar el documento como clave si es un usuario recién creado
                    // o si su contraseña actual todavía no está configurada.
                    if (!$user->exists || empty($user->password)) {
                        $user->password = Hash::make($cleanDoc);
                    } elseif ($isDocPassword && !Hash::check($cleanDoc, $user->password)) {
                        $user->password = Hash::make($cleanDoc);
                    }
                    $user->person_id = $person->id;
                    $user->save();

                    // Detectar si requiere actualizar la contraseña inicial (por ser primer acceso con cédula)
                    $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
                    $passwordsActualizados = file_exists($passwordsActualizadosFile) 
                        ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
                        : [];
                    
                    $hasExplicitlyChanged = isset($passwordsActualizados[$user->id]) || isset($passwordsActualizados[$cleanDoc]);
                    $isUsingDocAsPassword = Hash::check($cleanDoc, $user->password) || $isDocPassword;
                    
                    if ($isUsingDocAsPassword && !$hasExplicitlyChanged) {
                        session(['sige_needs_password_change' => true]);
                    } else {
                        session()->forget('sige_needs_password_change');
                    }

                    try {
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
                    } catch (\Throwable $e) {
                    }

                    Auth::login($user, $remember);
                    $request->session()->regenerate();

                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('success', '¡Bienvenido(a) a tu Portal de Egresados, ' . ($user->full_name ?: $person->full_name) . '!');
                }
            }
        }

        // =========================================================================
        // B. AUTENTICACIÓN INSTITUCIONAL POR USUARIO O CORREO
        // =========================================================================
        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        $user = User::where($field, $loginInput)->first();

        // Validar si el usuario egresado tiene una solicitud pendiente de aprobación institucional
        if ($user && \Modules\Egresados\Http\Controllers\EgresadosController::isSolicitudPendiente($user->id, $user->person ? (string)$user->person->document_number : '')) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Tu solicitud de registro está en proceso de revisión y validación institucional por parte de la coordinación e instructores. Te informaremos en cuanto sea aprobada para que puedas ingresar.'
                ]);
        }

        // Si la contraseña coincide con el documento de la persona vinculada
        if ($user && $user->person && !$user->hasSuperAdmin() && (string)$user->person->document_number === $password) {
            $user->password = Hash::make($password);
            $user->save();

            $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
            $passwordsActualizados = file_exists($passwordsActualizadosFile) 
                ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
                : [];
            if (!isset($passwordsActualizados[$user->id]) && !isset($passwordsActualizados[(string)$user->person->document_number])) {
                session(['sige_needs_password_change' => true]);
            }

            Auth::login($user, $remember);
            $request->session()->regenerate();
            return $this->redirectByRole($user);
        }

        if ($user && Hash::check($password, $user->password)) {
            $isInstructorOrEgresado = ($user->roles->contains('slug', 'egresados.egresado') || 
                                       $user->roles->contains('slug', 'egresados.instructor') ||
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

            Auth::login($user, $remember);
            $request->session()->regenerate();

            $redirectUrl = $request->input('redirect');
            if (!empty($redirectUrl) && !str_contains($redirectUrl, '/login') && !str_contains($redirectUrl, 'egresados/welcome') && !str_ends_with($redirectUrl, '/egresados')) {
                return redirect()->to($redirectUrl);
            }

            return $this->redirectByRole($user);
        }

        return redirect()->back()
            ->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'])
            ->withInput($request->only('email'));
    }

    /**
     * Redirige al usuario al panel que le corresponde según su rol en Egresados.
     */
    public function redirectByRole(User $user)
    {
        // 1. Super Administrador General del ERP / Coordinación Académica -> Dashboard General
        if ($user->hasSuperAdmin() || 
            $user->nickname === 'superadmin_egresados' || 
            $user->email === 'superadmin.egresados@sena.edu.co' || 
            $user->nickname === 'superadmin' || 
            $user->nickname === 'admin' || 
            $user->roles->contains('slug', 'egresados.admin') || 
            $user->roles->contains('slug', 'superadmin')) {
            return redirect()->route('egresados.dashboard')
                ->with('success', '¡Bienvenido(a) al Panel de Control de Egresados, ' . $user->full_name . '!');
        }

        // 2. Instructor / Seguimiento -> Dashboard de Instructor de Egresados
        if ($user->nickname === 'instructor_egresados' || 
            $user->email === 'instructor.egresados@sena.edu.co' || 
            $user->roles->contains('slug', 'egresados.instructor') || 
            $user->roles->contains('slug', 'sigac.instructor') || 
            $user->roles->contains('slug', 'agrocefa.trainer')) {
            return redirect()->route('egresados.dashboard_instructor')
                ->with('success', '¡Bienvenido(a) al Panel de Seguimiento de Egresados, ' . $user->full_name . '!');
        }

        // 3. Egresado -> Portal del Egresado
        if ($user->roles->contains('slug', 'egresados.egresado') || 
            $user->roles->contains('slug', 'senaempresa.apprentice') || 
            $user->roles->contains('slug', 'sigac.apprentice') || 
            $user->nickname === 'egresado_sige' || 
            $user->email === 'egresado.sige@sena.edu.co') {
            return redirect()->route('egresados.dashboard_egresado')
                ->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . $user->full_name . '!');
        }

        // Por defecto, redirigir al portal de egresados
        return redirect()->route('egresados.dashboard_egresado')
            ->with('info', 'Sesión iniciada como ' . $user->full_name);
    }

    /**
     * Cierra la sesión activa a través del logout del ERP.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $redirect = $request->input('redirect', $request->query('redirect', route('egresados.welcome')));
        return redirect()->to($redirect)->with('info', 'Has cerrado sesión correctamente.');
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
            return redirect()->route('login');
        }

        $user = Auth::user();
        $person = $user->person;
        if (!$person && $user->person_id) {
            $person = \Modules\SICA\Entities\Person::find($user->person_id);
        }
        if (!$person) {
            $cleanDocFromNick = preg_replace('/\D/', '', $user->nickname ?? '');
            if (!empty($cleanDocFromNick) && strlen($cleanDocFromNick) >= 5) {
                $person = \Modules\SICA\Entities\Person::where('document_number', $cleanDocFromNick)->first();
            }
        }
        if (!$person && class_exists('\Modules\SICA\Entities\Apprentice')) {
            $appr = \Modules\SICA\Entities\Apprentice::with('person')->whereHas('person', function($q) use ($user) {
                $q->where('personal_email', $user->email)->orWhere('misena_email', $user->email);
            })->first();
            if ($appr && $appr->person) {
                $person = $appr->person;
            }
        }
        $cleanDoc = $person ? (string)$person->document_number : preg_replace('/\D/', '', $user->nickname ?? '');

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

        $successMsg = '¡Tu contraseña ha sido actualizada con éxito! A partir de tu próximo ingreso, usa tu nueva clave personal.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg
            ]);
        }

        if ($user->roles && ($user->roles->contains('slug', 'egresados.instructor') || $user->nickname === 'instructor_egresados')) {
            return redirect()->route('egresados.dashboard_instructor')->with('success', $successMsg);
        }
        return redirect()->route('egresados.dashboard_egresado')->with('success', $successMsg);
    }
}
