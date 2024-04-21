<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Services\Posts\UserPostService;
use Illuminate\Http\JsonResponse;

class UserPostController extends Controller
{
    public function __construct(
        protected UserPostService $archiveService
    ) {
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function unArchivePost(Post $post): JsonResponse
    {
        return response()->json($this->archiveService->unArchived($post));
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function archivePost(Post $post): JsonResponse
    {
        return response()->json($this->archiveService->archived($post));
    }

    /**
     * @return JsonResponse
     */
    public function showArchivedPostsForCurrentUser(): JsonResponse
    {
        return response()->json([
            'data' => $this->archiveService->showArchivedElements()
        ]);
    }

    public function showUserPosts(User $user): JsonResponse
    {
        return response()->json([
            'data' => $this->archiveService->showElements($user)
        ]);
    }

    public function showUserPost(User $user): JsonResponse
    {
        return response()->json([
            'data' => $this->archiveService->showElements($user)
        ]);
    }
}
