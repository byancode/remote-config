<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Driver de caché para los ajustes
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar qué driver de caché usar para almacenar
    | los ajustes de la aplicación. Por defecto se usa 'file'.
    |
    */
    'cache' => [
        'driver' => env('REMOTE_CONFIG_CACHE_DRIVER', 'file'),
        'key'    => env('REMOTE_CONFIG_CACHE_PREFIX', 'app.remote_config'),
    ],
];