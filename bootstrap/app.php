<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register custom middleware untuk handle unauthenticated redirect
        $middleware->web(append: [
            \App\Http\Middleware\HandleUnauthenticatedRedirect::class,
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle unauthenticated access
        $exceptions->render(function (Throwable $e) {
            if ($e instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) {
                if (request()->is('admin/*') && !auth()->check()) {
                    return redirect()->route('login')
                        ->with('error', 'Silakan login terlebih dahulu untuk mengakses area admin.');
                }
            }
            return null;
        });
    })->create();
