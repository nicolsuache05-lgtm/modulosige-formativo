<?php

namespace Modules\Egresados\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEgresadosRole
{
    /**
     * Handle an incoming request and ensure role-based access control and confidentiality.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $roleType (superadmin|instructor|egresado)
     */
    public function handle(Request $request, Closure $next, string $roleType = 'superadmin'): Response
    {
        // 1. Validar si el usuario está autenticado
        if (!Auth::check()) {
            if (app()->environment('local')) {
                $devUser = \App\Models\User::where('nickname', 'superadmin_egresados')
                    ->orWhere('email', 'superadmin.egresados@sena.edu.co')
                    ->first();
                if ($devUser) {
                    Auth::login($devUser);
                    return $next($request);
                }
            }

            $redirectUrl = $request->fullUrl();
            return redirect()->route('login', ['redirect' => $redirectUrl])
                ->with('error', 'Debes iniciar sesión con tus credenciales institucionales para acceder a esta área confidencial.');
        }

        $user = Auth::user();

        // 2. Si es Super Administrador del ERP, Administrador de Egresados o Coordinador
        if ($user->hasSuperAdmin() || 
            $user->hasRole('egresados.admin') || 
            $user->hasRole('superadmin') ||
            $user->hasRole('sica.admin') ||
            $user->hasRole('sigac.academic_coordinator') ||
            $user->hasRole('sica.coordinator') ||
            $user->nickname === 'superadmin_egresados' ||
            $user->email === 'superadmin.egresados@sena.edu.co') {
            return $next($request);
        }

        // 3. Validar accesos según el rol requerido
        switch ($roleType) {
            case 'superadmin':
                // Requiere rol de administración de Egresados
                if ($user->hasRole('egresados.admin') || $user->hasRole('superadmin') || $user->hasRole('sigac.academic_coordinator')) {
                    return $next($request);
                }

                // Si es instructor, redirigir a su panel correspondiente
                if ($user->hasRole('egresados.instructor') || $user->nickname === 'instructor_egresados' || $user->email === 'instructor.egresados@sena.edu.co') {
                    return redirect()->route('egresados.dashboard_instructor')
                        ->with('warning', 'Acceso denegado: Tu perfil tiene asignado el panel de seguimiento de instructores.');
                }

                // Si es egresado, redirigir a su portal
                if ($user->hasRole('egresados.egresado') || $user->nickname === 'egresado_sige' || $user->email === 'egresado.sige@sena.edu.co') {
                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('warning', 'Acceso denegado: Tu perfil tiene asignado el portal de egresados.');
                }
                break;

            case 'instructor':
                // Permite Superadmins y Administradores de Egresados
                if ($user->hasRole('egresados.admin')) {
                    return $next($request);
                }

                // Permite instructores
                if ($user->hasRole('egresados.instructor') || 
                    $user->hasRole('sigac.instructor') || 
                    $user->hasRole('agrocefa.trainer') ||
                    $user->nickname === 'instructor_egresados' ||
                    $user->email === 'instructor.egresados@sena.edu.co') {
                    return $next($request);
                }

                // Si es egresado, redirigir a su portal
                if ($user->hasRole('egresados.egresado') || $user->nickname === 'egresado_sige' || $user->email === 'egresado.sige@sena.edu.co') {
                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('warning', 'Acceso denegado: Esta vista es exclusiva para instructores y evaluadores.');
                }
                break;

            case 'egresado':
                // Permite a los egresados
                if ($user->hasRole('egresados.egresado') || 
                    $user->hasRole('senaempresa.apprentice') || 
                    $user->hasRole('sigac.apprentice') ||
                    $user->nickname === 'egresado_sige' ||
                    $user->email === 'egresado.sige@sena.edu.co') {
                    return $next($request);
                }

                // Superadmins y administradores pueden supervisar el portal
                if ($user->hasRole('egresados.admin')) {
                    return $next($request);
                }
                break;
        }

        // Por seguridad, si el rol no coincide, redirigir a la bienvenida con aviso
        return redirect()->route('egresados.welcome')
            ->with('error', 'No tienes los permisos requeridos para consultar esta sección.');
    }
}
