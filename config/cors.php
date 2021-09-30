<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['POST', 'GET', 'DELETE', 'PUT', '*'],

    'allowed_origins' => ['https://web-service-hub.herokuapp.com'],

    'allowed_origins_patterns' => ['auth', 'github.com', 'accounts.google.com'],

    'allowed_headers' => ['X-Custom-Header', 'Upgrade-Insecure-Requests', '*'],

    'exposed_headers' => false,

    'max_age' => 0,

    'supports_credentials' => true,

];
