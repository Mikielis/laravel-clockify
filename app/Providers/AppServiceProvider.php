<?php

namespace App\Providers;

use App\Repositories\ClientRepository;
use App\Repositories\UserActivityRepository;
use App\Repositories\UserRepository;
use App\Services\Auth\UserAuthAllowedDomains;
use App\Services\Auth\UserAuthService;
use App\Services\UserActivity\UserActivityService;
use App\Services\Client\ClientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Services
        $this->app->bind(UserActivityService::class, function($app) {
            return new UserActivityService($app->make(UserActivityRepository::class));
        });

        $this->app->bind(UserAuthService::class, function($app) {
            return new UserAuthService(
                $app->make(UserRepository::class),
                new UserAuthAllowedDomains
            );
        });


        $this->app->bind(ClientService::class, function($app) {
            return new ClientService(
                $this->app->make(UserActivityService::class),
                $this->app->make(ClientRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
