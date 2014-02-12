<?php namespace Domain\Posts;

use Domain\Observers\Observer;

class PostCreator extends Observer;
{
    private $successObservers = [];
    private $failureObservers = [];
    private $validators = [];

    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function attachCreation(Callable $observer)
    {
        $this->successObservers[] = $observer;
    }

    public function attachFailure(Callable $observer)
    {
        $this->failureObservers[] = $observer;
    }

    public function addValidator($validator)
    {
        $this->validators[] = $validator;
    }

    public function create($postDataArray)
    {
        if ( ! $this->runValidators($postDataArray)) {
            return;
        }

        $this->createRecord($postDataArray);
    }

    private function runValidators($postDataArray)
    {
        foreach ($this->validators as $validator) {
            if ( ! $this->validate($validator, $postDataArray)) {
                return false;
            }
        }

        return true;
    }

    private function createRecord($postDataArray)
    {
        $post = $this->posts->create($postDataArray);

        if ( ! $post->save()) {
            $this->fireFailure($post->getErrors());
            return;
        }

        $this->fireSuccess($post);
    }

    private function validate($validator, $postDataArray)
    {
        if ( ! $validator->validate($postDataArray)) {
            $this->fireFailure($validator->errors());
        }
    }

    private function fireFailure($errors)
    {
        foreach ($this->failureObservers as $observer) {
            call_user_func_array($observer, $errors);
        }
    }

    private function fireSuccess($post)
    {
        foreach ($this->successObservers as $observer) {
            call_user_func_array($observer, $post);
        }
    }
}