<?php

namespace Modules\Egresados\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Egresados\Services\SigeSecurityLogger;
use Symfony\Component\HttpFoundation\Response;

class SigeSessionTimeout
{
    /**
     * Tiempo límite de inactividad permitido en segundos (5 minutos exactos = 300 segundos).
     */
    public const TIMEOUT_SECONDS = 300;

    /**
     * Controla el tiempo de inactividad de la sesión tanto en peticiones HTTP normales como AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo aplica a usuarios autenticados
        if (!Auth::check()) {
            return $next($request);
        }

        $now = now()->timestamp;
        $timeoutSeconds = (int) config('egresados.security.session_timeout_seconds', self::TIMEOUT_SECONDS);
        $lastActivity = session('sige_last_activity');

        // 1. Si existe un registro previo de última actividad, verificar si han pasado 5 minutos
        if ($lastActivity !== null) {
            $inactiveTime = $now - (int) $lastActivity;

            if ($inactiveTime >= $timeoutSeconds) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $userIdentifier = $user->email ?? $user->nickname ?? ('ID:' . $user->id);

                SigeSecurityLogger::log(
                    'SESSION_EXPIRED_INACTIVITY',
                    "Sesión cerrada automáticamente por inactividad ({$inactiveTime}s >= {$timeoutSeconds}s) para el usuario: {$userIdentifier}",
                    $request,
                    $user
                );

                // Invalidar completamente la sesión en el servidor
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $message = 'Tu sesión ha expirado por inactividad. Inicia sesión nuevamente.';

                // Respuesta si la solicitud es AJAX o espera JSON
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'authenticated' => false,
                        'expired'       => true,
                        'message'       => $message,
                        'redirect'      => route('egresados.login', ['inactivity' => 1]),
                    ], 401)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                }

                // Redirección para solicitudes web estándar
                return redirect()->route('egresados.login', ['inactivity' => 1])
                    ->with('warning', $message)
                    ->withHeaders([
                        'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                        'Pragma'        => 'no-cache',
                    ]);
            }
        }

        // 2. Determinar si esta solicitud debe renovar el temporizador de actividad:
        // No considerar las peticiones automáticas del sistema como actividad humana.
        $isPassivePing = $request->header('X-Background-Ping') === 'true' 
            || $request->is('*egresados/session/check*')
            || $request->is('*egresados/notificaciones*');

        if (!$isPassivePing) {
            $request->session()->put('sige_last_activity', $now);
            $request->session()->put('sige_authenticated_module', 'egresados');
        }

        return $next($request);
    }
}

