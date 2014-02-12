<?php namespace Domain\Posts;

interface PostUpdaterObserver
{
    public function onPostUpdateFailure($errors);
    public function onPostUpdateSuccess($model);
}