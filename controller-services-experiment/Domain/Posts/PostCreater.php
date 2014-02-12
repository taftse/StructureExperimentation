<?php namespace Domain\Posts;

class PostCreator;
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function create(PostCreatorObserver $observer, $postDataArray)
    {
        $post = $this->posts->create($postDataArray);

        if ( ! $this->posts->save($post) {
            return $observer->onPostCreationFailure($post->getErrors());
        }

        return $observer->onPostCreationSuccess($post);
    }
}