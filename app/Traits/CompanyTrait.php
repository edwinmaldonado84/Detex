<?php

namespace App\Traits;

trait CompanyTrait
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

    public function scopeOfSearch($query, $search)
    {
        if ($search === null || $search === '') return false;

        return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('rfc', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('owner', 'LIKE', "%{$search}%");
    }
}
