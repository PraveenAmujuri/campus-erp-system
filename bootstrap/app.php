<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    /*
    Application Routing Configuration
    Register web routes, console commands, and application health check endpoint.
    */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    /*
    Middleware Registration
    Register custom middleware aliases
    used across the application routes.
    */
    ->withMiddleware(function (Middleware $middleware): void {

        // Register role middleware for RBAC authorization
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

    })

    /*
    Exception Handling Configuration
    */
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();