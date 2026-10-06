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
     * Redirige las solicitudes de autenticación al login central del ERP.
     */
    public function login(Request $request)
    {
        return redirect()->route('login', ['redirect' => $request->input('redirect', route('egresados.welcome'))]);
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
     * Cierra la sesión activa a través del logout del ERP.
     */
    public function logout(Request $request)
    {
        $redirect = $request->input('redirect', $request->query('redirect', route('egresados.welcome')));
        return redirect()->route('logout', ['redirect' => $redirect]);
    }
}
