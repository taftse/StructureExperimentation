<?php namespace Domain\Posts;

class PostDeleter
{
    private $posts;
    private $responder;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function responseWith(PostDeleterResponder $responder)
    {
        $this->responder = $responder;
        return $this;
    }

    public function delete(Post $post)
    {
        $post->delete();
        return $this->success($post);
    }

    private function success(Post $post)
    {
        if ($this->responder) {
            return $this->responder->onPostDeleteSuccess($post);
        }
    }
}