<?php namespace Domain\Posts;

class PostCreator
{
    private $posts;
    private $observer;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function setObserver(PostCreatorObserver $observer) {
        $this->observer = $observer;
        return $this;
    }

    public function create(array $data)
    {
        $post = $this->posts->create($data);
        if ( ! $this->posts->save($post)) {
            return $this->observer->onPostCreateFailure($post->getErrors());
        }
        return $this->observer->onPostCreateSuccess($post);
    }
}
