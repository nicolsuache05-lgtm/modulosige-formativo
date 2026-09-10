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
     * Muestra la vista de inicio de sesión dedicada para el módulo de Egresados.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        $redirect = $request->query('redirect', '');
        return view('egresados::login', compact('redirect'));
    }

    /**
     * Procesa la autenticación y redirige inteligentemente al módulo correspondiente dentro de Egresados.
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

        // Buscar al usuario por correo electrónico o por nickname
        $user = User::with('roles')->where('email', $loginInput)
            ->orWhere('nickname', $loginInput)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            // Redirección inteligente por rol a su respectivo submódulo de Egresados
            return $this->redirectByRole($user);
        }

        return back()
            ->withInput($request->only('email', 'remember', 'redirect'))
            ->withErrors([
                'email' => 'Las credenciales ingresadas no coinciden con nuestros registros de Egresados.',
            ]);
    }

    /**
     * Redirige al usuario al panel que le corresponde según su rol en Egresados.
     */
    public function redirectByRole(User $user)
    {
        // 1. Super Administrador / Admin de Egresados -> Dashboard General
        if ($user->hasSuperAdmin() || $user->hasRole('egresados.admin')) {
            return redirect()->route('egresados.dashboard')
                ->with('success', '¡Bienvenido(a) al Panel de Control de Egresados, ' . $user->full_name . '!');
        }

        // 2. Instructor -> Dashboard de Instructor de Egresados
        if ($user->hasRole('egresados.instructor') || $user->hasRole('sigac.instructor') || $user->hasRole('agrocefa.trainer')) {
            return redirect()->route('egresados.dashboard_instructor')
                ->with('success', '¡Bienvenido(a) Instructor(a), ' . $user->full_name . '!');
        }

        // 3. Egresado -> Portal del Egresado
        if ($user->hasRole('egresados.egresado') || $user->hasRole('senaempresa.apprentice') || $user->hasRole('sigac.apprentice')) {
            return redirect()->route('egresados.dashboard_egresado')
                ->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . $user->full_name . '!');
        }

        // Por defecto, redirigir al portal público de egresados
        return redirect()->route('egresados.welcome')
            ->with('info', 'Sesión iniciada como ' . $user->full_name);
    }

    /**
     * Cierra la sesión activa y retorna al portal de bienvenida de Egresados.
     */
    public function logout(Request $request)
    {
        $userName = Auth::check() ? Auth::user()->full_name : 'Usuario';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('egresados.welcome')
            ->with('info', 'Has cerrado sesión exitosamente. ¡Hasta pronto, ' . $userName . '!');
    }
}
