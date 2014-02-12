<?php namespace Domain\Posts;

class PostDeleter
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function delete(PostDeleterObserver $observer, Post $post)
    {
        $post->delete();
        $observer->onPostDeletionSuccess($post);
    }
}