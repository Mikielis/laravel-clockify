<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface ProjectRepositoryInterface
{
    /**
     * Add project
     * @param string $name
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param string|null $deadline
     * @param int|null $devTimeLimit
     * @param string $clientId
     * @param string|null $trelloBoard
     * @param string|null $note
     * @return void
     */
    public function addProject(
        string $name,
        ?string $dateFrom,
        ?string $dateTo,
        ?string $deadline,
        ?int $devTimeLimit,
        string $clientId,
        ?string $trelloBoard,
        ?string $note,
    ): void;

    /**
     * Save project
     * @param string $id
     * @param string $name
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param string|null $deadline
     * @param int|null $devTimeLimit
     * @param string $clientId
     * @param string|null $trelloBoard
     * @param string|null $note
     * @return void
     */
    public function saveProject(
        string $id,
        string $name,
        ?string $dateFrom,
        ?string $dateTo,
        ?string $deadline,
        ?int $devTimeLimit,
        string $clientId,
        ?string $trelloBoard,
        ?string $note,
    ): void;

    /**
     * Get projects
     * @param bool|null $sortByName
     * @param bool|null $sortByClientName
     * @return SupportCollection|null
     */
    public function getProjects(?bool $sortByName = null, ?bool $sortByClientName = null): ?SupportCollection;

    /**
     * Disable project
     * @param string $id
     * @return void
     */
    public function disable(string $id): void;
}
