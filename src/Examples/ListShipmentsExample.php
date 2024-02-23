<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;
use Illuminate\Support\Facades\Storage;

class ListShipmentsExample
{
    public static function run($data)
    {
        return (new ShipmentService)
            ->listShipments($data);
    }
}
