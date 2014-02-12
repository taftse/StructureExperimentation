<?php namespace Domain\Core;

class Entity
{
    protected $validationRules = [];

    public function isValid()
    {

    }

    public function save(...)
    {
        if ( ! $this->isValid()) {
            return false;
        }

        parent::save(...);
    }
}