<?php namespace Domain\Posts;

interface PostCreatorResponder
{
    public function onPostCreateFailure($errors);
    public function onPostCreateSuccess($post);
}