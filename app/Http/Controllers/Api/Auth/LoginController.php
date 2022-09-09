<?php

namespace App\Http\Controllers\Api\Auth;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\LoginUserService;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    use ApiResponse;

    public function store(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            $service = new LoginUserService(Auth::user());
            $response = $service->get();


            return $this->successResponse($response, 'You are now logged in', 200);
        }

        return $this->notAuthorizedResponse('Invalid Credentials', 401);
    }
}
