<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProfileResource;

class ProfilesController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $profile = User::where('id', auth('api')->user()->id)->first();
        if (is_null($profile)) {
            return $this->errorResponse('Profile was not found', 404);
        }

        return $this->successResponse(new ProfileResource($profile), 'Profile Details', 200);
    }
}
