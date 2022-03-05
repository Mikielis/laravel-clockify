<?php

namespace App\Repositories;

use App\Models\Client;

interface ClientRepositoryInterface
{
    public function addClient(
        string $name,
        string $country = null,
        string $city = null,
        string $postcode = null,
        string $street = null,
        string $houseNumber = null
    ): Client|null;
}
