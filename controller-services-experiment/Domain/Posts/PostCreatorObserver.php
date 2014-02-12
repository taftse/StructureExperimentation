<?php namespace Domain\Posts;

interface PostCreatorObserver
{
    public function onPostCreateFailure($errors);
    public function onPostCreateSuccess($model);
}