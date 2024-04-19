<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\DTO\Users\UserRequestDto;
use App\DTO\Users\UserSimpleDto;
use App\Models\Users\User;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class UserService
{
    public function index(): Paginator|Enumerable|array|Collection|LazyCollection|PaginatedDataCollection|AbstractCursorPaginator|CursorPaginatedDataCollection|DataCollection|AbstractPaginator|CursorPaginator
    {
        return UserSimpleDto::collect(User::all());
    }

    public function show(User $user): UserSimpleDto
    {
        return UserSimpleDto::from($user);
    }

    public function update(UserRequestDto $userRequestDto, User $user): int
    {
        $user->update();

        return $user->id;
    }

    public function delete(User $user): ?bool
    {
        return $user->delete();
    }
}
