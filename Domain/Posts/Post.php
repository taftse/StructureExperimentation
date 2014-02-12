<?php namespace Domain\Posts;

use Domain\Core\Entity;

class Post extends Entity
{
    protected $validationRules = [
        'author_id' => 'required|exists:users,id',
    ];
}