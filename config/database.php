<?php

// this file contains database config for the SigmaPHP framework
// these options default values are imported from the .env file.

return [
    /**
     * Default path for migration files.
     */
    'path_to_migrations' => env('PATH_TO_MIGRATIONS', '/database/migrations'),

    /**
     * Default path for seeders.
     */
    'path_to_seeders' => env('PATH_TO_SEEDERS', '/database/seeders'),

    /**
     * Default path for migrations files.
     */
    'path_to_models' => env('PATH_TO_MODELS', '/app/Models'),
    
    /**
     * Default name for migrations history table.
     */
    'logs_table_name' => env('LOGS_TABLE_NAME', 'db_logs'),

    /**
     * Database Credentials :
     */
    'database_connection' => [
        /**
         * Host URL
         */
        'host' => env('DATABASE_HOST', 'localhost'),

        /**
         * Username
         */
        'user' => env('DATABASE_USER', 'root'),

        /**
         * Password
         */
        'pass' => env('DATABASE_PASS', 'root'),

        /**
         * Database name
         */
        'name' => env('DATABASE_NAME', 'test'),

        /**
         * Database port
         */
        'port' => env('DATABASE_PORT', '3306')
    ]
];