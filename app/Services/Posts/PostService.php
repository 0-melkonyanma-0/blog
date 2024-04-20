<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\PostDto;
use App\Models\Posts\Post;

class PostService
{
    /**
     * @param PostDto $dto
     * @return int
     */
    public function save(PostDto $dto): int
    {
        return (Post::create($dto->toArray()))->id;
    }

    /**
     * @param Post $post
     * @return array<string|int,string>
     */
    public function element(Post $post): array
    {
        return [
            'data' => PostDto::fromModel($post->load('author'))
        ];
    }

    /**
     * @param PostDto $dto
     * @param Post $post
     * @return int
     */
    public function updateElement(PostDto $dto, Post $post): int
    {
        $post->update($dto->toArray());
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
}
