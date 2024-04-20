<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\DTO\Users\UserRequestDto;
use App\DTO\Users\UserSimpleDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;
use App\Models\Users\User;
use App\Services\Users\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userService->index());
    }

    public function show(User $user): UserSimpleDto
    {
        return $this->userService->show($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        return response()->json(
            [
                'id' => $this->userService->update(UserRequestDto::from($request), $user)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        return response()->json([
            'success' => $this->userService->delete($user)
        ]);
    }
}
