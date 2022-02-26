<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Auth\UserPermissionManagerService;
use Illuminate\Support\Facades\Auth;

class UserPermissionsSetup
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(protected UserPermissionManagerService $userPermissionManagerService)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->userPermissionManagerService->setUserPermissions(Auth::user()->getAuthIdentifier());
    }
}
