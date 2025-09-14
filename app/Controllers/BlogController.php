<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\Post;
use App\Models\Comment;

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
     * @var Comment $commentModel
     */
    private Comment $commentModel;
    
    /**
     * BlogController Constructor
     * 
     * @param Post $postModel
     * @param Comment $commentModel
     */
    public function __construct(Post $postModel, Comment $commentModel) {
        $this->postModel = $postModel;
        $this->commentModel = $commentModel;
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
        $url = 'blog.index';

        return $this->render(
            'pages.blog.index', 
            compact('posts', 'page', 'pagesCount', 'url')
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
        $url = 'blog.index';

        return $this->render(
            'pages.blog.index', 
            compact('posts', 'page', 'pagesCount', 'keyword', 'url')
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

        if (!$post->id) {
            return $this->render('errors.404');
        }

        $comments = $this->commentModel
            ->where('post_id', '=', $post->id)
            ->all();

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

        return $this->render(
            'pages.blog.show', 
            compact('post', 'comments', 'type', 'message')
        );
    }
}