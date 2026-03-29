<?php

namespace App\Middlewares;

use SigmaPHP\Core\Router\BaseMiddleware;

/**
 * Auth Middleware Class
 */
class AuthMiddleware extends BaseMiddleware
{
    /**
     * Handle the incoming request.
     * 
     * @return void
     */
    public function handle()
    {
        if (!$this->cookie()->has('is_auth')) {
            return $this->route('home');
        }
    }
}