<?php

namespace App\Traits;

trait GroupTrait
{
    public function scopeOfId($query, $id)
    {
        if ($id === null || $id === '') return false;
        return $query->where('id', $id);
    }

    public function scopeOfName($query, $name)
    {
        if ($name === null || $name === '') return false;

        return $query->where('name', 'LIKE', "%{$name}%");
    }
}
