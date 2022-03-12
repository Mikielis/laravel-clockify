<?php

namespace App\Services\Client;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use App\Services\UserActivity\UserActivityService;
use App\Events\Client\Add as AddClientEvent;
use App\Events\Client\Disable as DisableClientEvent;
use App\Events\Client\Edit as EditClientEvent;
use App\Events\Client\Save as SaveClientEvent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ClientService
{
    use Country;

    public static array $messages = [
        'client added' => 'The client has been added',
        'client saved' => 'The client details have been saved',
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
     * @return void
     */
    public function addClient(
        string $name,
        string $country = null,
        string $city = null,
        string $postcode = null,
        string $street = null,
        string $houseNumber = null
    ): void
    {
        // Add new client
        $this->clientRepository->addClient($name, $country, $city, $postcode, $street, $houseNumber);

        // Trigger event
        AddClientEvent::dispatch();
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
     * @return bool
     */
    public function saveClient(
        string $id,
        string $name,
        string $country = null,
        string $city = null,
        string $postcode = null,
        string $street = null,
        string $houseNumber = null
    ): void
    {
        $client = $this->clientRepository->find($id);

        // Client not found
        if (!$client) {
            Log::info(Auth::user()->name . ' has tried to save non-existing client with ID: ' . $id);
            abort(404);
        }

        // Add new client
        $this->clientRepository->saveClient($id, $name, $country, $city, $postcode, $street, $houseNumber);

        // Trigger event
        SaveClientEvent::dispatch();
    }

    /**
     * Disable client
     * @param string $id
     * @return void
     */
    public function disable(string $id): void
    {
        // Find client
        $client = $this->clientRepository->find($id);

        // Client not found
        if (!$client) {
            Log::info(Auth::user()->name . ' has tried to disable non-existing client with ID: ' . $id);
            abort(404);
        }

        // Disable client and trigger event
        $this->clientRepository->disable($client->id);
        DisableClientEvent::dispatch();
    }

    /**
     * Get client
     * @param string $id
     * @return Client|null
     */
    public function getClient(string $id): ?Client
    {
        $client = $this->clientRepository->find($id);

        // Client not found
        if (!$client) {
            Log::info(Auth::user()->name . ' has tried to edit non-existing client with ID: ' . $id);
            abort(404);
        }

        EditClientEvent::dispatch();

        return $client;
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
