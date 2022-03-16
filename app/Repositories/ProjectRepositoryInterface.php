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
        string|null $dateFrom,
        string|null $dateTo,
        string|null $deadline,
        int|null $devTimeLimit,
        string $clientId,
        string|null $trelloBoard,
        string|null $note,
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
        string|null $dateFrom,
        string|null $dateTo,
        string|null $deadline,
        int|null $devTimeLimit,
        string $clientId,
        string|null $trelloBoard,
        string|null $note,
    ): void;

    /**
     * Get projects
     * @param bool|null $sortByName
     * @return SupportCollection|null
     */
    public function getProjects(null|bool $sortByName): ?SupportCollection;

    /**
     * Disable project
     * @param string $id
     * @return void
     */
    public function disable(string $id): void;
}
