<?php

use App\Http\Middleware\ProviderMiddleware;
use App\Http\Middleware\SeekerMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware aliases
        $middleware->alias([
            'provider' => \App\Http\Middleware\ProviderMiddleware::class,
            'seeker' => \App\Http\Middleware\SeekerMiddleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
