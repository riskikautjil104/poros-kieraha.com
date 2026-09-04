<?php

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: 'apikuporos',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // TAMBAHKAN INI 👇
        $middleware->alias([
            'role'                => CheckRole::class,
            'rate.limit.comments' => \App\Http\Middleware\RateLimitComments::class,
            'security.headers'    => SecurityHeaders::class,
            'is.verified'         => \App\Http\Middleware\EnsureIsVerified::class,
            'track.visitor'       => \App\Http\Middleware\TrackVisitor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
