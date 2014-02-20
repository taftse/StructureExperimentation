<?php namespace Domain\Posts;

interface PostUpdaterResponder
{
    public function onPostUpdateFailure($errors);
    public function onPostUpdateSuccess($post);
}