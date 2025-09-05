<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Logout.
     * 
     * @return Response
     */
    public function logout(Request $request)
    {
        $this->cookie()->delete('is_auth');
        $this->cookie()->delete('email');
        $this->cookie()->delete('first_name');
        $this->cookie()->delete('last_name');
        
        // redirect back
        header('Location: ' . url('home'));
        exit();
    }
}