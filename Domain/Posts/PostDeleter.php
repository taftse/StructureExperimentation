<?php namespace Domain\Posts;

class PostDeleter
{
    private $posts;
    private $observer;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function setObserver(PostDeleterObserver $observer)
    {
        $this->observer = $observer;
    }

    public function delete(Post $post)
    {
        $post->delete();
        return $this->success($post);
    }

    private function success(Post $post)
    {
        if ($this->observer) {
            return $this->observer->onPostDeleteSuccess($post);
        }
    }
}