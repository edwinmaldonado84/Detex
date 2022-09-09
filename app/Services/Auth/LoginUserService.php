<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use App\Models\User;

class LoginUserService extends BaseService
{

    private array $response;

    public function __construct(User $user)
    {
        $response = [];

        $response['id'] = $user->id;
        $response['name'] = $user->name;
        $response['email'] = $user->email;
        $response['token'] = $user->createToken('app')->accessToken;
        /* $response['role'] = $user->getRoleNames()->first();
        $response['permissions'] = $user->getPermissionsViaRoles()->pluck('name'); */

        $this->response = $response;
    }

    public function get()
    {
        return $this->response;
    }
}
