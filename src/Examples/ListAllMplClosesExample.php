<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacResponseException;
use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacValidationException;
use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;

class ListAllMplClosesExample
{
    /**
     * @throws CsomagpiacResponseException
     * @throws CsomagpiacValidationException
     */
    public static function run($data = [])
    {
        return (new ShipmentService)
            ->listMplCloses($data);
    }
}
