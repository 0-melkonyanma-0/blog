<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\CommentRequestDto;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;

class CommentService
{
    /**
     * @param CommentRequestDto $dto
     * @param Post $post
     * @return int
     */
    public function saveElement(CommentRequestDto $dto, Post $post): int
    {
        return (Comment::create([
            ...$dto->toArray(),
            'post_id' => $post->id
        ]))->id;
    }

    /**
     * @param CommentRequestDto $dto
     * @param Comment $comment
     * @return int
     */
    public function updateElement(CommentRequestDto $dto, Comment $comment): int
    {
        $comment->update($dto->toArray());

        return $comment->id;
    }

    /**
     * @param Comment $comment
     * @return bool
     */
    public function deleteElement(Comment $comment): bool
    {
        return $comment->delete();
    }
}
