<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\PostDto;
use App\DTO\Posts\PostRequestDto;
use App\Models\Posts\Post;

class PostService
{
    public function saveData(PostRequestDto $dto, Post $post): void
    {
        $post->categories()->sync($dto->categories);
    }

    /**
     * @param PostRequestDto $dto
     * @return int
     */
    public function save(PostRequestDto $dto): int
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
        return [
            'data' => PostDto::fromModel($post->load('author', 'category')),
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
}
