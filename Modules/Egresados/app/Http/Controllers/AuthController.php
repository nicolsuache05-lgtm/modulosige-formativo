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
     * Redirige al login unificado del ERP.
     */
    public function showLoginForm(Request $request)
    {
        $redirect = $request->query('redirect', route('egresados.welcome'));
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
            'email.required'    => 'El correo o usuario es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        $credentials = [
            $field => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($request->filled('redirect') && !str_contains($request->input('redirect'), '/login')) {
                return redirect()->to($request->input('redirect'));
            }

            return $this->redirectByRole($user);
        }

        // Intento alternativo buscando persona por correo o documento
        $user = User::where($field, $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();

            if ($request->filled('redirect') && !str_contains($request->input('redirect'), '/login')) {
                return redirect()->to($request->input('redirect'));
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
        // 1. Super Administrador / Admin de Egresados -> Dashboard General
        if ($user->hasSuperAdmin() || $user->hasRole('egresados.admin') || $user->nickname === 'superadmin_egresados' || $user->email === 'superadmin.egresados@sena.edu.co') {
            return redirect()->route('egresados.dashboard')
                ->with('success', '¡Bienvenido(a) al Panel de Control de Egresados, ' . $user->full_name . '!');
        }

        // 2. Instructor -> Dashboard de Instructor de Egresados
        if ($user->hasRole('egresados.instructor') || $user->hasRole('sigac.instructor') || $user->hasRole('agrocefa.trainer') || $user->nickname === 'instructor_egresados' || $user->email === 'instructor.egresados@sena.edu.co') {
            return redirect()->route('egresados.dashboard_instructor')
                ->with('success', '¡Bienvenido(a) Instructor(a), ' . $user->full_name . '!');
        }

        // 3. Egresado -> Portal del Egresado
        if ($user->hasRole('egresados.egresado') || $user->hasRole('senaempresa.apprentice') || $user->hasRole('sigac.apprentice') || $user->nickname === 'egresado_sige' || $user->email === 'egresado.sige@sena.edu.co') {
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
}
