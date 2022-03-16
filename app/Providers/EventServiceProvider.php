<?php

namespace App\Providers;

use App\Listeners\Auth\AuthenticationLog;
use App\Listeners\Auth\LogoutLog;
use App\Listeners\UserAccess\UserPermissionsSetup;
use App\Events\Client\Add as AddClientEvent;
use App\Events\Client\SendForm as SendClientFormEvent;
use App\Events\Project\Add as AddProjectEvent;
use App\Events\Project\SendForm as SendProjectFormEvent;
use App\Listeners\Client\AddClientLog;
use App\Listeners\Client\SendClientFormLog;
use App\Listeners\Project\AddProjectLog;
use App\Listeners\Project\SendProjectFormLog;
use App\Listeners\Project\AddTimesheetLog;
use App\Listeners\Project\SendTimesheetFormLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Execute listeners when user gets authenticated (logged in)
        Login::class => [
            UserPermissionsSetup::class,
            AuthenticationLog::class,
        ],

        // Execute listeners when user gets logged out
        Logout::class => [
            LogoutLog::class,
        ],

        // Execute listener when user sends form for adding a new client
        SendClientFormEvent::class => [
            SendClientFormLog::class
        ],

        // Execute listener when user successfully adds a new client
        AddClientEvent::class => [
            AddClientLog::class
        ],

        // Execute listener when user sends form for adding a new project
        SendProjectFormEvent::class => [
            SendProjectFormLog::class
        ],

        // Execute listener when user successfully adds a new project
        AddProjectEvent::class => [
            AddProjectLog::class
        ],

        // Execute listener when user sends form for reporting dev hours
        SendTimesheetFormEvent::class => [
            SendTimesheetFormLog::class
        ],

        // Execute listener when user successfully reports dev hours
        AddTimesheetEvent::class => [
            AddTimesheetLog::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
