<?php

namespace App\Traits;

trait ChargeTrait
{
    public function scopeOfId($query, $id)
    {
        if ($id === null || $id === '') return false;
        return $query->where('id', $id);
    }

    public function scopeOfSearch($query, $search)
    {
        if ($search === null || $search === '') return false;

        return $query->where('name', 'LIKE', "%{$search}%");
    }
}
