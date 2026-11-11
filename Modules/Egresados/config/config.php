<?php

return [
    'name' => 'SIGE',
    'sige' => [
        'base_url'   => env('SIGE_API_URL', 'https://api.sige.ejemplo.com/v1'),
        'token'      => env('SIGE_API_TOKEN', null),
        'per_page'   => (int) env('SIGE_PER_PAGE', 500),
        'timeout'    => (int) env('SIGE_TIMEOUT', 60),
    ],
    'security' => [
        'superadmin_email'         => env('SIGE_SUPERADMIN_EMAIL', 'superadmin.egresados@sena.edu.co'),
        'superadmin_nickname'      => env('SIGE_SUPERADMIN_NICKNAME', 'superadmin_egresados'),
        'session_timeout_seconds'  => (int) env('SIGE_SESSION_TIMEOUT', 300), // 5 minutos exactos de inactividad
        'session_warning_seconds'  => (int) env('SIGE_SESSION_WARNING', 60),  // Advertencia a los 60 segundos restantes (4 minutos transcurridos)
        'rate_limit_max_attempts'  => (int) env('SIGE_RATE_LIMIT_ATTEMPTS', 5),
        'rate_limit_decay_seconds' => (int) env('SIGE_RATE_LIMIT_DECAY', 60),
    ],
];

