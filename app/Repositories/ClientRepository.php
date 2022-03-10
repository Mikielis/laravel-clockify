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

    /**
     * @param string $name
     * @param string|null $country
     * @param string|null $city
     * @param string|null $postcode
     * @param string|null $street
     * @param string|null $houseNumber
     * @return Client|null
     */
    public function addClient(
        string $name,
        string|null $country,
        string|null $city,
        string|null $postcode,
        string|null $street,
        string|null $houseNumber
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
