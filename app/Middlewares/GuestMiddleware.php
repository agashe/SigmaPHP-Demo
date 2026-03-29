<?php

namespace App\Middlewares;

use SigmaPHP\Core\Router\BaseMiddleware;

/**
 * Guest Middleware Class
 */
class GuestMiddleware extends BaseMiddleware
{
    /**
     * Handle the incoming request.
     * 
     * @return void
     */
    public function handle()
    {
        if ($this->cookie()->has('is_auth')) {
            return $this->route('home');
        }
    }
}