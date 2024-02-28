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
            $response = Http::withHeaders([
                'Content-Type' => 'application/vnd.api+json',
                'Accept' => 'application/vnd.api+json',
            ])->post(CsomagpiacService::getBaseUrl() . 'authenticate', [
                'username' => config('csomagpiac.username'),
                'password' => config('csomagpiac.password')
            ]);

            if ($response->successful()) {
                return $response->json()['token'];
            }

            return false;
        });
    }
}
