<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\DTO\Posts\PostRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Models\Posts\Post;
use App\Services\Posts\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * @param PostService $postService
     */
    public function __construct(
        protected readonly PostService $postService
    ) {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->postService->all();
    }

    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        return response()->json([
            'id' => $this->postService->saveElement(PostRequestDto::from($request))
        ]);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($this->postService->element($post));
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        return response()->json([
            'id' => $this->postService->updateElement(PostRequestDto::from($request), $post)
        ]);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        return response()->json([
            'success' => $this->postService->deleteElement($post)
        ]);
    }
}
