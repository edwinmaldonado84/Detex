<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class ApiPermissionsService
{

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function check($method, $publics, $permitions)
    {
        if (in_array($method, $publics)) {
            return true;
        } else {

            if ($this->user) {
                if ($this->user->hasRole('SuperAdmin')) {
                    return true;
                } else {
                    $role = Role::findByName($this->user->getRoleNames()->first());
                    if ($role) {
                        return  $role->hasPermissionTo($permitions[$method]);
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }
}
