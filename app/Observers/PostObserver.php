<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Posts\Post;

class PostObserver
{
    /**
     * @param Post $post
     * @return void
     */
    public function creating(Post $post): void
    {
        $post->author_id = auth()->user()->id;
    }
}
