<?php

namespace Cserepesmark\LaravelCsomagpiac\Examples;

use Cserepesmark\LaravelCsomagpiac\Services\ShipmentService;
use Illuminate\Support\Facades\Storage;

class DownloadMplCloseExample
{
    public static function run($identifier)
    {
        $data = [
            'identifier' => $identifier,
        ];

        $response = (new ShipmentService)
            ->downloadMplClose($data);

        $content = json_decode($response, true);
        $fileContent = base64_decode($content['closeReportPdf']);

        Storage::disk('local')
            ->put("mpl-close/$identifier.pdf", $fileContent);

        return true;
    }
}
