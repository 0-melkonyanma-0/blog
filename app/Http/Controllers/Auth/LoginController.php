<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTO\Users\UserSimpleDto;
use Illuminate\Http\JsonResponse;

class LoginController extends GenerateToken
{
    /**
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->responseWithToken($token);
    }

    /**
     * @return JsonResponse
     */
    public function currentUser(): JsonResponse
    {
        return response()->json(UserSimpleDto::from(auth()->user()));
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->responseWithToken(auth()->refresh());
    }
}
