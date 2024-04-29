<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use Spatie\LaravelData\Data;

class CategoryDto extends Data
{
    /**
     * @param string $title
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title
    ) {
    }
}
