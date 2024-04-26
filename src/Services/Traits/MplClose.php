<?php

namespace Cserepesmark\LaravelCsomagpiac\Services\Traits;

use Cserepesmark\LaravelCsomagpiac\Exceptions\CsomagpiacResponseException;

trait MplClose
{
    /**
     * Egyazon beszállítással feladni kívánt MPL csomagok halmazának zárása, továbbá a zárásról egy szállítólevél
     * igénylése.
     *
     * @return mixed
     * @throws CsomagpiacResponseException
     */
    public function handleMplClose($data)
    {
        $token = $this->authenticate();

        return $this->apiClient->post('mplclose', $token, $data);
    }

    /**
     * MPL zárások listája.
     *
     * @throws CsomagpiacResponseException
     */
    public function listMplCloses($page = 1, $countPerPage = 25)
    {
        $token = $this->authenticate();

        $data = [
            'page' => $page,
            'countPerPage' => $countPerPage,
        ];

        return $this->apiClient->get('mplcloseslist', $token, $data);
    }

    /**
     * MPL zárás szállítólevelének lekérdezése.
     *
     * @throws CsomagpiacResponseException
     */
    public function downloadMplClose($identifier)
    {
        $token = $this->authenticate();

        return $this->apiClient->getFile("mplclosepdf/$identifier", $token);
    }
}
