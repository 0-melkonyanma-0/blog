<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use Spatie\LaravelData\Data;

class CategoryDto extends Data
{
    public function __construct(
        public readonly string $title
    ) {
    }
}
