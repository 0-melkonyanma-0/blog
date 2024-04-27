<?php

declare(strict_types=1);

namespace App\DTO\Users;

use App\Models\Users\User;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class UserSimpleDto extends Data
{
    /**
     * @param string $name
     * @param string $username
     * @param string $email
     * @param string $role
     * @param Collection $permissions
     */
    public function __construct(
        public readonly string $name,
        public readonly string $username,
        public readonly string $email,
        public readonly string $role,
        public readonly Collection $permissions
    ) {
    }

    public static function fromModel(User $user): UserSimpleDto
    {
        return new self(
            $user->name,
            $user->username,
            $user->email,
            $user->roles()->first()->name,
            $user->roles()->first()->permissions->pluck('name')
        );
    }
}
