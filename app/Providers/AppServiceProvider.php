<?php

namespace App\Providers;

use App\Services\NotificationService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Add scheduling here
        $this->app->booted(function () {
            $this->app->make(Schedule::class)->command('reservations:auto-complete')->dailyAt('00:00');
        });
    }
}
