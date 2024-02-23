<?php

namespace Cserepesmark\LaravelCsomagpiac;

use Cserepesmark\LaravelCsomagpiac\Services\ApiClient;
use Cserepesmark\LaravelCsomagpiac\Services\CsomagpiacService;
use Cserepesmark\LaravelCsomagpiac\Services\TokenManager;
use Illuminate\Support\ServiceProvider;

class CsomagpiacServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CsomagpiacService::class, function ($app) {
            return new CsomagpiacService(
                new ApiClient,
                new TokenManager
            );
        });
    }
}
