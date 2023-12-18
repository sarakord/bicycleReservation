<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;

class ProfileController extends Controller
{
    public function profile()
    {
        return response()->json(new UserResource(\auth('api')->user()), 200);
    }
}
