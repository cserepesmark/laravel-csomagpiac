<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;

class HandleMplCloseExample
{
    public static function run()
    {
        $data = [
            'fromDate' => today()->subWeek()->format('Y-m-d'),
            'toDate' => today()->format('Y-m-d'),
        ];

        return (new ShipmentService)
            ->handleMplClose($data);
    }
}
