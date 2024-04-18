<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Models\Users\User;

class UserService
{
    public function edit(User $user)
    {

    }

    public function show(User $user)
    {

    }

    public function save()
    {
        $user = User::create();

        return $user->id;
    }

    public function update(User $user): int
    {
        $user->update();

        return $user->id;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
