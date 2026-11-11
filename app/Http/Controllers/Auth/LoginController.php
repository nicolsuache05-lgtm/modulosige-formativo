<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Egresados\Http\Controllers\AuthController as SigeAuthController;

class LoginController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión del ERP.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            $redirect = $request->query('redirect', route('direccion.welcome'));
            return redirect($redirect)->with('info', 'Ya has iniciado sesión como ' . Auth::user()->full_name);
        }

        $redirect = $request->query('redirect', '');
        return view('login', compact('redirect'));
    }

    /**
     * Procesa la autenticación del usuario en el ERP.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Debes ingresar tu correo institucional o usuario.',
            'password.required' => 'Debes ingresar tu contraseña.',
        ]);

        $loginInput = trim((string) $request->input('email'));
        $password = trim((string) $request->input('password'));
        $remember = $request->boolean('remember');

        // 1. Buscar al usuario por correo o por nickname
        $user = User::where('email', $loginInput)
            ->orWhere('nickname', $loginInput)
            ->first();

        // 2. Si no se encontró por email/nickname, buscar si es un número de documento
        $cleanDoc = preg_replace('/\D/', '', $loginInput);
        $person = null;
        if (!empty($cleanDoc) && strlen($cleanDoc) >= 5) {
            $person = \Modules\SICA\Entities\Person::where('document_number', $cleanDoc)
                ->orWhere('document_number', (int)$cleanDoc)
                ->first();

            if ($person && !$user) {
                $user = User::where('person_id', $person->id)->first()
                    ?: User::where('email', $person->misena_email)->first()
                    ?: User::where('email', $person->personal_email)->first()
                    ?: User::where('nickname', 'egresado_' . $cleanDoc)->first()
                    ?: User::where('nickname', 'instructor_' . $cleanDoc)->first();
            }
        }

        if ($user && !$person) {
            $person = SigeAuthController::resolvePersonForUser($user);
        }

        // 3. Validar si autentica: por Hash o por documento como contraseña
        $docFallback = !empty($cleanDoc) && strlen($cleanDoc) >= 5 ? $cleanDoc : null;
        $hasExplicitlyChanged = SigeAuthController::hasCompletedInitialPasswordChange($user, $person, $docFallback);
        $isSuperAdminUser = SigeAuthController::isSuperAdminAccount($user);

        $isDocPassword = ($person && (
            $password === (string)$person->document_number
            || (!empty($cleanDoc) && $password === $cleanDoc)
            || $password === $loginInput
        ));
        if ($isSuperAdminUser || $hasExplicitlyChanged) {
            $isDocPassword = false; // El Super Admin o quien ya cambió su clave NO puede entrar con documento como clave
        }

        $canAuthenticate = false;
        if ($user && Hash::check($password, $user->password)) {
            $canAuthenticate = true;
        } elseif (!$isSuperAdminUser && !$hasExplicitlyChanged && $isDocPassword) {
            $canAuthenticate = true;
        }

        if ($canAuthenticate) {
            // Validar si el egresado tiene una solicitud pendiente de aprobación institucional
            $docCheck = $person ? (string)$person->document_number : $cleanDoc;
            if (\Modules\Egresados\Http\Controllers\EgresadosController::isSolicitudPendiente($user ? $user->id : 0, $docCheck)) {
                return back()
                    ->withInput($request->only('email', 'remember', 'redirect'))
                    ->withErrors([
                        'email' => 'Tu solicitud de registro está en proceso de revisión y validación institucional por parte de la coordinación e instructores. Te informaremos en cuanto sea aprobada para que puedas ingresar.'
                    ]);
            }

            if (!$user && $person) {
                $isCourseInstructor = \Modules\SICA\Entities\Course::where('person_id', $person->id)->exists();
                $nickPrefix = $isCourseInstructor ? 'instructor_' : 'egresado_';
                $uniqueEmail = !empty($person->misena_email)
                    ? $person->misena_email
                    : (!empty($person->personal_email) ? $person->personal_email : ($isCourseInstructor ? 'instructor.' : 'egresado.') . $cleanDoc . '@sena.edu.co');

                if (User::where('email', $uniqueEmail)->exists()) {
                    $uniqueEmail = ($isCourseInstructor ? 'instructor.' : 'egresado.') . $cleanDoc . '.' . time() . '@sena.edu.co';
                }

                $nickname = $nickPrefix . $cleanDoc;
                if (User::where('nickname', $nickname)->exists()) {
                    $nickname = $nickPrefix . $cleanDoc . '_' . time();
                }

                $user = User::firstOrCreate(
                    ['person_id' => $person->id],
                    [
                        'nickname' => $nickname,
                        'email'    => $uniqueEmail,
                        'password' => Hash::make($cleanDoc ?: (string)$person->document_number),
                    ]
                );
            }

            // Reevaluar cambio obligatorio sobre el usuario resuelto/creado y sincronizar vínculo/clave inicial
            $hasExplicitlyChanged = SigeAuthController::hasCompletedInitialPasswordChange($user, $person, $docFallback);
            if (!$isSuperAdminUser && !$hasExplicitlyChanged) {
                session(['sige_needs_password_change' => true]);
                if ($user && $person) {
                    $docForHash = (string)$person->document_number;
                    if (!$user->person_id) {
                        $user->person_id = $person->id;
                    }
                    if ($isDocPassword && !Hash::check($docForHash, $user->password)) {
                        $user->password = Hash::make($docForHash);
                    }
                    if ($user->isDirty()) {
                        $user->save();
                    }
                }
            } else {
                session()->forget('sige_needs_password_change');
                if ($user && $person && !$user->person_id) {
                    $user->person_id = $person->id;
                    $user->save();
                }
            }

            $isSuperAdmin = SigeAuthController::isSuperAdminAccount($user);
            $isInstructor = SigeAuthController::syncSigeRoleForUser($user, $person);

            Auth::login($user, $remember);
            $request->session()->regenerate();
            session(['sige_last_activity' => now()->timestamp]);

            $redirectUrl = $request->input('redirect');
            if (!empty($redirectUrl) && (str_starts_with($redirectUrl, '/') || str_starts_with($redirectUrl, url('/')))) {
                return redirect($redirectUrl)->with('success', '¡Bienvenido(a) a SENA Empresa, ' . $user->full_name . '!');
            }

            // Redirección inteligente al dashboard correspondiente
            if ($isSuperAdmin) {
                return redirect()->route('egresados.dashboard')->with('success', '¡Bienvenido(a) Administrador(a), ' . $user->full_name . '!');
            } elseif ($isInstructor) {
                return redirect()->route('egresados.dashboard_instructor')->with('success', '¡Bienvenido(a) Instructor(a), ' . $user->full_name . '!');
            } elseif ($user->roles->contains('slug', 'egresados.egresado')) {
                return redirect()->route('egresados.dashboard_egresado')->with('success', '¡Bienvenido(a) a tu Portal de Egresados, ' . $user->full_name . '!');
            }

            return redirect()->intended(route('direccion.welcome'))->with('success', '¡Bienvenido(a) a SENA Empresa, ' . $user->full_name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember', 'redirect'))
            ->withErrors([
                'email' => 'Las credenciales ingresadas no coinciden con nuestros registros.',
            ]);
    }

    /**
     * Cierra la sesión activa del usuario.
     */
    public function logout(Request $request)
    {
        $userName = Auth::check() ? Auth::user()->full_name : 'Usuario';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $redirectUrl = $request->input('redirect', $request->query('redirect', ''));
        if (!empty($redirectUrl) && (str_starts_with($redirectUrl, '/') || str_starts_with($redirectUrl, url('/')))) {
            return redirect($redirectUrl)->with('info', 'Has cerrado sesión exitosamente.');
        }

        return redirect()->route('direccion.welcome')->with('info', 'Has cerrado sesión exitosamente. ¡Hasta pronto, ' . $userName . '!');
    }
}
