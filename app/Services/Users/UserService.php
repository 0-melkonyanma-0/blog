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
        $info = $userRequestDto->toArray();
        if (!$info['password']) {
            unset($info['password']);
        }

        $user->update($info);
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

    /**
     * @param User $user
     * @return array
     */
    public function startFollow(User $user): array
    {
        if ($user->id !== auth()->user()->id) {
            $user->followers()->sync(auth()->user()->id);

            return [
                'message' => 'Subscribed',
                'status' => 200
            ];
        }

        return [
            'message' => 'You can\'t follow yourself',
            'status' => 403
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function unFollow(User $user): array
    {
        if ($user->id !== auth()->user()->id) {
            $user->followers()->detach(auth()->user()->id);

            return [
                'message' => 'Unsubscribed',
                'status' => 200
            ];
        }

        return [
            'message' => 'You can\'t unfollow yourself',
            'status' => 403
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function getFollowers(User $user): array
    {
        return [
            'data' => [
                'count' => $user->followers()->count(),
                'followers' => $user->followers()->pluck('username')
            ],
            'status' => 200
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function getAuthors(User $user): array
    {
        return [
            'data' => UserSimpleDto::collect($user->authors()->get()),
            'status' => 200
        ];
    }
}
