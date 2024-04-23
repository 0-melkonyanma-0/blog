<?php

declare(strict_types=1);

namespace App\Policies\Posts;

use App\Models\Posts\Comment;
use App\Models\Users\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('comments_create');
    }

    public function update(User $user, Comment $comment): bool
    {
        return $comment->author->id === $user->id && $user->hasPermissionTo('comments_edit');
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $comment->author->id === $user->id && $user->hasPermissionTo('comments_delete');
    }
}
