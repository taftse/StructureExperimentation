<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;
use Domain\Posts\PostForm;

class CreatePostController extends Controller
{
    private $posts;
    private $form;

    public function __construct(PostRepository $posts, PostForm $form)
    {
        $this->posts = $posts;
        $this->form = $form;
    }

    public function getCreate($id)
    {
        //
    }

    public function postCreate($id)
    {
        //
    }
}