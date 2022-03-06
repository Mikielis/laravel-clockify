<?php

namespace App\Listeners\UserAccess;

use App\Services\UserPermission\UserPermissionManagerService;
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
