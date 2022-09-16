<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'role' => $item->getRoleNames()->first(),
                    'permissions' => $item->getPermissionsViaRoles()->pluck('name'),
                ];
            }),
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage()
        ];
    }

    public function toSimpleData($request)
    {
        $item = $this->collection[0];
        return [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'role' => $item->getRoleNames()->first(),
            'permissions' => $item->getPermissionsViaRoles()->pluck('name'),
        ];
    }
}
