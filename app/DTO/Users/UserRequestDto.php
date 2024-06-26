<?php

declare(strict_types=1);

namespace App\DTO\Users;

use Spatie\LaravelData\Data;

class UserRequestDto extends Data
{
    /**
     * @param string $name
     * @param string $username
     * @param string $email
     * @param string|null $password
     */
    public function __construct(
        public readonly string $name,
        public readonly string $username,
        public readonly string $email,
        public readonly ?string $password
    ) {
    }
}
