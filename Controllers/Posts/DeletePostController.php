<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;

class DeletePostController extends Controller
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function getDelete($id)
    {
        //
    }

    public function postDelete($id)
    {
        //
    }
}