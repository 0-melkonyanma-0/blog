<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Services\Posts\PostService;
use App\Services\Posts\UserPostService;
use Illuminate\Http\JsonResponse;

class UserPostController extends Controller
{
    /**
     * @param UserPostService $archiveService
     * @param PostService $postService
     */
    public function __construct(
        protected UserPostService $archiveService,
        protected PostService     $postService
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

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function showUserPosts(User $user): JsonResponse
    {
        return response()->json([
            'data' => $this->archiveService->showElements($user)
        ]);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function watch(Post $post): JsonResponse
    {
        return response()->json([
            'views' => $this->postService->makeView($post)
        ]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function showUserPost(User $user): JsonResponse
    {
        return response()->json([
            'data' => $this->archiveService->showElements($user)
        ]);
    }
}
