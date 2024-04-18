<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\DTO\Users\UserSimpleDto;
use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

class UserController extends Controller
{
    public function index(): DataCollection
    {
        return UserSimpleDto::collect(User::all());
    }

    public function store(Request $request): JsonResponse
    {
    }

    public function show(User $user): JsonResponse
    {
    }

    public function edit(Request $request, User $user): JsonResponse
    {
    }

    public function update(Request $request, User $user): JsonResponse
    {
    }

    public function destroy(User $user): JsonResponse
    {
    }
}
