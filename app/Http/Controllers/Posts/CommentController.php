<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\DTO\Posts\CommentRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CommentRequest;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use App\Services\Posts\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * @param CommentService $commentService
     */
    public function __construct(
        protected CommentService $commentService
    ) {
    }

    /**
     * @param CommentRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function store(CommentRequest $request, Post $post): JsonResponse
    {
        return response()->json([
            'id' => $this->commentService->saveElement(CommentRequestDto::from($request), $post)
        ]);
    }

    /**
     * @param CommentRequest $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(CommentRequest $request, Comment $comment): JsonResponse
    {
        return response()->json([
            'id' => $this->commentService->updateElement(CommentRequestDto::from($request), $comment)
        ]);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        return response()->json([
            'success' => $this->commentService->deleteElement($comment)
        ]);
    }
}
