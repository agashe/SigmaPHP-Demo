<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\User;

class AuthController extends BaseController
{
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
        $name = trim((string) $request->post('name'));
        $email = trim((string) $request->post('email'));
        $body = trim((string) $request->post('body'));

        $error = '';

        if (empty($name)) {
            $error = 'Your name is required.';
        }
        else if (empty($email)) {
            $error = 'Your email address is required.';
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        }
        else if (empty($body)) {
            $error = 'Your message is required.';
        }

        if (!empty($error)) {
            // add flash message
            $this->session()->set('error', $error);
            
            // redirect back
            header('Location: ' . url('contact'));
            exit();
        }

        $newMessage = new User();

        $newMessage->name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $newMessage->email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $newMessage->body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');

        $newMessage->save();

        // add flash message
        $this->session()->set('success', 'Your message were sent successfully');
        
        // redirect back
        header('Location: ' . url('contact'));
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
        // Extract data from the request, excluding username.
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
            header('Location: ' . url('register'));
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
        $this->cookie()->set('email', $email);
        $this->cookie()->set('first_name', $firstName);
        $this->cookie()->set('last_name', $lastName);
        
        // redirect back
        header('Location: ' . url('home'));
        exit();
    }
}