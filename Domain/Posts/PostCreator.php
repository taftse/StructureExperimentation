<?php namespace Domain\Posts;

class PostCreator
{
    private $posts;
    private $observer;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function setObserver(PostCreatorObserver $observer)
    {
        $this->observer = $observer;
    }

    public function create(array $data)
    {
        $post = $this->posts->create($data);
        if ( ! $this->posts->save($post)) {
            return $this->failure($post->getErrors());
        }
        return $this->success($post);
    }

    private function failure($errors)
    {
        if ($this->observer) {
            return $this->observer->onPostCreateFailure($errors);
        }
    }

    private function success(Post $post)
    {
        if ($this->observer) {
            return $this->observer->onPostCreateSuccess($post);
        }
    }
}
