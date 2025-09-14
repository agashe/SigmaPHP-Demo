<?php

namespace App\Controllers;

use SigmaPHP\Core\Controllers\BaseController;
use SigmaPHP\Core\Http\Request;
use SigmaPHP\Core\Http\Response;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends BaseController
{
    /**
     * @var Comment $commentModel
     */
    private Comment $commentModel;
    
    /**
     * @var Post $postModel
     */
    private Post $postModel;
    
    /**
     * CommentController Constructor
     * 
     * @param Comment $commentModel
     * @param Post $postModel
     */
    public function __construct(Comment $commentModel, Post $postModel) {
        $this->commentModel = $commentModel;
        $this->postModel = $postModel;
    }

    /**
     * Submit Create Comment.
     * 
     * @param Request $request
     * @param int $postId
     * @return Response
     */
    public function submitCreate(Request $request, $postId)
    {
        $post = $this->postModel->find($postId);

        if (!$post) {
            return $this->render('errors.404');
        }

        $body = trim((string) $request->post('body'));

        $error = '';

        if (empty($body)) {
            $error = 'Comment can\'t be empty.';
        }
        elseif (strlen(strip_tags($body)) < 50) {
            $error = 'Comment must be at least 50 characters.';
        }

        if (!empty($error)) {
            // add flash message
            $this->session()->set('error', $error);

            // redirect back to show post
            header('Location: ' . url('blog.show', ['id' => $postId]));
            exit();
        }

        $comment = new Comment();

        $comment->body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');
        $comment->post_id = $postId;
        $comment->user_id = $this->cookie()->get('user_id');
        $comment->author_name = $this->cookie()->get('first_name') . ' ' . 
            $this->cookie()->get('last_name');
        
        $comment->save();

        // update the comments count on the post
        $post->comments_count = $post->comments_count + 1;
        $post->save();

        // add flash message
        $this->session()->set('success', 'Comment was added successfully');
 
        // redirect to show post
        header('Location: ' . url('blog.show', ['id' => $postId]));
        exit();
    }
}