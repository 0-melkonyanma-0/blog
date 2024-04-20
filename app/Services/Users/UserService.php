<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\DTO\Users\UserRequestDto;
use App\DTO\Users\UserSimpleDto;
use App\Models\Users\User;
use Illuminate\Http\JsonResponse;

class UserService
{
    /**
     * @return array<string|int,string>
     */
    public function index(): array
    {
        return [
            'data' => UserSimpleDto::collect(User::all())
        ];
    }

    public function show(User $user): UserSimpleDto
    {
        return UserSimpleDto::from($user);
    }

    public function update(UserRequestDto $userRequestDto, User $user): int
    {
        $user->update();

        return $user->id;
    }

    public function delete(User $user): ?bool
    {
        return $user->delete();
    }
}
