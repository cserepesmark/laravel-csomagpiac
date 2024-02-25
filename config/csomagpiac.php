<?php

return[

    'live_env' => env('CSOMAGPIAC_LIVE_ENV', false),

    'token' => env('CSOMAGPIAC_TOKEN', null),
    'username' => env('CSOMAGPIAC_USERNAME', null),
    'password' => env('CSOMAGPIAC_PASSWORD', null),

    'live_url' => env('CSOMAGPIAC_LIVE_URL', 'https://bestr.csomagpiac.hu/api/v1/'),
    'test_url' => env('CSOMAGPIAC_TEST_URL', 'https://demo.csomagpiac.hu/api/v1/'),
];
