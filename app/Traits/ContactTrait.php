<?php

namespace App\Traits;

trait ContactTrait
{
    public function scopeOfId($query, $id)
    {
        if ($id === null || $id === '') return false;
        return $query->where('contacts.id', $id);
    }

    public function scopeOfSearch($query, $search)
    {
        if ($search === null || $search === '') return false;

        return $query->where('contacts.name', 'LIKE', "%{$search}%")
            ->orWhere('contacts.last_name', 'LIKE', "%{$search}%")
            ->orWhere('phones.phone', 'LIKE', "%{$search}%")
            ->orWhere('emails.email', 'LIKE', "%{$search}%");
        // ->orWhere('groups.name', 'LIKE', "%{$search}%");
    }

    public function scopeOfCompanyId($query, $id)
    {
        if ($id === null || $id === '') return false;
        return $query->where('group_company_charge_contact.company_id', $id);
    }
}
