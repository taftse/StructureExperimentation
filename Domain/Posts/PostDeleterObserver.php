<?php namespace Domain\Posts;

interface PostDeleterObserver
{
    public function onPostDeleteSuccess($post);
}