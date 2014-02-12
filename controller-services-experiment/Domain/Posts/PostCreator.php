<?php namespace Domain\Posts;

class PostCreator;
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function create(PostCreatorObserver $observer, array $data)
    {
        $post = $this->posts->create($data);

        if ( ! $this->posts->save($post) {
            return $observer->onPostCreateFailure($post->getErrors());
        }

        return $observer->onPostCreateSuccess($post);
    }
}