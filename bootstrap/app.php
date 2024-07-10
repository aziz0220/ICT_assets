<?php

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
//        $middleware->use([
////            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
////            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
////            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
//            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
//            'can' => \Illuminate\Auth\Middleware\Authorize::class,
//            'guest' => Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
//            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
//            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
//            'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
//            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
//            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
//            'signed' => Illuminate\Routing\Middleware\ValidateSignature::class,
//            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
//            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
//        ]);
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'signed' => Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'role' => Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        $middleware->group('api', [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
