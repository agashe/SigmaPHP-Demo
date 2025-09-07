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
        $firstName = trim((string) $request->post('first_name'));
        $lastName = trim((string) $request->post('last_name'));
        $oldPassword = (string) $request->post('old_password');
        $newPassword = (string) $request->post('new_password');
        $confirm = (string) $request->post('confirm');

        $user = $this->userModel->find($this->cookie()->get('user_id'));

        $error = '';

        if (empty($firstName)) {
            $errors[] = 'Your first name is required';
        }
        else if (empty($lastName)) {
            $errors[] = 'Your last name is required';
        }

        // handle password update
        if (!empty($newPassword) || !empty($oldPassword) || !empty($confirm)) {
            if (empty($oldPassword)) {
                $error = 'Old password is required to change your password';
            }
            else if (empty($newPassword) || empty($confirm)) {
                $error = 'New password and confirm password ' . 
                    'are required to change your password';
            }
            else if ($newPassword !== $confirm) {
                $error = 'New password and confirm password do not match';
            }
            else if (md5($oldPassword) !== $user->password) {
                $error = 'The old password you entered is incorrect';
            }
        }

        if (!empty($error)) {
            // add flash message
            $this->session()->set('error', $error);
            
            // redirect back
            header('Location: ' . url('user.profile'));
            exit();
        }

        $user->first_name = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');
        $user->last_name = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');

        if (!empty($newPassword)) {
            $user->password = md5($newPassword);
        }

        $user->save();

        // if the password was changed , destroy the current session
        // otherwise just update the current session
        $this->authService->destroyUserSession();

        if (!empty($newPassword)) {
            // redirect to login
            header('Location: ' . url('auth.login'));
            exit();
        }
        
        // create new session , with the updated data
        $this->authService->createUserSession($user);

        // set a success flash message
        $this->session()->set(
            'success', 'Your profile has been updated successfully!');

        // redirect back
        header('Location: ' . url('user.profile'));
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