<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\Post;

class BlogController extends BaseController
{
    /**
     * @var const int PER_PAGE
     */
    private const PER_PAGE = 5;

    /**
     * @var Post $postModel
     */
    private Post $postModel;
    
    /**
     * PostsController Constructor
     * 
     * @param Post $postModel
     */
    public function __construct(Post $postModel) {
        $this->postModel = $postModel;
    }

    /**
     * Homepage.
     * 
     * @param Request $request
     * @param int $page
     * @return Response
     */
    public function index(Request $request, $page = 1)
    {
        $posts = array_slice(
            $this->postModel->all(),
            ($page - 1) * (int) self::PER_PAGE, 
            (int) self::PER_PAGE
        );
        
        $pagesCount = ceil($this->postModel->count() / (int) self::PER_PAGE);
    
        return $this->render(
            'pages.blog.index', 
            compact('posts', 'page', 'pagesCount')
        );
    }

    /**
     * Search.
     * 
     * @param Request $request
     * @param string $keyword
     * @param int $page
     * @return Response
     */
    public function search(Request $request, $keyword, $page = 1)
    {
        $keyword = trim($keyword);

        // prevent XSS
        $keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');

        $result = $this->postModel->where('title', 'like', "%$keyword%")->all();

        $posts = array_slice(
            $result,
            ($page - 1) * (int) self::PER_PAGE, 
            (int) self::PER_PAGE
        );
        
        $pagesCount = ceil(count($result) / (int) self::PER_PAGE);
    
        return $this->render(
            'pages.blog.index', 
            compact('posts', 'page', 'pagesCount', 'keyword')
        );
    }

    /**
     * Show a single post.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $post = $this->postModel->find($id);

        if (!$post) {
            return $this->render('errors.404');
        }

        return $this->render('pages.blog.show', ['post' => $post]);
    }
}