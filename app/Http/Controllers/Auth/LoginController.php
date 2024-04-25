<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTO\Users\UserSimpleDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class LoginController extends GenerateToken
{
    /**
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required', 'exists,email', 'max:255',
            'password' => 'required', 'max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
