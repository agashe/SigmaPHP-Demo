<?php

namespace App\Services;

/**
 * Auth Service Class
 */
class AuthService
{
    /**
     * @const array $secrets
     */
    const SECRETS = [
        'is_auth',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'session_token',
    ];
    
    /**
     * Create user session.
     * 
     * @param \App\Models\User $user
     * @param int $interval
     * @return void
     */
    public function createUserSession($user, $interval = 3600)
    {
        $values = [
            '1',
            $user->id,
            $user->email,
            $user->first_name,
            $user->last_name,
            md5(random_bytes(16)), // super secure :D
        ];
        
        foreach (array_combine(self::SECRETS, $values) as $key => $value) {
            container('cookie')->set($key, $value, time() + $interval);
        }
    }
    
    /**
     * Destroy user session.
     * 
     * @return void
     */
    public function destroyUserSession()
    {        
        foreach (self::SECRETS as $secret) {
            container('cookie')->delete($secret);
        }
    }
}