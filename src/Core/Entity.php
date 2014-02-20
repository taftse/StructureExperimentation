<?php namespace Domain\Core;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
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