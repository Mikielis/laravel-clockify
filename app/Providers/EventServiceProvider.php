<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UserPermissionsSetup;
use App\Listeners\AuthenticationLog;
use App\Listeners\LogoutLog;

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
        ]
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
