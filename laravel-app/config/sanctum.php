<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. Typically, these should include your local
    | and production domains which access your API via a frontend SPA.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', (function() {
        $domains = 'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1';
        
        // Add APP_URL domain if configured
        if ($appUrl = config('app.url')) {
            $host = parse_url($appUrl, PHP_URL_HOST);
            if ($host && strpos($domains, $host) === false) {
                $domains .= ',' . $host;
            }
        }
        
        // Add Codespaces domain pattern if in Codespaces
        if ($codespace = env('CODESPACE_NAME')) {
            $port = env('CODESPACE_PORT', 8000);
            $codespaceDomain = "{$codespace}-{$port}.preview.app.github.dev";
            if (strpos($domains, $codespaceDomain) === false) {
                $domains .= ',' . $codespaceDomain;
            }
        }
        
        return $domains;
    })())),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | This array contains the authentication guards that will be checked when
    | Sanctum is trying to authenticate a request. If none of these guards
    | are able to authenticate the request, Sanctum will use the bearer
    | token that's present on an incoming request for authentication.
    |
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued token will be
    | considered expired. If this value is null, personal access tokens do
    | not expire. This won't tweak the lifetime of first-party sessions.
    |
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | When authenticating your first-party SPA with Sanctum you may need to
    | customize some of the middleware Sanctum uses while processing the
    | request. You may change the middleware listed below as required.
    |
    */

    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],

];
