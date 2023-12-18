<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Resources\V1\LoginResource;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = auth()->user()->createToken('Login Token')->accessToken;
            return (new LoginResource(auth()->user(), $token, 'Bearer'))
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Email or password is incorrect.', 422]);
        }
    }
}
