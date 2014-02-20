<?php namespace Domain\Posts;

class PostCreator
{
    private $posts;
    private $responder;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function responseWith(PostCreatorResponder $responder)
    {
        $this->responder = $responder;
        return $this;
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
        if ($this->responder) {
            return $this->responder->onPostCreateFailure($errors);
        }
    }

    private function success(Post $post)
    {
        if ($this->responder) {
            return $this->responder->onPostCreateSuccess($post);
        }
    }
}
