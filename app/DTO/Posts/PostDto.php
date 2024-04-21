<?php

declare(strict_types=1);

namespace App\DTO\Posts;

use App\Models\Posts\Category;
use App\Models\Posts\Comment;
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
        public readonly Lazy|string|null   $created_at = null,
        public readonly Lazy|User|null     $author = null,
        public readonly Lazy|Category|null $categories = null,
        public readonly Lazy|Comment|null  $comments = null,
        public readonly Lazy|int|null      $views = null,
    ) {
    }

    public static function fromModel(Post $post): self
    {
        return new self(
            $post->title,
            $post->body,
            $post->cover,
            Lazy::when(fn() => $post->created_at !== null, fn() => Carbon::parse($post->created_at)->format('d.m.Y H:i:s')),
            Lazy::whenLoaded('author', $post, fn() => $post->author),
            Lazy::whenLoaded('categories', $post, fn() => $post->categories->select('title')),
            Lazy::whenLoaded('comments', $post, fn() => $post->comments()->with('author')->get()
                ->select('body', 'author', 'created_at', 'updated_at')->whereNull('deleted_at')),
            Lazy::whenLoaded('views', $post, fn() => $post->views()->count()),
        );
    }

}
