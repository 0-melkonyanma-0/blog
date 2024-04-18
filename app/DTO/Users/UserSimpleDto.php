<?php

declare(strict_types=1);

namespace App\DTO\Users;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserSimpleDto extends Data
{
    public function __construct(
        public readonly int    $id,
        public readonly string $fullName,
        public readonly string $username,
        public readonly string $email,
    ) {
    }
}
