<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;
use Domain\Posts\PostForm;

class UpdatePostController extends Controller
{
    private $posts;
    private $form;

    public function __construct(PostRepository $posts, PostForm $form)
    {
        $this->posts = $posts;
        $this->form = $form;
    }

    public function getUpdate($id)
    {
        //
    }

    public function postUpdate($id)
    {
        //
    }
}