<?php

use App\Controllers\MainController;
use App\Controllers\PostController;
use App\Controllers\BlogController;
use App\Controllers\AuthController;
use App\Controllers\CommentController;
use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

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
        'group' => 'blog',
        'prefix' => '/blog',
        'controller' => BlogController::class,
        'routes' => [
            [
                'name' => 'index',
                'path' => '/{page?}',
                'method' => 'get',
                'action' => 'index'
            ],
            [
                'name' => 'search',
                'path' => 'search/{keyword}/{page?}',
                'method' => 'get',
                'action' => 'search'
            ],
            [
                'name' => 'show',
                'path' => '/s/{id}',
                'method' => 'get',
                'action' => 'show'
            ],
        ]
    ],
    [
        'group' => 'auth',
        'prefix' => '/auth',
        'controller' => AuthController::class,
        'middlewares' => [
            [GuestMiddleware::class, 'handle']
        ],
        'routes' => [
            [
                'name' => 'login',
                'path' => '/login',
                'method' => 'get',
                'action' => 'login',
            ],
            [
                'name' => 'login.submit',
                'path' => '/login',
                'method' => 'post',
                'action' => 'submitLogin',
            ],
            [
                'name' => 'register',
                'path' => '/register',
                'method' => 'get',
                'action' => 'register',
            ],
            [
                'name' => 'register.submit',
                'path' => '/register',
                'method' => 'post',
                'action' => 'submitRegister',
            ],
        ]
    ],
    [
        'group' => 'user',
        'prefix' => '/user',
        'controller' => UserController::class,
        'middlewares' => [
            [AuthMiddleware::class, 'handle']
        ],
        'routes' => [
            [
                'name' => 'profile',
                'path' => '/profile',
                'method' => 'get',
                'action' => 'show',
            ],
            [
                'name' => 'profile.update',
                'path' => '/profile',
                'method' => 'post',
                'action' => 'update',
            ],
            [
                'name' => 'logout',
                'path' => '/logout',
                'method' => 'get',
                'action' => 'logout',
            ],
        ]
    ],
    [
        'group' => 'posts',
        'prefix' => '/posts',
        'controller' => PostController::class,
        'middlewares' => [
            [AuthMiddleware::class, 'handle']
        ],
        'routes' => [
            [
                'name' => 'index',
                'path' => '/{page?}',
                'method' => 'get',
                'action' => 'index',
                'validation' => [
                    'page' => '[0-9]+'
                ]
            ],
            [
                'name' => 'create',
                'path' => '/create',
                'method' => 'get',
                'action' => 'create'
            ],
            [
                'name' => 'create.submit',
                'path' => '/create',
                'method' => 'post',
                'action' => 'submitCreate'
            ],
            [
                'name' => 'update',
                'path' => '/{id}/edit',
                'method' => 'get',
                'action' => 'update'
            ],
            [
                'name' => 'update.submit',
                'path' => '/{id}/edit',
                'method' => 'post',
                'action' => 'submitUpdate'
            ],
            [
                'name' => 'delete',
                'path' => '/{id}/delete',
                'method' => 'post',
                'action' => 'delete'
            ],
            [
                'name' => 'comment',
                'path' => '/{postId}/comment',
                'method' => 'post',
                'controller' => CommentController::class,
                'action' => 'submitCreate'
            ],
        ]
    ],
];
