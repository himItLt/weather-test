<?php

namespace App\DTOs;

abstract class BaseData
{
    abstract function getAttributes(): array;

    public function toArray(): array
    {
        $result = [];

        foreach ($this->getAttributes() as $attribute) {
           $result[$attribute] = $this->$attribute;
        }

        return $result;
    }
}
