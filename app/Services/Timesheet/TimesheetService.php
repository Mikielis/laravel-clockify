<?php

namespace App\Services\Timesheet;

use App\Models\Timesheet;
use App\Repositories\TimesheetRepositoryInterface;
use App\Services\UserActivity\UserActivityService;
use App\Events\Timesheet\Add as AddTimesheetEvent;
use App\Events\Timesheet\Disable as DisableTimesheetEvent;
use App\Events\Timesheet\Edit as EditTimesheetEvent;
use App\Events\Timesheet\Save as SaveTimesheetEvent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TimesheetService
{
    public static array $messages = [
        'timesheet added' => 'Dev time has been reported',
        'timesheet saved' => 'Dev time has been reported',
        'timesheet disabled' => 'Dev time has been disabled',
        'error' => 'Something went wrong',
    ];

    public function __construct(
        protected UserActivityService $userActivityService,
        protected TimesheetRepositoryInterface $timesheetRepository
    ) {}

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
    ): void
    {
        // Add
        $this->timesheetRepository->addTimesheet($dateFrom, $dateTo, $devTime, $clientId, $userId);

        // Trigger event
        AddTimesheetEvent::dispatch();
    }


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
    ): void
    {
        $timesheet = $this->timesheetRepository->find($id);

        // Timesheet not found
        if (!$timesheet) {
            Log::info(Auth::user()->name . ' has tried to save non-existing dev hours with ID: ' . $id);
            abort(404);
        }

        // Save
        $this->clientRepository->saveTimesheet($id, $dateFrom, $dateTo, $devTime, $clientId, $userId);

        // Trigger event
        SaveTimesheetEvent::dispatch();
    }

    /**
     * Disable
     * @param string $id
     * @return void
     */
    public function disable(string $id): void
    {
        $timesheet = $this->clientRepository->find($id);

        // Timesheet not found
        if (!$timesheet) {
            Log::info(Auth::user()->name . ' has tried to disable non-existing dev hours with ID: ' . $id);
            abort(404);
        }

        // Disable
        $this->timesheetRepository->disable($timesheet->id);

        // Trigger event
        DisableTimesheetEvent::dispatch();
    }

    /**
     * Get
     * @param string $id
     * @return Timesheet|null
     */
    public function getTimesheet(string $id): ?Timesheet
    {
        $timesheet = $this->timesheetRepository->find($id);

        // Timesheet not found
        if (!$timesheet) {
            Log::info(Auth::user()->name . ' has tried to edit non-existing dev hours with ID: ' . $id);
            abort(404);
        }

        // Trigger event
        EditTimesheetEvent::dispatch();

        return $timesheet;
    }

    /**
     * Get all
     * @param string $userId
     * @return Collection|null
     */
    public function getUserRecords(string $userId): ?Collection
    {
        return $this->timesheetRepository->getUserRecords($userId);
    }
}
