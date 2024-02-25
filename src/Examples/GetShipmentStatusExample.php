<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;

class GetShipmentStatusExample
{
    public static function run($cspIdentifier)
    {
        return (new ShipmentService)
            ->getShipmentStatus([
                'identifier' => $cspIdentifier
            ]);
    }
}
