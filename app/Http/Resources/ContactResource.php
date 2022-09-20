<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactResource extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'last_name' => $item->last_name,
                    'birtday' => $item->birtday,
                    'observations' => $item->observations,
                    'phones' => $item->phones,
                    'emails' => $item->emails,
                    'groups' => $item->groups,
                    'companies' => $item->companies,
                    'charges' => $item->charges,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }),
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage()
        ];
    }
}
