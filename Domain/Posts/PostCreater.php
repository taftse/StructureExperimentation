<?php namespace Domain\Posts;

use Domain\Core\CreationObserver;

class PostCreator;
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function create(CreationObserver $observer, $postDataArray)
    {
        $post = $this->posts->create($postDataArray);

        if ( ! $this->posts->save($post) {
            return $observer->onFailure($post->getErrors());
        }

        return $observer->onSuccess($post);
    }
}