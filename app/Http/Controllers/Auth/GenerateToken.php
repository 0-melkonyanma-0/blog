<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class GenerateToken extends Controller
{
    public function responseWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expiers_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
