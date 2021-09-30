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

    'allowed_methods' => ['*'],

    'allowed_origins' => ['https://web-service-hub.herokuapp.com'],

    'allowed_origins_patterns' => ['https://accounts.google.com/o/oauth2/auth?client_id=828325844965-t7lk863sqvq48e30ilqammosksdg1jdt.apps.googleusercontent.com&scope=openid+profile+email&response_type=code&state=lGLweutG4McqiHwWdthrijlkxKH1gfIez6BDwzzK','https://github.com/login/oauth/authorize?client_id=8bec41070201a7c21172&redirect_uri=https%3A%2F%2Fweb-service-hub.herokuapp.com%2Fauth%2Fgithub%2Fcallback&scope=user%3Aemail&response_type=code&state=8nUOqzwsyYzFoR0wEfzfTGhKGOJzoqmlh9WWkk2Z'],

    'allowed_headers' => ['Access-Control-Allow-Origin'],

    'exposed_headers' => false,

    'max_age' => 0,

    'supports_credentials' => true,

];
