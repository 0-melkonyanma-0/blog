<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use App\Models\Posts\Category;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class PostDto extends Data
{
    public function __construct(
        public readonly string             $title,
        public readonly string             $body,
        public readonly string             $cover = '',
        public readonly Lazy|User|null     $created_at = null,
        public readonly Lazy|User|null     $author = null,
        public readonly Lazy|Category|null $categories = null,
    ) {
    }

    public static function fromModel(Post $post): self
    {
        return new self(
            $post->title,
            $post->body,
            $post->cover,
            Lazy::whenLoaded('author', $post, fn() => Carbon::parse($post->created_at)->format('d.m.Y H:i:s')),
            Lazy::whenLoaded('author', $post, fn() => $post->author->select('username')->get()),
            Lazy::whenLoaded('categories', $post, fn() => $post->categories->select('title')),
        );
    }

}
