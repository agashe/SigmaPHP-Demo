<?php

use App\Controllers\MainController;
use App\Controllers\PostsController;
use App\Controllers\AuthController;

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
                'name' => 'search',
                'path' => 'search/{keyword}/{page?}',
                'method' => 'get',
                'controller' => PostsController::class,
                'action' => 'search'
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
    [
        'group' => 'auth',
        'prefix' => '/auth',
        'routes' => [
            [
                'name' => 'login',
                'path' => '/login',
                'method' => 'get',
                'controller' => AuthController::class,
                'action' => 'login',
            ],
            [
                'name' => 'login.submit',
                'path' => '/login',
                'method' => 'post',
                'controller' => AuthController::class,
                'action' => 'submitLogin',
            ],
            [
                'name' => 'register',
                'path' => '/register',
                'method' => 'get',
                'controller' => AuthController::class,
                'action' => 'register',
            ],
            [
                'name' => 'register.submit',
                'path' => '/register',
                'method' => 'post',
                'controller' => AuthController::class,
                'action' => 'submitRegister',
            ],
        ]
    ],
];
