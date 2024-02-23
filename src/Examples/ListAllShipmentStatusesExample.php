<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;

class ListAllShipmentStatusesExample
{
    public static function run()
    {
        return (new ShipmentService)
            ->listAllStatuses();
    }
}
