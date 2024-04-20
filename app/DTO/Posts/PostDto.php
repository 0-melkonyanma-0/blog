<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use App\Models\Posts\Category;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class PostDto extends Data
{
    public function __construct(
        public readonly string             $title,
        public readonly string             $body,
        public readonly string             $cover = '',
        public readonly Lazy|User|null     $author = null,
        public readonly Lazy|Category|null $category = null,
    ) {
    }

    public static function fromModel(Post $post): self
    {
        return new self(
            $post->title,
            $post->body,
            $post->cover,
            Lazy::whenLoaded('author', $post, fn() => $post->author()->select('username', 'created_at')->get()),
            Lazy::whenLoaded('category', $post, fn() => $post->category()->select('title')->get()),
        );
    }

}
