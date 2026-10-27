<?php

return [
    'name' => 'SIGE',
    'sige' => [
        'base_url'   => env('SIGE_API_URL', 'https://api.sige.ejemplo.com/v1'),
        'token'      => env('SIGE_API_TOKEN', null),
        'per_page'   => (int) env('SIGE_PER_PAGE', 500),
        'timeout'    => (int) env('SIGE_TIMEOUT', 60),
    ],
];
