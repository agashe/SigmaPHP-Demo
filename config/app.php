<?php

// this file contains all base config for the SigmaPHP framework
// these options default values are imported from the .env file.

return [
    /**
     * Application name.
     */
    'name' => env('APP_NAME', 'SigmaPHP - WebApp'),

    /**
     * Application url. (can be used in routes or http calls)
     */
    'url' => env('APP_URL', ''),

    /**
     * Application environment (production , dev ...etc).
     */
    'env' => env('APP_ENV', 'develop'),

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
];