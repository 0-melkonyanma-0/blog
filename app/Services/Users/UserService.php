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
    public function all(): array
    {
        return [
            'data' => UserSimpleDto::collect(User::all())
        ];
    }

    public function element(User $user): UserSimpleDto
    {
        return UserSimpleDto::from($user);
    }

    public function updateElement(UserRequestDto $userRequestDto, User $user): int
    {
        $user->update($userRequestDto->toArray());
        return $user->id;
    }

    public function deleteElement(User $user): ?bool
    {
        return $user->delete();
    }
}
