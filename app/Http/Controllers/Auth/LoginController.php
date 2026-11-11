<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $loginInput = trim($request->input('email'));
        $password = $request->input('password');
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
                    ?: User::where('nickname', 'egresado_' . $cleanDoc)->first();
            }
        }

        // 3. Validar si autentica: por Hash o por documento como contraseña
        $passwordsActualizadosFile = storage_path('app/sige_passwords_actualizados.json');
        $passwordsActualizados = file_exists($passwordsActualizadosFile) 
            ? (json_decode(@file_get_contents($passwordsActualizadosFile), true) ?: []) 
            : [];

        $hasExplicitlyChanged = $user && (isset($passwordsActualizados[$user->id]) || ($person && isset($passwordsActualizados[(string)$person->document_number])));

        $isSuperAdminUser = $user && ($user->hasSuperAdmin() || 
            $user->roles->contains('slug', 'superadmin') || 
            $user->nickname === 'superadmin' || 
            $user->nickname === 'superadmin_egresados' || 
            $user->email === 'superadmin.egresados@sena.edu.co');

        $isDocPassword = ($person && ($password === (string)$person->document_number || $password === $cleanDoc || $password === $loginInput));
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
            // Forzar cambio obligatorio de contraseña en primer ingreso con cédula
            if (!$isSuperAdminUser && !$hasExplicitlyChanged) {
                session(['sige_needs_password_change' => true]);
            } else {
                session()->forget('sige_needs_password_change');
            }
            if (!$user && $person) {
                $uniqueEmail = !empty($person->misena_email) 
                    ? $person->misena_email 
                    : (!empty($person->personal_email) ? $person->personal_email : 'egresado.' . $cleanDoc . '@sena.edu.co');

                $user = User::firstOrCreate(
                    ['person_id' => $person->id],
                    [
                        'nickname' => 'egresado_' . $cleanDoc,
                        'email'    => $uniqueEmail,
                        'password' => Hash::make($cleanDoc),
                    ]
                );
            }

            // Sincronizar roles si es instructor o egresado
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
                ($user->person_id && \Modules\SICA\Entities\Course::where('person_id', $user->person_id)->exists())
            );

            if ($isInstructor) {
                $roleInst = \Modules\SICA\Entities\Role::where('slug', 'egresados.instructor')->first();
                if ($roleInst && method_exists($user, 'roles')) {
                    $user->roles()->syncWithoutDetaching([$roleInst->id]);
                }
            } elseif (!$isSuperAdmin) {
                $roleEgresado = \Modules\SICA\Entities\Role::where('slug', 'egresados.egresado')->first();
                if ($roleEgresado && method_exists($user, 'roles')) {
                    $user->roles()->syncWithoutDetaching([$roleEgresado->id]);
                }
            }

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
