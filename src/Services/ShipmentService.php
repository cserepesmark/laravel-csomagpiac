<?php

namespace Cserepesmark\LaravelCsomagpiac\Services;

use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacResponseException;
use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacValidationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShipmentService
{
    private CsomagpiacService $csomagpiacService;

    public function __construct()
    {
        $this->csomagpiacService = app(CsomagpiacService::class);
    }

    /**
     * @throws CsomagpiacValidationException
     * @throws CsomagpiacResponseException
     */
    public function listShipments(array $data = [])
    {
        $validator = Validator::make($data, [
            'page' => ['sometimes', 'integer', 'min:1'],
            'countPerPage' => ['sometimes', 'integer'],
            'startTimestamp' => ['sometimes', 'integer', 'before_or_equal:endTimestamp'],
            'endTimestamp' => ['required_if:startTimestamp,!=,null', 'integer', 'after:startTimestamp', function ($attribute, $value, $fail) use ($data) {
                $start = Carbon::parse($data['startTimestamp'] ?? null);
                $end = Carbon::parse($data['endTimestamp']);
                if ($end->diffInHours($start) > 24) {
                    $fail('Az ' . $attribute . ' nem lehet több, mint 24 órával a kezdő időpont után.');
                }
            }],
        ]);

        if ($validator->fails()) {
            throw new CsomagpiacValidationException(
                'List shipment validation error',
                errors: $validator->errors()->toArray()
            );
        }

        return $this->csomagpiacService->listShipments($data);
    }

    /**
     * @throws CsomagpiacValidationException
     * @throws CsomagpiacResponseException
     */
    public function createShipment(array $data)
    {
        $validator = Validator::make($data, [
            'pickupPointId' => ['required', 'integer'],
            'recipientName' => ['required', 'string', 'max:40'],
            'recipientCountryCode' => ['required', 'string', 'max:3'],
            'recipientZip' => ['required', 'string', 'max:10'],
            'recipientCity' => ['required', 'string', 'max:40'],
            'recipientAddress' => ['required', 'string', 'max:40'],
            'recipientPhone' => ['required', 'string', 'max:20'],
            'recipientEmail' => ['required', 'email:rfc,dns', 'max:100'],
            'packageCount' => ['sometimes', 'integer', 'min:1', 'max:99'],
            'weights.*' => ['sometimes', 'integer', 'max:100000'],
            'weightUnit' => ['sometimes', 'string', Rule::in(['g', 'dkg', 'kg'])],
            'insuredValue' => ['sometimes', 'integer', 'max:1000000'],
            'observation' => ['sometimes', 'string', 'max:100'],
            'reference' => ['sometimes', 'string', 'max:100'],
            'parcelValue' => ['sometimes', 'integer', 'max:1000000'],
            'cashOnDelivery' => ['sometimes', 'integer', 'max:1000000'],
            'services.*.name' => ['sometimes', 'string'],
            'services.*.value' => ['sometimes', 'string'],
        ]);

        if ($validator->fails()) {
            throw new CsomagpiacValidationException(
                'Create shipment validation error',
                errors: $validator->errors()->toArray()
            );
        }

        return $this->csomagpiacService->createShipment($validator->validated());
    }

    /**
     * @throws CsomagpiacValidationException
     * @throws CsomagpiacResponseException
     */
    public function downloadShipmentLabel(array $data)
    {
        $validator = Validator::make($data, [
            'identifier' => ['required', 'string'],
            'format' => ['sometimes', Rule::in(['A4', 'A6'])],
        ]);

        if ($validator->fails()) {
            throw new CsomagpiacValidationException(
                'Download shipment label validation error',
                errors: $validator->errors()->toArray()
            );
        }

        return $this->csomagpiacService->downloadShipmentLabel(
            identifier: $validator->getValue('identifier'),
            format: $validator->getValue('format')
        );
    }

    /**
     * @throws CsomagpiacValidationException
     * @throws CsomagpiacResponseException
     */
    public function getShipmentStatus(array $data)
    {
        $validator = Validator::make($data, [
            'identifier' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            throw new CsomagpiacValidationException(
                'Get shipment status validation error',
                errors: $validator->errors()->toArray()
            );
        }

        return $this->csomagpiacService->getShipmentStatus(
            identifier: $validator->getValue('identifier')
        );
    }

    /**
     * @throws CsomagpiacValidationException
     * @throws CsomagpiacResponseException
     */
    public function listShipmentHistories(array $data)
    {
        $validator = Validator::make($data, [
            'identifier' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            throw new CsomagpiacValidationException(
                'List shipment histories validation error',
                errors: $validator->errors()->toArray()
            );
        }

        return $this->csomagpiacService->listShipmentHistories(
            identifier: $validator->getValue('identifier')
        );
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function listAllStatuses()
    {
        return $this->csomagpiacService->listAllStatuses();
    }
}
