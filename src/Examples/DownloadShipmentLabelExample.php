<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;
use Illuminate\Support\Facades\Storage;

class DownloadShipmentLabelExample
{
    public static function run($cspIdentifier)
    {
        $data = [
            'identifier' => $cspIdentifier,
            'format' => 'A4',
        ];

        $content = (new ShipmentService)
            ->downloadShipmentLabel($data);

        Storage::disk('local')
            ->put("shipment-labels/$cspIdentifier.pdf", $content);

        return true;
    }
}
