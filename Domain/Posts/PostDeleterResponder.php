<?php namespace Domain\Posts;

interface PostDeleterResponder
{
    public function onPostDeleteSuccess($post);
}