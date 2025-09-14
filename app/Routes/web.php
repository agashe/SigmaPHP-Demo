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
        'routes' => [
            [
                'name' => 'index',
                'path' => '/{page?}',
                'method' => 'get',
                'controller' => BlogController::class,
                'action' => 'index'
            ],
            [
                'name' => 'search',
                'path' => 'search/{keyword}/{page?}',
                'method' => 'get',
                'controller' => BlogController::class,
                'action' => 'search'
            ],
            [
                'name' => 'show',
                'path' => '/s/{id}',
                'method' => 'get',
                'controller' => BlogController::class,
                'action' => 'show'
            ],
        ]
    ],
    [
        'group' => 'auth',
        'prefix' => '/auth',
        'middlewares' => [
            [GuestMiddleware::class, 'handle']
        ],
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
    [
        'group' => 'user',
        'prefix' => '/user',
        'middlewares' => [
            [AuthMiddleware::class, 'handle']
        ],
        'routes' => [
            [
                'name' => 'profile',
                'path' => '/profile',
                'method' => 'get',
                'controller' => UserController::class,
                'action' => 'show',
            ],
            [
                'name' => 'profile.update',
                'path' => '/profile',
                'method' => 'post',
                'controller' => UserController::class,
                'action' => 'update',
            ],
            [
                'name' => 'logout',
                'path' => '/logout',
                'method' => 'get',
                'controller' => UserController::class,
                'action' => 'logout',
            ],
        ]
    ],
    [
        'group' => 'posts',
        'prefix' => '/posts',
        'middlewares' => [
            [AuthMiddleware::class, 'handle']
        ],
        'routes' => [
            [
                'name' => 'index',
                'path' => '/{page?}',
                'method' => 'get',
                'controller' => PostController::class,
                'action' => 'index',
                'validation' => [
                    'page' => '[0-9]+'
                ]
            ],
            [
                'name' => 'create',
                'path' => '/create',
                'method' => 'get',
                'controller' => PostController::class,
                'action' => 'create'
            ],
            [
                'name' => 'create.submit',
                'path' => '/create',
                'method' => 'post',
                'controller' => PostController::class,
                'action' => 'submitCreate'
            ],
            [
                'name' => 'update',
                'path' => '/{id}/edit',
                'method' => 'get',
                'controller' => PostController::class,
                'action' => 'update'
            ],
            [
                'name' => 'update.submit',
                'path' => '/{id}/edit',
                'method' => 'post',
                'controller' => PostController::class,
                'action' => 'submitUpdate'
            ],
            [
                'name' => 'delete',
                'path' => '/{id}/delete',
                'method' => 'post',
                'controller' => PostController::class,
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
