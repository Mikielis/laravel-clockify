<?php

namespace App\Providers;

use App\Repositories\UserActivityRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\Auth\UserAuthService;
use App\Services\UserActivity\UserActivityService;
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
        $this->app->bind(UserRepositoryInterface::class, UserAuthService::class);
        $this->app->bind(UserActivityRepositoryInterface::class, UserActivityService::class);
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
