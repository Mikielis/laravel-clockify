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
     * Save client
     * @param string $id
     * @param string $name
     * @param string|null $country
     * @param string|null $city
     * @param string|null $postcode
     * @param string|null $street
     * @param string|null $houseNumber
     * @return void
     */
    public function saveClient(
        string $id,
        string $name,
        string|null $country,
        string|null $city,
        string|null $postcode,
        string|null $street,
        string|null $houseNumber
    ): void {
        $client = Client::find($id);

        $client->name = $name;
        $client->country = $country;
        $client->city = $city;
        $client->postcode = $postcode;
        $client->street = $street;
        $client->house_number = $houseNumber;

        $client->save();
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

    public function disable(string $id): void
    {
        Client::find($id)->delete();
    }
}
