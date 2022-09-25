<?php

namespace App\Traits;

trait CompanyTrait
{
    public function scopeOfId($query, $id)
    {
        if ($id === null || $id === '') return false;
        return $query->where('id', $id);
    }

    public function scopeOfSearch($query, $search)
    {
        if ($search === null || $search === '') return false;

        return $query->where('companies.name', 'LIKE', "%{$search}%")
            ->orWhere('companies.business_name', 'LIKE', "%{$search}%")
            ->orWhere('companies.rfc', 'LIKE', "%{$search}%")
            ->orWhere('companies.webpage', 'LIKE', "%{$search}%")
            ->orWhere('groups.name', 'LIKE', "%{$search}%");
    }

    public function scopeOfGroupId($query, $id)
    {
        if ($id === null || $id === '') return false;
        return $query->where('groups.id', $id);
    }
}
