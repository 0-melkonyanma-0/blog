<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use App\Models\Posts\Post;
use App\Models\Users\User;
use Ramsey\Collection\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class PostDto extends Data
{
    public function __construct(
        public readonly string         $title,
        public readonly string         $body,
        public readonly string         $cover = '',
        public readonly Lazy|User|null $author = null,
    ) {
    }

    public static function fromModel(Post $post): self
    {
        return new self(
            $post->title,
            $post->body,
            $post->cover,
            Lazy::whenLoaded('author', $post, fn() => $post->author()->select('username', 'created_at')->get()),
        );
    }

}
