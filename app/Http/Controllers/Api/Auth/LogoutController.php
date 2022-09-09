<?php

namespace App\Http\Controllers\Api\Auth;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    use ApiResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        auth('api')->user()->token()->revoke();
        return $this->successResponse([], 'Logged out successfully', 200);
    }
}
