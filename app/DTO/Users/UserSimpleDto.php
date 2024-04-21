<?php

declare(strict_types=1);

namespace App\DTO\Users;

use Spatie\LaravelData\Data;

class UserSimpleDto extends Data
{
    public function __construct(
        public readonly string $username,
        public readonly string $email,
    ) {
    }
}
