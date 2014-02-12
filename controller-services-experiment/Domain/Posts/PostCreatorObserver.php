<?php namespace Domain\Posts;

interface PostCreatorObserver
{
    public function onPostCreationFailure($errors);
    public function onPostCreationSuccess($model);
}