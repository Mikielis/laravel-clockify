<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
     * @return void
     */
    public function addClient(
        string $name,
        string|null $country,
        string|null $city,
        string|null $postcode,
        string|null $street,
        string|null $houseNumber
    ): void {
        Client::create([
            'name' => $name,
            'country' => $country,
            'city' => $city,
            'postcode' => $postcode,
            'street' => $street,
            'house_number' => $houseNumber
        ]);
    }

    /**
     * Get clients
     * @param bool|null $sortByName
     * @return Collection|null
     */
    public function getClients(null|bool $sortByName): ?Collection
    {
        // Return list sorted by client name
        if (true == $sortByName) {
            return Client::all()->sortBy('name');
        }

        // Return list sorted by id
        return Client::all();
    }
}
