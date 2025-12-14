<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends BaseController
{
    /**
     * @var User $userModel
     */
    private User $userModel;

    /**
     * @var AuthService $authService
     */
    private AuthService $authService;
    
    /**
     * AuthController Constructor
     * 
     * @param User $userModel
     * @param AuthService $authService
     */
    public function __construct(User $userModel, AuthService $authService) {
        $this->userModel = $userModel;
        $this->authService = $authService;
    }

    /**
     * Login.
     * 
     * @return Response
     */
    public function login(Request $request)
    {
         return $this->render('pages.auth.login');
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
        $rememberMe = trim((string) $request->post('remember_me'));

        $error = '';

        if (empty($email)) {
            $error = 'Your email address is required.';
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        }
        else if (empty($password)) {
            $error = 'Your password is required.';
        }

        if (!empty($error)) {
            $this->flash('error', $error);
            $this->saveOldValues();
            
            return $this->back();
        }

        $user = $this->userModel->where('email', 'like', "%$email%")->first();

        // If a user is found, verify the password.
        if (!empty($user) && (md5($password) === $user->password)) {
            $oneDayInterval = 3600;
            $oneWeekInterval = 604800;

            $this->authService->createUserSession(
                $user,
                $rememberMe == 'on' ? $oneWeekInterval : $oneDayInterval
            );

            $this->route('home');
        }

        $this->flash('error', 'Invalid username or password.');
        $this->saveOldValues();
        
        return $this->back();
    }
    
    /**
     * Register.
     * 
     * @return Response
     */
    public function register(Request $request)
    {
        return $this->render('pages.auth.register');
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
        $confirm = trim((string) $request->post('confirm'));

        $error = '';

        if (empty($email)) {
            $error = 'Your email address is required.';
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        }
        else if (empty($firstName)) {
            $error = 'Your first name is required.';
        }
        else if (empty($lastName)) {
            $error = 'Your last name is required.';
        }
        else if (empty($password)) {
            $error = 'A password is required.';
        }
        else if (empty($confirm)) {
            $error = 'A confirm password is required.';
        }
        else if ($confirm !== $password) {
            $error = 'The password and confirm password do not match';
        }

        if (!empty($error)) {
            $this->flash('error', $error);
            $this->saveOldValues();
            
            return $this->back();
        }

        $newUser = new User();

        $newUser->email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $newUser->first_name = htmlspecialchars($firstName, 
            ENT_QUOTES, 'UTF-8');
        $newUser->last_name = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');

        // !! The worst security option :) 
        $newUser->password = md5($password);

        $newUser->save();

        // create new user session (valid for one day !)
        $this->authService->createUserSession($newUser, 3600);

        $this->route('home');
    }
}