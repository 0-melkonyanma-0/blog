<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\PostDto;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
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

    public function showElements(User $user): JsonResponse
    {
        return response()->json(
            PostDto::collect(Post::where(function (Builder $query) use ($user) {
                $query->whereNull('archived_at');
                $query->whereNull('deleted_at');
                $query->where('author_id', '=', $user->id);
            })->with('author', 'categories', 'views')->paginate(request()['amount'] ?? 20))
        );
    }

    /**
     * @param Post $post
     * @return array
     */
    public function archived(Post $post): array
    {
        if($post->author->id === auth()->user()->id) {
            $post->update([
                'archived_at' => Carbon::now()
            ]);

            return [
                'message' => 'Archived',
                'status' => 200
            ];
        }

        return [
            'message' => 'No content',
            'status' => 204
        ];
    }

    /**
     * @param Post $post
     * @return array
     */
    public function unArchived(Post $post): array
    {
        if($post->author->id === auth()->user()->id) {
            $post->update([
                'archived_at' => null
            ]);

            return [
                'message' => 'Unarchived',
                'status' => 200
            ];
        }

        return [
            'message' => 'No content',
            'status' => 204
        ];
    }
}
