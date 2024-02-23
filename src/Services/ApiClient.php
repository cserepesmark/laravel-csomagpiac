<?php

namespace Cserepesmark\LaravelCsomagpiac\Services;

use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacResponseException;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    /**
     * @throws CsomagpiacResponseException
     */
    public function post($uri, $token, $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json',
            'Authorization' => "Bearer $token"
        ])->post(CsomagpiacService::getBaseUrl() . $uri, $data);

        $content = $response->json();

        if (!$response->successful()) {
             throw new CsomagpiacResponseException(
                 $content['message'],
                 code: $content['status'],
                 errors: $content['errors']
             );
        }

        return $content;
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function get($uri, $token, $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json',
            'Authorization' => "Bearer $token"
        ])->get(CsomagpiacService::getBaseUrl() . $uri, $data);

        $content = $response->json();

        if (!$response->successful()) {
            throw new CsomagpiacResponseException(
                $content['message'],
                code: $content['status'],
                errors: $content['errors']
            );
        }

        return $content;
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function getFile($uri, $token, $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json',
            'Authorization' => "Bearer $token"
        ])->get(CsomagpiacService::getBaseUrl() . $uri, $data);

        $content = $response->json();

        if (!$response->successful()) {
            throw new CsomagpiacResponseException(
                $content['message'],
                code: $content['status'],
                errors: $content['errors']
            );
        }

        return $response->body();
    }
}
