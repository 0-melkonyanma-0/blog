<?php

declare(strict_types=1);

namespace App\Policies\Posts;

use App\Models\Posts\Category;
use App\Models\Users\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('categories_read');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('categories_create');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('categories_edit');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('categories_delete');
    }
}
