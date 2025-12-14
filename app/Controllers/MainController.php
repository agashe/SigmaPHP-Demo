<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\Post;
use App\Models\Message;

class MainController extends BaseController
{
    /**
     * Homepage.
     * 
     * @return Response
     */
    public function index(Request $request)
    {
        $postModel = new Post();
        $posts = array_slice($postModel->all(), 0, 6);
        
        return $this->render('pages.home', compact('posts'));
    }

    /**
     * About.
     * 
     * @return Response
     */
    public function about(Request $request)
    {
        return $this->render('pages.about');
    }
    
    /**
     * Contact Us.
     * 
     * @return Response
     */
    public function contact(Request $request)
    {
        return $this->render('pages.contact');
    }

    /**
     * Submit Contact Us.
     * 
     * @return Response
     */
    public function submitContact(Request $request)
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
            $this->flash('error', $error);
            $this->saveOldValues();
            
            return $this->back();
        }

        $newMessage = new Message();

        $newMessage->name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $newMessage->email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $newMessage->body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');

        $newMessage->save();

        $this->flash('success', 'Your message were sent successfully');
        return $this->route('contact');
    }
}