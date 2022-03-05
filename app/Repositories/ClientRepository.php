<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ClientRepository implements ClientRepositoryInterface
{
    use BaseRepository;

    /**
     * @param User $model
     */
    public function __construct(
        protected Client $model
    ) {}

    public function addClient(
        string $name,
        string $country = null,
        string $city = null,
        string $postcode = null,
        string $street = null,
        string $houseNumber = null
    ): Client|null {
        return Client::create([
            'name' => $name,
            'country' => $country,
            'city' => $city,
            'postcode' => $postcode,
            'street' => $street,
            'house_number' => $houseNumber
        ]);
    }
}
