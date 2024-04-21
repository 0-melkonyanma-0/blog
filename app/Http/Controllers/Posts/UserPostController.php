<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\DTO\Posts\PostDto;
use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class UserPostController extends Controller
{
    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function unArchivePost(Post $post): JsonResponse
    {
        if($post->author->id === auth()->user()->id) {
            $post->update([
                'archived_at' => null,
            ]);

            return response()->json([
                'id' => $post->id
            ]);
        }

        return response()->json([
            'message' => "It's not your post"
        ]);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function archivePost(Post $post): JsonResponse
    {
        if($post->author->id === auth()->user()->id) {
            $post->update([
                'archived_at' => Carbon::now(),
            ]);

            return response()->json([
                'id' => $post->id
            ]);
        }

        return response()->json([
            'message' => "It's not your post"
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function showArchivedPostsOfCurrentUser(): JsonResponse
    {
        return response()->json([
            'data' => PostDto::collect(Post::where(function(Builder $query) {
                $query->where('author_id', '=', auth()->user()->id);
                $query->whereNotNull('archived_at');
            })->get())
        ]);
    }

    public function showUserPost(User $user): JsonResponse
    {
        return response()->json([
            'data' => PostDto::collect(Post::where(function (Builder $query) use ($user) {
                $query->where('is_archived', '=', false);
                $query->whereNull('archived_at');
                $query->whereNull('deleted_at');
                $query->where('author_id', '=', $user->id);
            })->get()->load('author', 'categories'))
        ]);
    }
}
