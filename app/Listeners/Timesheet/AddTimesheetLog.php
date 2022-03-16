<?php

namespace App\Listeners\Timesheet;

use App\Services\UserActivity\UserActivityService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddTimesheetLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(protected UserActivityService $userActivityService)
    {}

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->userActivityService->logAddedRecord('timesheet');
    }
}
