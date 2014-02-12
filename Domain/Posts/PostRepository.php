<?php namespace Domain\Posts;

class PostRepository
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getNew($data)
    {
        return $this->model->newInstance($data);
    }

    public function save(Post $model)
    {
        return $model->save();
    }
}