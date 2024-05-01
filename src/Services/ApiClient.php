<?php

namespace Cserepesmark\LaravelCsomagpiac\Services;

use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacResponseException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    /**
     * @throws CsomagpiacResponseException
     */
    protected function request($method, $uri, $token, $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json',
            'Authorization' => "Bearer $token"
        ])->$method(CsomagpiacService::getBaseUrl() . $uri, $data);

        if (!$response->successful()) {
            if ($response->status() === 401) {
                Cache::forget(TokenManager::TOKEN_CACHE_KEY);
            }

            $content = $response->json();
            throw new CsomagpiacResponseException(
                $content['message'],
                code: $content['status'],
                errors: $content['errors'] ?? (empty($content['error']) ? [] : [$content['error']])
            );
        }

        return $response;
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function post($uri, $token, $data = [])
    {
        return $this->request('post', $uri, $token, $data)
            ->json();
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function get($uri, $token, $data = [])
    {
        return $this->request('get', $uri, $token, $data)
            ->json();
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function getFile($uri, $token, $data = [])
    {
        return $this->request('get', $uri, $token, $data)
            ->body();
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function delete($uri, $token)
    {
        return $this->request('delete', $uri, $token)
            ->json();
    }
}
