<?php

namespace App\Services\Client;

use App\Repositories\ClientRepositoryInterface;
use App\Services\UserActivity\UserActivityService;
use App\Events\Client\Add as AddClientEvent;
use Illuminate\Database\Eloquent\Collection;


class ClientService
{
    use Country;

    public static array $messages = [
        'client added' => 'The client has been added',
        'client save' => 'The client details have been saved',
        'client disabled' => 'The client has been disabled',
        'error' => 'Something went wrong',
    ];

    public function __construct(
        protected UserActivityService $userActivityService,
        protected ClientRepositoryInterface $clientRepository
    ) {}

    /**
     * Add client
     * @param string $name
     * @param string|null $country
     * @param string|null $city
     * @param string|null $postcode
     * @param string|null $street
     * @param string|null $houseNumber
     * @return bool
     */
    public function addClient(
        string $name,
        string $country = null,
        string $city = null,
        string $postcode = null,
        string $street = null,
        string $houseNumber = null
    ): bool
    {
        // Add new client
        $client = $this->clientRepository->addClient($name, $country, $city, $postcode, $street, $houseNumber);

        if ($client) {
            AddClientEvent::dispatch();
            return true;
        }

        return false;
    }

    /**
     * Get clients
     * @return Collection|null
     */
    public function getClients(): ?Collection
    {
        return $this->clientRepository->getClients(true);
    }
}
