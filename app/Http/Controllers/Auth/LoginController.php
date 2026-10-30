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

        // Buscar al usuario por correo o por nickname
        $user = User::where('email', $loginInput)
            ->orWhere('nickname', $loginInput)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            // Identificar perfil del usuario
            $isSuperAdmin = $user->hasSuperAdmin() || 
                            $user->nickname === 'superadmin_egresados' || 
                            $user->email === 'superadmin.egresados@sena.edu.co' || 
                            $user->nickname === 'superadmin' || 
                            $user->roles->contains('slug', 'egresados.admin') ||
                            $user->roles->contains('slug', 'superadmin');

            $isInstructor = $user->nickname === 'instructor_egresados' || 
                            $user->email === 'instructor.egresados@sena.edu.co' || 
                            $user->roles->contains('slug', 'egresados.instructor') || 
                            $user->roles->contains('slug', 'sigac.instructor') || 
                            $user->roles->contains('slug', 'agrocefa.trainer');

            $redirectUrl = $request->input('redirect');
            if (!empty($redirectUrl) && (str_starts_with($redirectUrl, '/') || str_starts_with($redirectUrl, url('/')))) {
                // Si el redirect es la landing de egresados, dirigir directo al dashboard correspondiente
                if (str_contains($redirectUrl, 'egresados/welcome') || str_contains($redirectUrl, 'egresados/home') || str_ends_with($redirectUrl, '/egresados')) {
                    if ($isSuperAdmin) {
                        return redirect()->route('egresados.dashboard')->with('success', '¡Bienvenido(a) a SENA Empresa, ' . $user->full_name . '!');
                    }
                    if ($isInstructor) {
                        return redirect()->route('egresados.dashboard_instructor')->with('success', '¡Bienvenido(a) a SENA Empresa, ' . $user->full_name . '!');
                    }
                }
                return redirect($redirectUrl)->with('success', '¡Bienvenido(a) a SENA Empresa, ' . $user->full_name . '!');
            }

            // Redirección inteligente al panel correspondiente según el usuario/rol
            if ($user->nickname === 'superadmin_egresados' || $user->email === 'superadmin.egresados@sena.edu.co' || ($user->roles && $user->roles->contains('slug', 'egresados.admin')) || !empty($isSuperAdmin)) {
                return redirect()->route('egresados.dashboard')->with('success', '¡Bienvenido(a) al Panel de Control de Egresados, ' . $user->full_name . '!');
            }

            if ($user->nickname === 'instructor_egresados' || $user->email === 'instructor.egresados@sena.edu.co' || ($user->roles && $user->roles->contains('slug', 'egresados.instructor')) || !empty($isInstructor)) {
                return redirect()->route('egresados.dashboard_instructor')->with('success', '¡Bienvenido(a) Instructor(a), ' . $user->full_name . '!');
            }

            if ($user->nickname === 'egresado_sige' || $user->email === 'egresado.sige@sena.edu.co' || ($user->roles && $user->roles->contains('slug', 'egresados.egresado'))) {
                return redirect()->route('egresados.dashboard_egresado')->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . $user->full_name . '!');
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
