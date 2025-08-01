<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\Post;

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
        $posts = $postModel->all();
        
        return $this->render('pages.home', compact('posts'));
    }
}