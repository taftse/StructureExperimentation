<?php namespace Domain\Posts;

class PostUpdater;
{
    private $posts;
    private $observer;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function setObserver(PostUpdaterObserver $observer)
    {
        $this->observer = $observer;
    }

    public function update(Post $post, array $data)
    {
        $post->fill($data);
        if ( ! $this->posts->save($post)) {
            return $this->failure($post->getErrors());
        }
        return $this->success($post);
    }

    private function failure($errors)
    {
        if ($this->observer) {
            return $this->observer->onPostUpdateFailure($errors);
        }
    }

    private function success(Post $post)
    {
        if ($this->observer) {
            return $this->observer->onPostUpdateSuccess($post);
        }
    }
}