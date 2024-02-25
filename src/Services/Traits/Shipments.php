<?php

namespace Cserepesmark\LaravelCsomagpiac\Services\Traits;

use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacResponseException;

trait Shipments
{
    /**
     * Csomaglista lekérdezése a megadott időintervallumból. Az intervallum maximum 24 óra lehet.
     *
     * @return array|mixed
     * @throws CsomagpiacResponseException
     */
    public function listShipments(array $data)
    {
        $token = $this->authenticate();

        $data['page'] = $data['page'] ?? 1;
        $data['countPerPage'] = $data['countPerPage'] ?? 25;

        if (empty($data['startTimestamp']) || empty($data['endTimestamp'])) {
            $data['startTimestamp'] = now()->subHours(24)->timestamp;
            $data['endTimestamp'] = now()->timestamp;
        }

        dump($data);

        return $this->apiClient->get('shipment/list', $token, $data);
    }

    /**
     * Csomag státuszának a lekérdezése
     *
     * @return array|mixed
     * @throws CsomagpiacResponseException
     */
    public function getShipmentStatus($identifier)
    {
        $token = $this->authenticate();

        return $this->apiClient->get("shipment/status/$identifier", $token);
    }

    /**
     * Csomagtörténet lekérdezése
     *
     * @return array|mixed
     * @throws CsomagpiacResponseException
     */
    public function listShipmentHistories($identifier)
    {
        $token = $this->authenticate();

        return $this->apiClient->get("shipment/history/$identifier", $token);
    }

    /**
     * Elérhető szállítmány és csomag státuszok
     *
     * @return array|mixed
     * @throws CsomagpiacResponseException
     */
    public function listAllStatuses()
    {
        $token = $this->authenticate();

        return $this->apiClient->get('shipment/statuses', $token);
    }

    /**
     * Új küldemény létrehozáa
     *
     * @return array|mixed
     * @throws CsomagpiacResponseException
     */
    public function createShipment($data)
    {
        $token = $this->authenticate();

        return $this->apiClient->post('shipment/new', $token, $data);
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function downloadShipmentLabel($identifier, $format = 'A4')
    {
        $token = $this->authenticate();

        return $this->apiClient->getFile("shipment/download/$identifier/$format", $token);
    }

    /**
     * @throws CsomagpiacResponseException
     */
    public function deleteShipment($identifier)
    {
        $token = $this->authenticate();

        return $this->apiClient->delete("shipment/delete/$identifier", $token);
    }
}
