<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;
use Domain\Posts\PostDeleter;
use Domain\Posts\PostDeleterObserver;
use Domain\Posts\Post;
use ...\...\Redirector;

class DeletePostController extends Controller implements PostDeleterObserver
{
    private $posts;
    private $deleter;
    private $redirector;

    public function __construct(PostRepository $posts, PostDeleter $deleter, Redirector $redirector)
    {
        $this->posts = $posts;
        $this->redirector = $redirector;

        $deleter->setObserver($this);
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
        return $this->deleter->delete($post);
    }

    public function onPostDeleteSuccess(Post $post)
    {
        return $this->redirector->route('posts.index')->with('success', 'You have successfully deleted the post.');
    }
}