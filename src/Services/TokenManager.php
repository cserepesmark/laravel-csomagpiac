<?php

namespace Cserepesmark\LaravelCsomagpiac\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TokenManager
{
    const TOKEN_CACHE_KEY = 'csomagpiac_api_token';

    public function getToken()
    {
        if (config('csomagpiac.token')) {
            return config('csomagpiac.token');
        }

        return Cache::remember(self::TOKEN_CACHE_KEY, 3600, function () {
            $response = Http::post(CsomagpiacService::getBaseUrl() . 'authenticate', [
                'username' => config('services.csomagpiac.username'),
                'password' => config('services.csomagpiac.password')
            ]);

            if ($response->successful()) {
                $token = $response->json()['token'];
                return $token;
            } else {
                // Handle errors, maybe throw an exception
            }
        });
    }
}
