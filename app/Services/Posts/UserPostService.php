<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\PostDto;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class UserPostService
{
    /**
     * @return array|Collection|LazyCollection
     */
    public function showArchivedElements(): array|Collection|LazyCollection
    {
        return PostDto::collect(Post::where(function(Builder $query) {
            $query->where('author_id', '=', auth()->user()->id);
            $query->whereNotNull('archived_at');
            $query->whereNull('deleted_at');
        })->get());
    }

    public function showElements(User $user): array|Collection|LazyCollection
    {
        return PostDto::collect(Post::where(function (Builder $query) use ($user) {
            $query->whereNull('archived_at');
            $query->whereNull('deleted_at');
            $query->where('author_id', '=', $user->id);
        })->get()->load('author', 'categories'));
    }

    /**
     * @param Post $post
     * @param string $status
     * @return string
     */
    public function archived(Post $post): string
    {
        if($post->author->id === auth()->user()->id) {
            $post->update([
                'archived_at' => Carbon::now()
            ]);

            return 'archived';
        }

        return 'It\'s not your post';
    }

    /**
     * @param Post $post
     * @return string
     */
    public function unArchived(Post $post): string
    {
        if($post->author->id === auth()->user()->id) {
            $post->update([
                'archived_at' => null
            ]);

            return  'unarchived';
        }

        return 'It\'s not your post';
    }
}
