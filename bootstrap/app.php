<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'consultation',
            'ticket/*/cancel',
            'ticket/*/reschedule',
            'admin/login',
            'admin/bookings/*',
        ]);
        $middleware->redirectTo(
            guests: '/admin/login',
            users: '/admin/dashboard'
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Catch 419 Page Expired / TokenMismatchException on Admin forms & routes
        $exceptions->renderable(function (TokenMismatchException $e, $request) {
            if ($request->is('admin*')) {
                return redirect()->route('admin.login')->with('error', 'Your session has expired due to inactivity. Please sign in again.');
            }
            return redirect()->route('admin.login')->with('error', 'Your session has expired. Please sign in again.');
        });

        // Catch Unauthenticated / AuthenticationException on Admin routes
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('admin*')) {
                return redirect()->route('admin.login')->with('error', 'Your session has expired. Please sign in again.');
            }
        });

        // Fallback for any 419 or 500 session errors on admin routes
        $exceptions->renderable(function (HttpException $e, $request) {
            if ($request->is('admin*') && in_array($e->getStatusCode(), [419, 500, 401, 403])) {
                return redirect()->route('admin.login')->with('error', 'Your session has expired. Please sign in again.');
            }
        });
    })->create();
