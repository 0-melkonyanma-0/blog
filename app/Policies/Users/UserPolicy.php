<?php

declare(strict_types=1);

namespace App\Policies\Users;

use App\Models\Users\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('users_index');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('users_edit') && $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('users_delete') && $user->id === $model->id;
    }
}
