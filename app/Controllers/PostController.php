<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\Post;

class PostController extends BaseController
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
        $result = $this->postModel->where('user_id', '=', 
            $this->cookie()->get('user_id'))->all();

        $posts = array_slice(
            $result,
            ($page - 1) * (int) self::PER_PAGE, 
            (int) self::PER_PAGE
        );
        
        $pagesCount = ceil(count($result) / (int) self::PER_PAGE);
        $url = 'posts.index';

        return $this->render(
            'pages.posts.index', 
            compact('posts', 'page', 'pagesCount', 'url')
        );
    }

    /**
     * Create a new post.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $action = 'Create';
        $type = '';
        $message = '';
        $title = '';
        $summary = '';
        $body = '';

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

        return $this->render('pages.posts.form', compact(
            'action',
            'type',
            'message',
            'title',
            'summary',
            'body'
        ));
    }

    /**
     * Submit Create Post.
     * 
     * @return Response
     */
    public function submitCreate(Request $request)
    {
        $title   = trim((string) $request->post('title'));
        $summary = trim((string) $request->post('summary'));
        $body    = trim((string) $request->post('body'));

        $error = '';

        if (empty($title)) {
            $error = 'Title is required.';
        }
        elseif (empty($summary)) {
            $error = 'Summary is required.';
        }
        elseif (empty($body)) {
            $error = 'Body is required.';
        }

        if (!empty($error)) {
            // add flash message
            $this->session()->set('error', $error);

            // redirect back to the create page
            header('Location: ' . url('posts.create'));
            exit();
        }

        $post = new Post();

        $post->title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $post->summary = htmlspecialchars($summary, ENT_QUOTES, 'UTF-8');
        $post->body = $body;
        $post->user_id = $this->cookie()->get('user_id');
        $post->comments_count = 1;
        $post->author_name = $this->cookie()->get('first_name') . ' ' . 
            $this->cookie()->get('last_name');
        
        $post->save();

        // redirect to posts index
        header('Location: ' . url('posts.index'));
        exit();
    }

    /**
     * Update a post.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = $this->postModel->find($id);

        if (!$post) {
            return $this->render('errors.404');
        }

        $id = $post->id;
        $action = 'Edit';
        $type = '';
        $message = '';
        $title = $post->title;
        $summary = $post->summary;
        $body = $post->body;

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

        return $this->render('pages.posts.form', compact(
            'id',
            'action',
            'type',
            'message',
            'title',
            'summary',
            'body'
        ));
    }

    /**
     * Submit Update Post.
     * 
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function submitUpdate(Request $request, $id)
    {
        $title   = trim((string) $request->post('title'));
        $summary = trim((string) $request->post('summary'));
        $body    = trim((string) $request->post('body'));

        $error = '';

        if (empty($title)) {
            $error = 'Title is required.';
        }
        elseif (empty($summary)) {
            $error = 'Summary is required.';
        }
        elseif (empty($body)) {
            $error = 'Body is required.';
        }

        if (!empty($error)) {
            // add flash message
            $this->session()->set('error', $error);

            // redirect back to the create page
            header('Location: ' . url('posts.create'));
            exit();
        }

        $post = $this->postModel->find($id);

        $post->title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $post->summary = htmlspecialchars($summary, ENT_QUOTES, 'UTF-8');
        $post->body = $body;
        
        $post->save();

        // redirect to posts index
        header('Location: ' . url('posts.index'));
        exit();
    }

    /**
     * Delete a post.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $post = $this->postModel->find($id);

        if (!$post) {
            return $this->render('errors.404');
        }

        $post->delete();

        // redirect to posts index
        header('Location: ' . url('posts.index'));
        exit();
    }
}