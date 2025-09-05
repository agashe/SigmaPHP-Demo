<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\User;

class AuthController extends BaseController
{
    /**
     * @var User $userModel
     */
    private User $userModel;
    
    /**
     * AuthController Constructor
     * 
     * @param User $userModel
     */
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    /**
     * Login.
     * 
     * @return Response
     */
    public function login(Request $request)
    {
        $type = '';
        $message = '';

        if ($this->session()->get('success')) {
            $type = 'success';
            $message = $this->session()->get('success');
            $this->session()->delete('success');
        }
        else if ($this->session()->get('error')) {
            $type = 'danger';
            $message = $this->session()->get('error');
            $this->session()->delete('error');
        }
        
        return $this->render('pages.auth.login', compact('type', 'message'));
    }

    /**
     * Submit Login.
     * 
     * @return Response
     */
    public function submitLogin(Request $request)
    {
        $email = trim((string) $request->post('email'));
        $password = trim((string) $request->post('password'));

        $error = '';

        if (empty($email)) {
            $error = 'Your email address is required.';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else if (empty($password)) {
            $error = 'Your password is required.';
        }

        if (!empty($error)) {
            $this->session()->set('error', $error);
            header('Location: ' . url('auth.login'));
            exit();
        }

        $user = $this->userModel->where('email', 'like', "%$email%")->first();

        // If a user is found, verify the password.
        if (!empty($user) && (md5($password) === $user->password)) {
            $this->cookie()->set('is_auth', 1, time() + 3600);
            $this->cookie()->set('email', $email, time() + 3600);
            $this->cookie()->set('first_name', $user->first_name, time() + 3600);
            $this->cookie()->set('last_name', $user->last_name, time() + 3600);

            header('Location: ' . url('home'));
            exit();
        }

        // Invalid credentials.
        $this->session()->set('error', 'Invalid username or password.');
        header('Location: ' . url('auth.login'));
        exit();
    }
    
    /**
     * Register.
     * 
     * @return Response
     */
    public function register(Request $request)
    {
        $type = '';
        $message = '';

        if ($this->session()->get('success')) {
            $type = 'success';
            $message = $this->session()->get('success');
            $this->session()->delete('success');
        }
        else if ($this->session()->get('error')) {
            $type = 'danger';
            $message = $this->session()->get('error');
            $this->session()->delete('error');
        }
        
        return $this->render('pages.auth.register', compact('type', 'message'));
    }

    /**
     * Submit Register.
     * 
     * @return Response
     */
    public function submitRegister(Request $request)
    {
        $email = trim((string) $request->post('email'));
        $firstName = trim((string) $request->post('first_name'));
        $lastName = trim((string) $request->post('last_name'));
        $password = trim((string) $request->post('password'));

        $error = '';

        if (empty($email)) {
            $error = 'Your email address is required.';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else if (empty($firstName)) {
            $error = 'Your first name is required.';
        } else if (empty($lastName)) {
            $error = 'Your last name is required.';
        } else if (empty($password)) {
            $error = 'A password is required.';
        }

        if (!empty($error)) {
            // add flash message
            $this->session()->set('error', $error);
            
            // redirect back
            header('Location: ' . url('auth.register'));
            exit();
        }

        $newUser = new User();

        $newUser->email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $newUser->first_name = htmlspecialchars($firstName, 
            ENT_QUOTES, 'UTF-8');
        $newUser->last_name = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');

        $newUser->password = md5($password);

        $newUser->save();

        // add create new cookie with an associative array
        $this->cookie()->set('is_auth', 1, time() + 3600);
        $this->cookie()->set('email', $email, time() + 3600);
        $this->cookie()->set('first_name', $firstName, time() + 3600);
        $this->cookie()->set('last_name', $lastName, time() + 3600);
        
        // redirect back
        header('Location: ' . url('home'));
        exit();
    }
}