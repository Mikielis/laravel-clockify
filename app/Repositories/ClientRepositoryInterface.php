<?php

namespace App\Repositories;

use App\Models\Client;

interface ClientRepositoryInterface
{
    public function addClient(
        string $name,
        string|null $country,
        string|null $city,
        string|null $postcode,
        string|null $street,
        string|null $houseNumber
    ): Client|null;
}
