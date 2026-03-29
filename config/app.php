<?php

// this file contains all base config for the SigmaPHP framework
// these options default values are imported from the .env file.

return [
    /**
     * Application name.
     */
    'name' => env('APP_NAME', 'SigmaPHP - Demo'),

    /**
     * Application url. (can be used in routes or http calls)
     */
    'url' => env('APP_URL', ''),

    /**
     * Application environment (production , dev ...etc).
     */
    'env' => env('APP_ENV', 'develop'),

    /**
     * Application port.
     */
    'port' => env('APP_PORT', 8888),

    /**
     * Application timezone.
     */
    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /**
     * Controller files path.
     */
    'controllers_path' => env('CONTROLLERS_PATH', 'app/Controllers'),

    /**
     * Routes files path.
     */
    'routes_path' => env('ROUTES_PATH', 'app/Routes'),

    /**
     * Views files path.
     */
    'views_path' => env('VIEWS_PATH', 'app/Views'),

    /**
     * Cache files path.
     */
    'cache_path' => env('CACHE_PATH', 'storage/cache'),

    /**
     * Uploaded files path.
     */
    'upload_path' => env('UPLOADS_PATH', 'storage/uploads'),

    /**
     * HTTP method override.
     */
    'allow_http_method_override' => true,

    /**
     * Static assets route's path.
     */
    'static_assets_route' => env('STATIC_ASSETS_ROUTE', 'static/'),

    /**
     * App base path.
     *
     * Do not confuse this option with APP_URL. The APP_URL value defines the
     * full application URL (e.g., https://example.com), whereas this option
     * specifies the base path when the application is served from a
     * sub-directory, such as:
     *     http://localhost/apps/calculator/public
     *
     * In this example, the application’s base path is:
     *     /apps/calculator/public
     *
     * Provide this value in the options below only when your application is
     * running from a sub-directory. Otherwise, you can ignore this option !
     */
    'base_path' => env('BASE_PATH', ''),
];
