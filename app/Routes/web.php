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
        'name' => 'about',
        'path' => '/about',
        'method' => 'get',
        'controller' => MainController::class,
        'action' => 'about',
    ],
    [
        'name' => 'contact',
        'path' => '/contact',
        'method' => 'get',
        'controller' => MainController::class,
        'action' => 'contact',
    ],
    [
        'name' => 'contact.submit',
        'path' => '/contact',
        'method' => 'post',
        'controller' => MainController::class,
        'action' => 'submitContact',
    ],
    [
        'group' => 'posts',
        'prefix' => '/blog',
        'routes' => [
            [
                'name' => 'index',
                'path' => '/{page?}',
                'method' => 'get',
                'controller' => PostsController::class,
                'action' => 'index'
            ],
            [
                'name' => 'show',
                'path' => '/s/{id}',
                'method' => 'get',
                'controller' => PostsController::class,
                'action' => 'show'
            ],
        ]
    ],
];
