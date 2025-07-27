<?php

use App\Controllers\MainController;
use App\Controllers\PostsController;

return [
    [
        'name' => 'home',
        'path' => '/',
        'method' => 'get',
        'controller' => MainController::class,
        'action' => 'index',
    ],
    [
        'group' => 'posts',
        'prefix' => '/blog',
        'routes' => [
            [
                'name' => 'index',
                'path' => '/',
                'method' => 'get',
                'controller' => PostsController::class,
                'action' => 'index'
            ],
            [
                'name' => 'show',
                'path' => '/{id}',
                'method' => 'get',
                'controller' => PostsController::class,
                'action' => 'show'
            ],
        ]
    ],
];
