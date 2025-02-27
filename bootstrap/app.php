<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->push(RoleMiddleware::class); // Register the custom RoleMiddleware
    })
    ->create();

return $app;
