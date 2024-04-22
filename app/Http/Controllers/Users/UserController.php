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
    /**
     * @param UserService $userService
     */
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(UserRequestDto::collect($this->userService->all()));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => $this->userService->element($user)
        ]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function showFollowers(User $user): JsonResponse
    {
        return response()->json($this->userService->getFollowers($user));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function showAuthors(User $user): JsonResponse
    {
        return response()->json($this->userService->getAuthors($user));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function follow(User $user): JsonResponse
    {
        return response()->json($this->userService->startFollow($user));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function unFollow(User $user): JsonResponse
    {
        return response()->json($this->userService->unFollow($user));
    }


    /**
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        return response()->json([
            'id' => $this->userService->updateElement(UserRequestDto::from($request), $user)
        ]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        return response()->json([
            'success' => $this->userService->deleteElement($user)
        ]);
    }
}
