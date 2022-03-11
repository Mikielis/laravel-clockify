<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

interface ClientRepositoryInterface
{
    /**
     * Add client
     * @param string $name
     * @param string|null $country
     * @param string|null $city
     * @param string|null $postcode
     * @param string|null $street
     * @param string|null $houseNumber
     * @return void
     */
    public function addClient(
        string $name,
        string|null $country,
        string|null $city,
        string|null $postcode,
        string|null $street,
        string|null $houseNumber
    ): void;

    /**
     * Get clients
     * @param bool|null $sortByName
     * @return Collection|null
     */
    public function getClients(null|bool $sortByName): ?Collection;
}
