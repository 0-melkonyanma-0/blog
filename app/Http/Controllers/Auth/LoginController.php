<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTO\Users\UserSimpleDto;
use Illuminate\Http\JsonResponse;

class LoginController extends GenerateToken
{
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->responseWithToken($token);
    }

    public function currentUser(): JsonResponse
    {
        return response()->json(UserSimpleDto::from(auth()->user()));
    }

    public function refresh(): JsonResponse
    {
        return $this->responseWithToken(auth()->refresh());
    }
}
