<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;

class ShowPostController extends Controller
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function getShow($id)
    {
        //
    }
}