<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\DTO\Users\UserRequestDto;
use App\DTO\Users\UserSimpleDto;
use App\Models\Users\User;

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

    /**
     * @param User $user
     * @return UserSimpleDto
     */
    public function element(User $user): UserSimpleDto
    {
        return UserSimpleDto::from($user);
    }

    /**
     * @param UserRequestDto $userRequestDto
     * @param User $user
     * @return int
     */
    public function updateElement(UserRequestDto $userRequestDto, User $user): int
    {
        $user->update($userRequestDto->toArray());
        return $user->id;
    }

    /**
     * @param User $user
     * @return bool|null
     */
    public function deleteElement(User $user): ?bool
    {
        return $user->delete();
    }
}
