<?php namespace Domain\Posts;

class PostUpdater;
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function update(PostUpdaterObserver $observer, Post $post, array $data)
    {
        $post->fill($data);
        if ( ! $this->posts->save($post) {
            return $observer->onPostUpdateFailure($post->getErrors());
        }

        return $observer->onPostUpdateSuccess($post);
    }
}