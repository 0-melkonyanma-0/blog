<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\PostDto;
use App\DTO\Posts\PostRequestDto;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class PostService
{
    public function saveData(PostRequestDto $dto, Post $post): void
    {
        $post->categories()->sync($dto->categories);
    }

    public function elements(): JsonResponse
    {
        return response()->json(PostDto::collect(
            Post::where(function (Builder $query) {
                $query->whereNull('archived_at');
                $query->whereNull('deleted_at');
            })
                ->filter(request(['search']))
                ->with('author', 'categories', 'views')
                ->paginate(request()['amount'] ?? 20)
        ));
    }

    /**
     * @param PostRequestDto $dto
     * @return int
     */
    public function saveElement(PostRequestDto $dto): int
    {
        $post = Post::create($dto->toArray());
        $this->saveData($dto, $post);

        return $post->id;
    }

    /**
     * @param Post $post
     * @return array<string|int,string>
     */
    public function element(Post $post): array
    {
        if (!$post->archived_at || $post->author_id === auth()->user()->id) {
            return [
                'data' => PostDto::fromModel($post->load('author', 'categories', 'comments')),
                'status' => 200
            ];
        }

        return [
            'message' => 'No content',
            'status' => 204
        ];
    }

    /**
     * @param PostRequestDto $dto
     * @param Post $post
     * @return int
     */
    public function updateElement(PostRequestDto $dto, Post $post): int
    {
        $post->update($dto->toArray());
        $this->saveData($dto, $post);

        return $post->id;
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function deleteElement(Post $post): bool
    {
        return $post->delete();
    }

    /**
     * @param Post $post
     * @return int
     */
    public function makeView(Post $post): int
    {
        if($post->views->first()->user_id != auth()->user()->id) {
            $post->views()->create([
                'user_id' => auth()->user()->id
            ]);
        }

        return  $post->views()->count();
    }
}
