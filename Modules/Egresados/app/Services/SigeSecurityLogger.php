<?php

namespace Modules\Egresados\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SigeSecurityLogger
{
    /**
     * Registra un evento de seguridad institucional en el archivo de auditoría.
     */
    public static function log(string $eventType, string $description, ?Request $request = null, ?User $user = null): void
    {
        try {
            $req = $request ?: (request() instanceof Request ? request() : null);
            $currentUser = $user ?: (auth()->check() ? auth()->user() : null);

            $entry = [
                'timestamp'  => now()->toDateTimeString(),
                'event'      => strtoupper($eventType),
                'user_id'    => $currentUser?->id,
                'email'      => $currentUser?->email,
                'role'       => $currentUser?->primary_role ?? 'N/A',
                'ip'         => $req?->ip() ?? 'CLI/Internal',
                'user_agent' => substr((string) ($req?->userAgent() ?? 'N/A'), 0, 200),
                'method'     => $req?->method() ?? 'N/A',
                'url'        => $req?->fullUrl() ?? 'N/A',
                'details'    => $description,
            ];

            $logDir = storage_path('logs');
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }

            $logFile = $logDir . DIRECTORY_SEPARATOR . 'sige_security.log';
            $logLine = json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;

            @file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);

            // También registrar en el logger estándar de Laravel si está disponible
            Log::channel('single')->info("[SIGE_SECURITY] [{$entry['event']}] {$description}", [
                'user_id' => $entry['user_id'],
                'ip'      => $entry['ip'],
            ]);
        } catch (\Throwable $e) {
            // Failsafe: nunca romper la ejecución de la aplicación por un fallo al registrar auditoría
            @error_log("Error escribiendo log de seguridad SIGE: " . $e->getMessage());
        }
    }

    /**
     * Obtiene los registros de auditoría más recientes.
     */
    public static function getRecentLogs(int $limit = 50): array
    {
        $logFile = storage_path('logs/sige_security.log');
        if (!file_exists($logFile)) {
            return [];
        }

        $lines = @file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return [];
        }

        $lines = array_reverse($lines);
        $result = [];
        $count = 0;

        foreach ($lines as $line) {
            $decoded = json_decode($line, true);
            if ($decoded) {
                $result[] = $decoded;
                $count++;
                if ($count >= $limit) {
                    break;
                }
            }
        }

        return $result;
    }
}

