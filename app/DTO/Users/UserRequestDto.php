<?php

namespace App\DTO\Users;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserRequestDto extends Data
{
    public function __construct(
        string $fullName,
        string $username,
        string $email,
        string $password
    ) {
    }
}
