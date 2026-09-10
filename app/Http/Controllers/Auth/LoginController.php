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
            $user = Auth::user();
            $roleSlugs = $user->roles()->pluck('slug')->toArray();

            if (in_array('egresados.admin', $roleSlugs) || $user->email === 'superadmin.egresados@sena.edu.co' || $user->nickname === 'superadmin_egresados') {
                return redirect()->route('egresados.dashboard');
            }
            if (in_array('egresados.instructor', $roleSlugs) || $user->email === 'instructor.egresados@sena.edu.co' || $user->nickname === 'instructor_egresados') {
                return redirect()->route('egresados.dashboard_instructor');
            }
            if (in_array('egresados.egresado', $roleSlugs) || $user->email === 'egresado.sige@sena.edu.co' || $user->nickname === 'egresado_sige') {
                return redirect()->route('egresados.dashboard_egresado');
            }

            $redirect = $request->query('redirect', route('direccion.welcome'));
            return redirect($redirect)->with('info', 'Ya has iniciado sesión como ' . $user->full_name);
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

            // Verificar roles específicos asignados en BD
            $roleSlugs = $user->roles()->pluck('slug')->toArray();

            // 1. Administrador / Superadmin de Egresados
            if (in_array('egresados.admin', $roleSlugs) || $user->email === 'superadmin.egresados@sena.edu.co' || $user->nickname === 'superadmin_egresados') {
                return redirect()->route('egresados.dashboard')->with('success', '¡Bienvenido(a) Administrador(a), ' . $user->full_name . '!');
            }

            // 2. Instructor de Egresados
            if (in_array('egresados.instructor', $roleSlugs) || $user->email === 'instructor.egresados@sena.edu.co' || $user->nickname === 'instructor_egresados') {
                return redirect()->route('egresados.dashboard_instructor')->with('success', '¡Bienvenido(a) Instructor(a), ' . $user->full_name . '!');
            }

            // 3. Egresado
            if (in_array('egresados.egresado', $roleSlugs) || $user->email === 'egresado.sige@sena.edu.co' || $user->nickname === 'egresado_sige') {
                return redirect()->route('egresados.dashboard_egresado')->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . $user->full_name . '!');
            }

            $redirectUrl = $request->input('redirect');
            if (!empty($redirectUrl) && (str_starts_with($redirectUrl, '/') || str_starts_with($redirectUrl, url('/')))) {
                return redirect($redirectUrl)->with('success', '¡Bienvenido(a) a SENA Empresa, ' . $user->full_name . '!');
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
