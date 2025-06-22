<?php

use App\Controllers\MainController;

return [
    [
        'name' => 'welcome',
        'path' => '/',
        'method' => 'get',
        'controller' => MainController::class,
        'action' => 'index',
    ]
];
