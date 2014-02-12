<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;

class IndexPostController extends Controller
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function getIndex()
    {
        $posts = $this->posts->getAll();
        $this->view('posts.index', compact('posts'));
    }
}