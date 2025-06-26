<?php

namespace App\Providers;

use App\Services\NotificationService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rules\Password;


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
        App::setLocale('lt');

        // Add scheduling here
        $this->app->booted(function () {
            $this->app->make(Schedule::class)->command('reservations:auto-complete')->dailyAt('00:00');
        });

        // Set strong password requirements
        Password::defaults(function () {
            return Password::min(8)
                ->letters()          // Must contain letters
                ->mixedCase()        // Must contain both upper and lowercase letters
                ->numbers()          // Must contain at least one number
                ->symbols()          // Optional: require symbols
                ->uncompromised();   // Check against data breaches
        });
    }
}
