<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:20|confirmed'
        ]);

        $user = User::create($attributes);

        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $user->createToken(config('app.key'))->accessToken,
            ],
        ]);
    }
}
