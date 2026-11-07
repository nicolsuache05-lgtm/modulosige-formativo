<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Ruta al archivo persistente de notificaciones del módulo SIGE.
     */
    public static function getStorageFile(): string
    {
        return storage_path('app/sige_notificaciones.json');
    }

    /**
     * Agrega una nueva notificación en el almacenamiento persistente.
     */
    public static function pushNotificacion(array $notif): void
    {
        try {
            $file = self::getStorageFile();
            $notificaciones = file_exists($file) ? (json_decode(@file_get_contents($file), true) ?: []) : [];

            if (empty($notif['id'])) {
                $notif['id'] = 'notif_' . time() . '_' . mt_rand(100, 999);
            }
            if (!isset($notif['unread'])) {
                $notif['unread'] = true;
            }
            if (empty($notif['created_at'])) {
                $notif['created_at'] = now()->toDateTimeString();
            }

            // Insertar al inicio de la lista
            array_unshift($notificaciones, $notif);

            // Mantener un historial máximo de 60 notificaciones
            $notificaciones = array_slice($notificaciones, 0, 60);

            if (!is_dir(dirname($file))) {
                @mkdir(dirname($file), 0777, true);
            }
            @file_put_contents($file, json_encode($notificaciones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } catch (\Throwable $e) {
            \Log::warning('Error en NotificationController::pushNotificacion: ' . $e->getMessage());
        }
    }

    /**
     * Retorna todas las notificaciones dinámicas del sistema, sincronizadas
     * con las respuestas reales de encuestas, confirmaciones de eventos y actualizaciones.
     */
    public static function getAllNotificaciones(): array
    {
        $file = self::getStorageFile();
        $notificaciones = file_exists($file) ? (json_decode(@file_get_contents($file), true) ?: []) : [];

        // 1. Sincronizar respuestas reales de encuestas almacenadas
        $respFile = storage_path('app/sige_respuestas_encuestas.json');
        if (file_exists($respFile)) {
            $respuestas = json_decode(@file_get_contents($respFile), true) ?: [];
            foreach ($respuestas as $key => $resp) {
                $notifId = 'resp_enc_' . md5($key . ($resp['created_at'] ?? ''));
                $exists = false;
                foreach ($notificaciones as $n) {
                    if (($n['id'] ?? '') === $notifId) {
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    $encId = $resp['encuesta_id'] ?? 'ENC-025';
                    $encTitulo = self::getEncuestaTitle($encId);
                    $notificaciones[] = [
                        'id' => $notifId,
                        'tipo' => 'encuesta',
                        'categoria' => 'Respuesta de Encuesta',
                        'icon' => 'fa-solid fa-clipboard-check',
                        'iconColor' => '#1e40af',
                        'iconBg' => '#eff6ff',
                        'titulo' => 'Nueva Respuesta en Encuesta Institucional',
                        'texto' => '<strong>' . htmlspecialchars($resp['nombre'] ?? 'Egresado') . '</strong> respondió la encuesta <em>"' . htmlspecialchars($encTitulo) . '"</em>.',
                        'resumen' => 'El egresado(a) ' . ($resp['nombre'] ?? 'Egresado') . ' (Doc: ' . ($resp['documento'] ?? 'N/D') . ') ha completado y enviado su formulario de encuesta.',
                        'egresado_nombre' => $resp['nombre'] ?? 'Egresado',
                        'egresado_doc' => $resp['documento'] ?? 'N/D',
                        'egresado_email' => $resp['email'] ?? 'egresado@sena.edu.co',
                        'created_at' => $resp['created_at'] ?? now()->toDateTimeString(),
                        'unread' => true,
                        'campos' => [
                            ['etiqueta' => 'Egresado', 'valor' => $resp['nombre'] ?? 'Egresado'],
                            ['etiqueta' => 'Documento', 'valor' => (string)($resp['documento'] ?? 'N/D')],
                            ['etiqueta' => 'Encuesta Respondida', 'valor' => $encTitulo],
                            ['etiqueta' => 'Correo de Contacto', 'valor' => $resp['email'] ?? 'egresado@sena.edu.co'],
                            ['etiqueta' => 'Fecha de Respuesta', 'valor' => isset($resp['created_at']) ? Carbon::parse($resp['created_at'])->format('d/m/Y h:i A') : now()->format('d/m/Y h:i A')],
                            ['etiqueta' => 'Estado', 'valor' => 'Respuestas recibidas y consolidadas']
                        ],
                        'accionTexto' => 'Ver Resultados de Encuestas',
                        'accionUrl' => route('egresados.encuestas_superadmin'),
                        'accionIcon' => 'fa-solid fa-chart-pie'
                    ];
                }
            }
        }

        // 2. Sincronizar confirmaciones reales de eventos (RSVP)
        $rsvpFile = storage_path('app/sige_eventos_rsvp.json');
        if (file_exists($rsvpFile)) {
            $rsvps = json_decode(@file_get_contents($rsvpFile), true) ?: [];
            foreach ($rsvps as $key => $rsvp) {
                $notifId = 'rsvp_evt_' . md5($key . ($rsvp['created_at'] ?? ''));
                $exists = false;
                foreach ($notificaciones as $n) {
                    if (($n['id'] ?? '') === $notifId) {
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    $asis = strtolower($rsvp['asistencia'] ?? 'si');
                    $asiste = in_array($asis, ['si', 'virtual', 'confirmado']);
                    $notificaciones[] = [
                        'id' => $notifId,
                        'tipo' => 'evento',
                        'categoria' => 'Confirmación de Evento',
                        'icon' => 'fa-solid fa-calendar-check',
                        'iconColor' => '#b45309',
                        'iconBg' => '#fef3c7',
                        'titulo' => 'Confirmación de Asistencia a Evento',
                        'texto' => '<strong>' . htmlspecialchars($rsvp['nombre'] ?? 'Egresado') . '</strong> ' . ($asiste ? 'confirmó asistencia' : 'respondió') . ' al evento <em>"' . htmlspecialchars($rsvp['evento_id'] ?? 'Evento CEFA') . '"</em>.',
                        'resumen' => 'El egresado(a) ' . ($rsvp['nombre'] ?? 'Egresado') . ' ha registrado su respuesta para la convocatoria del evento institucional.',
                        'egresado_nombre' => $rsvp['nombre'] ?? 'Egresado',
                        'egresado_doc' => $rsvp['documento'] ?? 'N/D',
                        'egresado_email' => $rsvp['email'] ?? 'egresado@sena.edu.co',
                        'created_at' => $rsvp['created_at'] ?? now()->toDateTimeString(),
                        'unread' => true,
                        'campos' => [
                            ['etiqueta' => 'Egresado', 'valor' => $rsvp['nombre'] ?? 'Egresado'],
                            ['etiqueta' => 'Documento', 'valor' => (string)($rsvp['documento'] ?? 'N/D')],
                            ['etiqueta' => 'Evento Institucional', 'valor' => $rsvp['evento_id'] ?? 'Evento CEFA'],
                            ['etiqueta' => 'Confirmación', 'valor' => $asiste ? 'Asistirá (' . ($rsvp['modalidad'] ?? 'Presencial') . ')' : 'No podrá asistir'],
                            ['etiqueta' => 'Observaciones', 'valor' => !empty($rsvp['comentario']) ? $rsvp['comentario'] : 'Sin comentarios adicionales'],
                            ['etiqueta' => 'Fecha de Respuesta', 'valor' => isset($rsvp['created_at']) ? Carbon::parse($rsvp['created_at'])->format('d/m/Y h:i A') : now()->format('d/m/Y h:i A')]
                        ],
                        'accionTexto' => 'Ver Agenda de Eventos',
                        'accionUrl' => route('egresados.eventos'),
                        'accionIcon' => 'fa-solid fa-calendar-days'
                    ];
                }
            }
        }

        // 3. Si la lista está vacía, inicializar con notificaciones basadas en egresados reales del CEFA
        if (empty($notificaciones)) {
            $notificaciones = self::getDefaultSeedNotificaciones();
            @file_put_contents($file, json_encode($notificaciones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        // Ordenar de más reciente a más antigua
        usort($notificaciones, function ($a, $b) {
            $ta = strtotime($a['created_at'] ?? '2026-01-01');
            $tb = strtotime($b['created_at'] ?? '2026-01-01');
            return $tb <=> $ta;
        });

        // Formatear el tiempo relativo humanizado
        foreach ($notificaciones as &$n) {
            $n['tiempo'] = self::formatRelativeTime($n['created_at'] ?? null);
        }

        return $notificaciones;
    }

    /**
     * Resuelve el título de una encuesta a partir de su ID.
     */
    public static function getEncuestaTitle(string $id): string
    {
        $defaultEncuestas = [
            'ENC-025' => 'Inserción Laboral ADSO 2026',
            'ENC-024' => 'Impacto y Empleabilidad 2025',
            'ENC-023' => 'Satisfacción Formativa CEFA',
            'ENC-022' => 'Competencias y Habilidades Blandas',
            'ENC-021' => 'Emprendimiento y Fondo Emprender',
        ];

        if (isset($defaultEncuestas[$id])) {
            return $defaultEncuestas[$id];
        }

        $customFile = storage_path('app/sige_custom_encuestas.json');
        if (file_exists($customFile)) {
            $customs = json_decode(@file_get_contents($customFile), true) ?: [];
            foreach ($customs as $c) {
                if (($c['id'] ?? '') === $id) {
                    return $c['full_title'] ?? ($c['title'] ?? $id);
                }
            }
        }

        return 'Encuesta de Seguimiento ' . $id;
    }

    /**
     * Notificaciones iniciales con nombres de egresados reales del sistema.
     */
    private static function getDefaultSeedNotificaciones(): array
    {
        $now = Carbon::now();

        return [
            [
                'id' => 'notif_seed_1',
                'tipo' => 'encuesta',
                'categoria' => 'Respuesta de Encuesta',
                'icon' => 'fa-solid fa-clipboard-check',
                'iconColor' => '#1e40af',
                'iconBg' => '#eff6ff',
                'titulo' => 'Respuesta de Encuesta: Inserción Laboral ADSO',
                'texto' => '<strong>Juan Carlos Méndez</strong> respondió la encuesta <em>"Inserción Laboral ADSO 2026"</em>.',
                'resumen' => 'El egresado Juan Carlos Méndez (Doc: 21455555) completó satisfactoriamente la encuesta de inserción laboral.',
                'egresado_nombre' => 'Juan Carlos Méndez',
                'egresado_doc' => '21455555',
                'egresado_email' => 'juan.mendez@misena.edu.co',
                'created_at' => $now->copy()->subMinutes(14)->toDateTimeString(),
                'unread' => true,
                'campos' => [
                    ['etiqueta' => 'Egresado', 'valor' => 'Juan Carlos Méndez'],
                    ['etiqueta' => 'Documento', 'valor' => 'CC 21.455.555'],
                    ['etiqueta' => 'Encuesta', 'valor' => 'Inserción Laboral ADSO 2026'],
                    ['etiqueta' => 'Situación Reportada', 'valor' => 'Empleado tiempo completo en desarrollo de software'],
                    ['etiqueta' => 'Empresa', 'valor' => 'Innovación Tecnológica Huila S.A.S.'],
                    ['etiqueta' => 'Fecha de Envío', 'valor' => $now->copy()->subMinutes(14)->format('d/m/Y h:i A')],
                    ['etiqueta' => 'Estado', 'valor' => 'Validada por el Sistema']
                ],
                'accionTexto' => 'Ver Resultados de Encuestas',
                'accionUrl' => route('egresados.encuestas_superadmin'),
                'accionIcon' => 'fa-solid fa-chart-pie'
            ],
            [
                'id' => 'notif_seed_2',
                'tipo' => 'evento',
                'categoria' => 'Confirmación de Evento',
                'icon' => 'fa-solid fa-calendar-check',
                'iconColor' => '#b45309',
                'iconBg' => '#fef3c7',
                'titulo' => 'Confirmación de Asistencia: Feria de Empleo CEFA',
                'texto' => '<strong>Hasbleidy Perdomo</strong> confirmó asistencia al evento <em>"Feria de Oportunidades y Empleo CEFA"</em>.',
                'resumen' => 'La egresada Hasbleidy Perdomo confirmó su asistencia presencial para la jornada de vinculación ocupacional.',
                'egresado_nombre' => 'Hasbleidy Perdomo',
                'egresado_doc' => '587474',
                'egresado_email' => 'hasbleidy.perdomo@misena.edu.co',
                'created_at' => $now->copy()->subHours(2)->toDateTimeString(),
                'unread' => true,
                'campos' => [
                    ['etiqueta' => 'Egresada', 'valor' => 'Hasbleidy Perdomo'],
                    ['etiqueta' => 'Documento', 'valor' => 'CC 587474'],
                    ['etiqueta' => 'Evento Convocado', 'valor' => 'Feria de Oportunidades y Empleo CEFA 2026'],
                    ['etiqueta' => 'Modalidad Elegida', 'valor' => 'Presencial en Sede La Angostura'],
                    ['etiqueta' => 'Comentario', 'valor' => 'Asistiré con mi hoja de vida actualizada para las vacantes de software'],
                    ['etiqueta' => 'Fecha de Confirmación', 'valor' => $now->copy()->subHours(2)->format('d/m/Y h:i A')]
                ],
                'accionTexto' => 'Ver Agenda de Eventos',
                'accionUrl' => route('egresados.eventos'),
                'accionIcon' => 'fa-solid fa-calendar-days'
            ],
            [
                'id' => 'notif_seed_3',
                'tipo' => 'actualizacion',
                'categoria' => 'Actualización de Perfil',
                'icon' => 'fa-solid fa-briefcase',
                'iconColor' => '#0d6928',
                'iconBg' => '#eaf7ee',
                'titulo' => 'Actualización de Perfil: Juan David Lizcano',
                'texto' => '<strong>Juan David Lizcano</strong> actualizó sus datos de contacto y situación laboral a <em>Empleado</em>.',
                'resumen' => 'El egresado Juan David Lizcano actualizó oportunamente su teléfono, correo y empresa donde labora.',
                'egresado_nombre' => 'Juan David Lizcano',
                'egresado_doc' => '2021454',
                'egresado_email' => 'juan.lizcano@misena.edu.co',
                'created_at' => $now->copy()->subHours(5)->toDateTimeString(),
                'unread' => false,
                'campos' => [
                    ['etiqueta' => 'Egresado', 'valor' => 'Juan David Lizcano'],
                    ['etiqueta' => 'Documento', 'valor' => 'CC 2021454'],
                    ['etiqueta' => 'Nuevo Estado Laboral', 'valor' => 'Empleado (Contrato Término Fijo)'],
                    ['etiqueta' => 'Empresa / Entidad', 'valor' => 'Agroindustrias del Huila'],
                    ['etiqueta' => 'Teléfono Actualizado', 'valor' => '314 202 1454'],
                    ['etiqueta' => 'Fecha de Actualización', 'valor' => $now->copy()->subHours(5)->format('d/m/Y h:i A')]
                ],
                'accionTexto' => 'Ver en Directorio',
                'accionUrl' => route('egresados.index'),
                'accionIcon' => 'fa-solid fa-user-graduate'
            ],
            [
                'id' => 'notif_seed_4',
                'tipo' => 'encuesta',
                'categoria' => 'Respuesta de Encuesta',
                'icon' => 'fa-solid fa-clipboard-check',
                'iconColor' => '#1e40af',
                'iconBg' => '#eff6ff',
                'titulo' => 'Respuesta de Encuesta: Impacto y Empleabilidad',
                'texto' => '<strong>Emily Zaray Perdomo</strong> respondió la encuesta <em>"Impacto y Empleabilidad 2025"</em>.',
                'resumen' => 'La egresada Emily Zaray Perdomo completó la encuesta de impacto formativo y pertinencia de competencias.',
                'egresado_nombre' => 'Emily Zaray Perdomo',
                'egresado_doc' => '25448855',
                'egresado_email' => 'emily.perdomo@misena.edu.co',
                'created_at' => $now->copy()->subDay()->toDateTimeString(),
                'unread' => false,
                'campos' => [
                    ['etiqueta' => 'Egresada', 'valor' => 'Emily Zaray Perdomo'],
                    ['etiqueta' => 'Documento', 'valor' => 'CC 25.448.855'],
                    ['etiqueta' => 'Encuesta Respondida', 'valor' => 'Impacto y Empleabilidad 2025'],
                    ['etiqueta' => 'Nivel de Satisfacción', 'valor' => 'Excelente (5/5)'],
                    ['etiqueta' => 'Fecha de Respuesta', 'valor' => $now->copy()->subDay()->format('d/m/Y h:i A')]
                ],
                'accionTexto' => 'Ver Reporte de Encuestas',
                'accionUrl' => route('egresados.encuestas_superadmin'),
                'accionIcon' => 'fa-solid fa-chart-pie'
            ]
        ];
    }

    /**
     * Calcula una representación humana y amigable de la fecha relativa.
     */
    public static function formatRelativeTime(?string $dateStr): string
    {
        if (empty($dateStr)) {
            return 'Reciente';
        }

        try {
            $dt = Carbon::parse($dateStr);
            $now = Carbon::now();

            $diffMinutes = $now->diffInMinutes($dt);
            if ($diffMinutes < 1) {
                return 'Hace unos instantes';
            }
            if ($diffMinutes < 60) {
                return "Hace {$diffMinutes} min";
            }

            $diffHours = $now->diffInHours($dt);
            if ($diffHours < 24 && $dt->isToday()) {
                return "Hace {$diffHours} " . ($diffHours === 1 ? 'hora' : 'horas');
            }

            if ($dt->isYesterday()) {
                return 'Ayer, ' . $dt->format('h:i A');
            }

            if ($dt->diffInDays($now) < 7) {
                return 'Hace ' . $dt->diffInDays($now) . ' días';
            }

            return $dt->format('d/m/Y');
        } catch (\Throwable $e) {
            return 'Reciente';
        }
    }

    /**
     * Marca todas las notificaciones como leídas.
     */
    public function markAllRead(Request $request)
    {
        try {
            $file = self::getStorageFile();
            $notificaciones = file_exists($file) ? (json_decode(@file_get_contents($file), true) ?: []) : [];

            foreach ($notificaciones as &$n) {
                $n['unread'] = false;
            }

            @file_put_contents($file, json_encode($notificaciones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return response()->json(['success' => true, 'message' => 'Todas las notificaciones han sido marcadas como leídas.']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}

