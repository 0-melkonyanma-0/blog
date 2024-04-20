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
    public function __construct(
        protected readonly PostService $postService
    ) {
    }

    public function index()
    {
        // TODO: after down with view functionality
    }

//    /**
//     * @param PostRequest $request
//     * @return JsonResponse
//     */
    public function store(PostRequest $request): void //JsonResponse
    {

        dd(PostRequestDto::from($request));
//
//        return response()->json([
//            'id' => $this->postService->save(PostRequestDto::from($request))
//        ]);
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
