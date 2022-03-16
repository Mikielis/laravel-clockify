<?php

namespace App\Listeners\Project;

use App\Services\UserActivity\UserActivityService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProjectFormLog
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
        $this->userActivityService->logSentForm('adding project');
    }
}
