<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TimesheetRepositoryInterface
{
    /**
     * Add timesheet
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $devTime
     * @param string $clientId
     * @param string $userId
     * @return void
     */
    public function addTimesheet(
        string $dateFrom,
        string $dateTo,
        string $devTime,
        string $clientId,
        string $userId,
    ): void;

    /**
     * Save timesheet
     * @param string $id
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $devTime
     * @param string $clientId
     * @param string $userId
     * @return void
     */
    public function saveTimesheet(
        string $id,
        string $dateFrom,
        string $dateTo,
        string $devTime,
        string $clientId,
        string $userId,
    ): void;

    /**
     * Get records
     * @param string $userId
     * @return Collection|null
     */
    public function getUserRecords(string $userId): ?Collection;

    /**
     * Disable timesheet
     * @param string $id
     * @return void
     */
    public function disable(string $id): void;
}
