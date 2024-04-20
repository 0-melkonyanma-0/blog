<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends GenerateToken
{
    /**
     * @throws ValidationException
     */
    public function register(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        User::create($validator->validated());

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        };

        return $this->responseWithToken($token);
    }
}