<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\User;
use App\Services\AuthService;

class UserController extends BaseController
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
     * UserController Constructor
     * 
     * @param User $userModel
     * @param AuthService $authService
     */
    public function __construct(User $userModel, AuthService $authService) {
        $this->userModel = $userModel;
        $this->authService = $authService;
    }

    /**
     * Show Profile.
     * 
     * @return Response
     */
    public function show(Request $request)
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
        
        $user = $this->userModel->find($this->cookie()->get('user_id'));

        return $this->render(
            'pages.profile', 
            compact('type', 'message', 'user')
        );
    }

    /**
     * Update Profile.
     * 
     * @return Response
     */
    public function update(Request $request)
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
            $error = 'The password and confirm password are not matching.';
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

        // !! The worst security option :) 
        $newUser->password = md5($password);

        $newUser->save();

        // create new user session (valid for one day !)
        $this->authService->createUserSession($newUser, 3600);

        // redirect back
        header('Location: ' . url('home'));
        exit();
    }

    /**
     * Logout.
     * 
     * @return Response
     */
    public function logout(Request $request)
    {
        $this->authService->destroyUserSession();

        // redirect back
        header('Location: ' . url('home'));
        exit();
    }
}