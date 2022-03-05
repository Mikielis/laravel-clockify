<?php

namespace App\Services\Client;

use App\Repositories\ClientRepositoryInterface;
use App\Services\UserActivity\UserActivityService;

class ClientService
{
    public static array $messages = [
        'client added' => 'The client has been added',
        'client edited' => 'The client details have been saved',
        'client deleted' => 'The client has been deleted',
        'error' => 'Something went wrong',
    ];

    public function __construct(
        protected UserActivityService $userActivityService,
        protected ClientRepositoryInterface $clientRepository
    ) {}

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

        // Log user activity
        $this->userActivityService->logSentForm('adding client');
        if ($client) {
            $this->userActivityService->logAddedRecord('client');

            return true;
        }

        return false;
    }
}
