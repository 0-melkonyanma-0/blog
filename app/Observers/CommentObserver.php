<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Posts\Comment;

class CommentObserver
{
    /**
     * @param Comment $comment
     * @return void
     */
    public function creating(Comment $comment): void
    {
        $comment->author_id = auth()->user()->id;
    }
}
