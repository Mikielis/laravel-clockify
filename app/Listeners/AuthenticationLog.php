<?php

namespace App\Listeners;

use App\Services\UserActivity\UserActivityService;


class AuthenticationLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        protected UserActivityService $userActivityService
    ) {}

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->userActivityService->logAuthentication();
    }
}
