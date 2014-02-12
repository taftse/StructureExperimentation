<?php namespace Domain\Core;

interface CreationObserver
{
    public function onFailure($errors);
    public function onSuccess($model);
}