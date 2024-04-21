<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use App\Models\Posts\Category;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class PostRequestDto extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $body,
        public readonly array  $categories,
        public readonly string $cover = '',
    ) {
    }
}
