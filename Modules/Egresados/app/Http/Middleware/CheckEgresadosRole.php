<?php

namespace Modules\Egresados\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Egresados\Services\SigeSecurityLogger;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Symfony\Component\HttpFoundation\Response;

class CheckEgresadosRole
{
    /**
     * Valida la autenticación, control de acceso basado en roles (RBAC) y autorización institucional.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $roleType (superadmin|instructor|egresado)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $roleType = 'superadmin'): Response
    {
        // 1. Validar autenticación estricta: ninguna solicitud anónima puede acceder a áreas protegidas
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'authenticated' => false,
                    'message'       => 'No autenticado. Por favor inicia sesión institucional.',
                    'redirect'      => route('egresados.login'),
                ], 401)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
            }

            $redirectUrl = $request->fullUrl();
            return redirect()->route('egresados.login', ['redirect' => $redirectUrl])
                ->with('error', 'Debes iniciar sesión con tus credenciales institucionales para acceder a esta área confidencial.')
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma'        => 'no-cache',
                ]);
        }

        /** @var User $user */
        $user = Auth::user();

        // 2. Comprobación de identidad autorizada de Superadministrador
        $hasSuperadminRole = ($user->hasSuperAdmin() || $user->hasRole('egresados.admin') || $user->hasRole('superadmin'));
        $isLegitimateSuperadmin = $hasSuperadminRole;

        // 3. Control de Acceso Basado en Roles (RBAC)
        switch ($roleType) {
            case 'superadmin':
                if ($isLegitimateSuperadmin) {
                    $response = $next($request);
                    return $this->applySecurityHeaders($response);
                }

                // Registro de auditoría: intento de escalamiento vertical o acceso no autorizado
                SigeSecurityLogger::log(
                    'UNAUTHORIZED_ACCESS_ATTEMPT',
                    "Acceso denegado a módulo Superadmin para usuario: {$user->email} (Rol intentado: superadmin)",
                    $request,
                    $user
                );

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'error'   => 'Acceso denegado',
                        'message' => 'No tienes permisos de Superadministrador autorizados.',
                    ], 403)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                }

                // Redirigir según el rol legítimo del usuario
                if ($this->isInstructor($user)) {
                    return redirect()->route('egresados.dashboard_instructor')
                        ->with('warning', 'Acceso denegado: No tienes permisos de Superadministrador. Redirigido a tu panel de instructor.')
                        ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);
                }

                if ($this->isEgresado($user)) {
                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('warning', 'Acceso denegado: No tienes permisos de Superadministrador. Redirigido a tu portal de egresado.')
                        ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);
                }

                return redirect()->route('egresados.welcome')
                    ->with('error', 'Acceso denegado: Se requieren permisos de Superadministrador autorizados.')
                    ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);

            case 'instructor':
                // Superadministrador puede supervisar
                if ($isLegitimateSuperadmin) {
                    $response = $next($request);
                    return $this->applySecurityHeaders($response);
                }

                // Instructor autorizado
                if ($this->isInstructor($user)) {
                    $response = $next($request);
                    return $this->applySecurityHeaders($response);
                }

                SigeSecurityLogger::log(
                    'UNAUTHORIZED_ACCESS_ATTEMPT',
                    "Acceso denegado a módulo Instructor para usuario: {$user->email}",
                    $request,
                    $user
                );

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'error'   => 'Acceso denegado',
                        'message' => 'Esta vista es exclusiva para instructores y evaluadores.',
                    ], 403)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                }

                // Si es egresado intentando entrar al panel de instructores, bloquearlo y redirigirlo a su portal
                if ($this->isEgresado($user)) {
                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('warning', 'Acceso denegado: Esta vista es exclusiva para instructores y evaluadores.')
                        ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);
                }

                return redirect()->route('egresados.welcome')
                    ->with('error', 'Acceso denegado: Se requieren permisos de instructor.')
                    ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);

            case 'egresado':
                // Superadministrador puede supervisar
                if ($isLegitimateSuperadmin) {
                    $response = $next($request);
                    return $this->applySecurityHeaders($response);
                }

                // Egresado legítimo
                if ($this->isEgresado($user)) {
                    $response = $next($request);
                    return $this->applySecurityHeaders($response);
                }

                SigeSecurityLogger::log(
                    'UNAUTHORIZED_ACCESS_ATTEMPT',
                    "Acceso denegado a portal de Egresados para usuario: {$user->email}",
                    $request,
                    $user
                );

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'error'   => 'Acceso denegado',
                        'message' => 'No tienes los permisos requeridos para consultar el portal de egresados.',
                    ], 403)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                }

                // Si es instructor, redirigir a su panel correspondiente
                if ($this->isInstructor($user)) {
                    return redirect()->route('egresados.dashboard_instructor')
                        ->with('warning', 'Acceso denegado: Tu perfil tiene asignado el panel de instructores.')
                        ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);
                }

                return redirect()->route('egresados.welcome')
                    ->with('error', 'No tienes los permisos requeridos para consultar esta sección.')
                    ->withHeaders(['Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate']);
        }

        return redirect()->route('egresados.welcome')
            ->with('error', 'No tienes los permisos requeridos para consultar esta sección.');
    }

    /**
     * Determina si el usuario tiene rol autorizado de instructor.
     */
    protected function isInstructor(User $user): bool
    {
        return $user->hasRole('egresados.instructor') ||
            $user->hasRole('sigac.instructor') ||
            $user->hasRole('agrocefa.trainer') ||
            $user->nickname === 'instructor_egresados' ||
            strtolower((string)$user->email) === 'instructor.egresados@sena.edu.co';
    }

    /**
     * Determina si el usuario es un egresado/aprendiz válido.
     */
    protected function isEgresado(User $user): bool
    {
        if ($user->hasRole('egresados.egresado') ||
            $user->hasRole('senaempresa.apprentice') ||
            $user->hasRole('sigac.apprentice') ||
            $user->nickname === 'egresado_sige' ||
            strtolower((string)$user->email) === 'egresado.sige@sena.edu.co') {
            return true;
        }

        // Revisión de roles
        if ($user->roles) {
            foreach ($user->roles as $role) {
                $slug = strtolower((string) ($role->slug ?? ''));
                if (str_contains($slug, 'egresad') || str_contains($slug, 'apprentice')) {
                    return true;
                }
            }
        }

        // Revisión de vinculación con Person / Apprentice
        if (!empty($user->person_id)) {
            return Person::where('id', $user->person_id)->exists() ||
                Apprentice::where('person_id', $user->person_id)->exists();
        }

        return false;
    }

    /**
     * Aplica los encabezados de prevención de caché y protección a la respuesta.
     */
    protected function applySecurityHeaders(Response $response): Response
    {
        $headers = [
            'Cache-Control'             => 'no-cache, no-store, max-age=0, must-revalidate, no-transform',
            'Pragma'                    => 'no-cache',
            'Expires'                   => 'Sun, 02 Jan 1990 00:00:00 GMT',
            'X-Content-Type-Options'    => 'nosniff',
            'X-Frame-Options'           => 'SAMEORIGIN',
            'X-XSS-Protection'          => '1; mode=block',
            'Referrer-Policy'           => 'strict-origin-when-cross-origin',
        ];

        foreach ($headers as $key => $val) {
            if (method_exists($response, 'header')) {
                $response->header($key, $val);
            } elseif (isset($response->headers)) {
                $response->headers->set($key, $val);
            }
        }

        return $response;
    }
}
