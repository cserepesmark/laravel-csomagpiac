<?php

return[

    'live_env' => env('CSOMAGPIAC_LIVE_ENV', false),

    'username' => env('CSOMAGPIAC_USERNAME'),
    'password' => env('CSOMAGPIAC_PASSWORD'),

    'live_url' => env('CSOMAGPIAC_LIVE_URL', 'https://bestr.csomagpiac.hu/api/v1/'),
    'test_url' => env('CSOMAGPIAC_TEST_URL', 'https://demo.csomagpiac.hu/api/v1/'),
];
