<?php

declare(strict_types=1);

namespace App\Policies\Posts;

use App\Models\Posts\Post;
use App\Models\Users\User;

class PostPolicy
{
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('posts_create');
    }

    public function update(User $user, Post $post): bool
    {
        return $post->author->id === $user->id && $user->hasPermissionTo('posts_edit');
    }

    public function delete(User $user, Post $post): bool
    {
        return $post->author->id === $user->id && $user->hasPermissionTo('posts_delete');
    }
}
