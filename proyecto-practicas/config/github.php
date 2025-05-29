<?php

declare(strict_types=1);

return [
    'default' => 'main',

    'connections' => [
        'main' => [
            'method'     => 'token',
            'token'      => env('GITHUB_TOKEN'), // ← Cambiado para leer desde .env
            // 'backoff'    => false,
            // 'cache'      => false,
            // 'version'    => 'v3',
            // 'enterprise' => false,
        ],

        'app' => [
            'method'       => 'application',
            'clientId'     => env('GITHUB_CLIENT_ID'),
            'clientSecret' => env('GITHUB_CLIENT_SECRET'),
        ],

        'jwt' => [
            'method'       => 'jwt',
            'token'        => env('GITHUB_JWT_TOKEN'),
        ],

        'private' => [
            'method'     => 'private',
            'appId'      => env('GITHUB_APP_ID'),
            'keyPath'    => env('GITHUB_PRIVATE_KEY_PATH'),
        ],

        'none' => [
            'method'     => 'none',
        ],
    ],

    'cache' => [
        'main' => [
            'driver'    => 'illuminate',
            'connector' => null,
        ],

        'bar' => [
            'driver'    => 'illuminate',
            'connector' => 'redis',
        ],
    ],

    'repository' => [
        'owner' => env('GITHUB_REPOSITORY_OWNER'),
        'name' => env('GITHUB_REPOSITORY_NAME'),
    ],
];
