<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\RoleMiddleware;
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

        /*
        |------------------------------------------------------
        | GLOBAL MIDDLEWARE (jalan di semua request)
        |------------------------------------------------------
        */
        $middleware->append(SetLocale::class);

        /*
        |------------------------------------------------------
        | ALIAS MIDDLEWARE (untuk route)
        | contoh: ->middleware('role:admin')
        |------------------------------------------------------
        */
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
