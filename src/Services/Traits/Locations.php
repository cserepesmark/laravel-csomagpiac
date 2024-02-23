<?php

namespace Cserepesmark\LaravelCsomagpiac\Services\Traits;

trait Locations
{
    /**
     * Az űgyfél előre definiált felvételi pontjainak a lekérdezése.
     *
     * * @return array|mixed
     */
    public function listPickupPoints()
    {
        $token = $this->authenticate();

        $data = [
            'page' => 1,
            'countPerPage' => 25,
        ];

        return $this->apiClient->get('pickuppoints', $token, $data);
    }

    /**
     * Elérhető felvételi vagy kézbesítési pontok típusainak lekérdezése.
     *
     * @return array|mixed
     */
    public function listLocationTypes()
    {
        $token = $this->authenticate();

        return $this->apiClient->get('locations/types', $token);
    }

    /**
     * Előre definiált felvételi vagy kézbesítési pontok lekérdezése, ez lehet saját vagy partneré. pl. csomagpontok,
     * csomagautomaták, stb.
     *
     * @return array|mixed
     */
    public function listLocations()
    {
        $token = $this->authenticate();

        $data = [
            'page' => 1,
            'countPerPage' => 25,
            // 'typeId' => 7 // optional
        ];

        return $this->apiClient->get('locations/list', $token, $data);
    }
}
