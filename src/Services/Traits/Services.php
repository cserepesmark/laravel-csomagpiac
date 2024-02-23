<?php

namespace Cserepesmark\LaravelCsomagpiac\Services\Traits;

trait Services
{
    /**
     * Elérhető szolgáltatások listája
     *
     * @return array|mixed
     */
    public function listClientServices()
    {
        $token = $this->authenticate();

        return $this->apiClient->get('client/services', $token);
    }

    /**
     * Szolgáltatók listája
     *
     * @return array|mixed
     */
    public function listHandlers()
    {
        $token = $this->authenticate();

        return $this->apiClient->get('handlers', $token);
    }
}
