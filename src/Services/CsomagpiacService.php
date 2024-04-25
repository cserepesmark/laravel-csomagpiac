<?php

namespace Cserepesmark\LaravelCsomagpiac\Services;

use Cserepesmark\LaravelCsomagpiac\Services\Traits\Locations;
use Cserepesmark\LaravelCsomagpiac\Services\Traits\MplClose;
use Cserepesmark\LaravelCsomagpiac\Services\Traits\Services;
use Cserepesmark\LaravelCsomagpiac\Services\Traits\Shipments;

class CsomagpiacService
{
    use Locations;
    use MplClose;
    use Services;
    use Shipments;

    protected ApiClient $apiClient;
    protected TokenManager $tokenManager;

    public function __construct(ApiClient $apiClient, TokenManager $tokenManager)
    {
        $this->apiClient = $apiClient;
        $this->tokenManager = $tokenManager;
    }

    /**
     * Az API hívásokhoz szükséges token generálása.
     *
     * @return array|mixed
     */
    public function authenticate()
    {
        return $this->tokenManager->getToken();
    }

    public static function getBaseUrl(): string
    {
        return config('csomagpiac.live_env')
            ? config('csomagpiac.live_url')
            : config('csomagpiac.test_url');
    }
}
