<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;

class ListShipmentHistoriesExample
{
    public static function run($cspIdentifier)
    {
        return (new ShipmentService)
            ->listShipmentHistories([
                'identifier' => $cspIdentifier
            ]);
    }
}
