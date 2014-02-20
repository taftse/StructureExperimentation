<?php namespace Domain\Posts;

class PostUpdater;
{
    private $posts;
    private $responder;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function respondsWith(PostUpdaterResponder $responder)
    {
        $this->responder = $responder;
        return $this;
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
        if ($this->responder) {
            return $this->responder->onPostUpdateFailure($errors);
        }
    }

    private function success(Post $post)
    {
        if ($this->responder) {
            return $this->responder->onPostUpdateSuccess($post);
        }
    }
}