<?php

namespace App\Middlewares;

/**
 * Auth Middleware Class
 */
class AuthMiddleware
{
    /**
     * Handle the incoming request.
     * 
     * @return void
     */
    public function handle()
    {
        if (!isset($_COOKIE['is_auth']) && $_COOKIE['is_auth'] != '1') {
            header('Location: ' . url('home'));
            exit();
        }
    }
}