<?php namespace Domain\Posts;

interface PostDeleterObserver
{
    public function onPostDeletionSuccess($post);
}