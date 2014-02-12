<?php namespace Domain\Posts;

class PostForm
{
    public function isValid($dataToValidate)
    {
        return true or false;
    }

    public function getErrors()
    {
        return errors;
    }
}