<?php

declare(strict_types=1);

namespace App\Policies\Posts;

use App\Models\Posts\Post;
use App\Models\Users\User;

class PostPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('posts_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $post->author->id === $user->id && $user->hasPermissionTo('posts_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $post->author->id === $user->id && $user->hasPermissionTo('posts_delete');
    }
}
