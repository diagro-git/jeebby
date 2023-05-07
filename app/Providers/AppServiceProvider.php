<?php

namespace App\Providers;

use App\Services\StorageService;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Actions\UpdateTeamMemberRole;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UpdateTeamMemberRole::class, \App\Extensions\Jetstream\UpdateTeamMemberRole::class);
        $this->app->bind(StorageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
