<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;
use Domain\Posts\PostDeleter;
use Domani\Posts\PostDeleterObserver;

class DeletePostController extends Controller implements PostDeleterObserver
{
    private $posts;
    private $deleter;

    public function __construct(PostRepository $posts, PostDeleter $deleter)
    {
        $this->posts = $posts;
        $this->deleter = $deleter;
    }

    public function getDelete($id)
    {
        $post = $this->posts->requireById($id);
        $this->view('posts.delete');
    }

    public function postDelete($id)
    {
        $post = $this->posts->requireById($id);
        return $this->deleter->delete($this, $post);
    }

    public function onPostDeletionSuccess($post)
    {
        return $this->redirector->route('posts.index')->with('success', 'You have successfully deleted the post.');
    }
}