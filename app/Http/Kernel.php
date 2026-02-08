<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [

        // Trust proxy (important if behind cloudflare/nginx)
        \App\Http\Middleware\TrustProxies::class,

        // Handle CORS
        \Illuminate\Http\Middleware\HandleCors::class,

        // Prevent maintenance access
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // Validate request size
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // Trim strings
        \App\Http\Middleware\TrimStrings::class,

        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [

        /*
        |--------------------------------------------------------------------------
        | Web Middleware
        |--------------------------------------------------------------------------
        */
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,

            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            \Illuminate\Session\Middleware\StartSession::class,

            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            \App\Http\Middleware\VerifyCsrfToken::class,

            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        /*
        |--------------------------------------------------------------------------
        | API Middleware (With Sanctum)
        |--------------------------------------------------------------------------
        */
        'api' => [

            // Sanctum SPA Auth
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,

            // API Rate Limit
            'throttle:api',

            // Route model binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [

        // Role
        'role' => \App\Http\Middleware\RoleMiddleware::class,

        // Auth
        'auth' => \App\Http\Middleware\Authenticate::class,

        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,

        // Authorization
        'can' => \Illuminate\Auth\Middleware\Authorize::class,

        // Guest redirect
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // Password confirm
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

        // Signed URLs
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,

        // Throttle
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // Email verified
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
