<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class GenerateToken extends Controller
{
    /**
     * @param $token
     * @return JsonResponse
     */
    public function responseWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'expiers_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
