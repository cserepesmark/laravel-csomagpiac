<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;

class CreateShipmentExample
{
    public static function run($pickupPointId)
    {
        $data = [
            'pickupPointId' => $pickupPointId,
            'recipientName' => 'John Doe',
            'recipientCountryCode' => 'HU',
            'recipientZip' => '1011',
            'recipientCity' => 'Budapest',
            'recipientAddress' => 'Alfa utca 1',
            'recipientPhone' => '+36 30 123 4567',
            'recipientEmail' => 'john.doe@csomagpiac.hu',
            'packageCount' => 1,
            'weights' => [10000],
            'weightUnit' => 'g',
        ];

        return (new ShipmentService)
            ->createShipment($data);
    }
}
