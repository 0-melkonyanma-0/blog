<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\DTO\Posts\CategoryDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CategoryRequest;
use App\Models\Posts\Category;
use App\Models\Posts\Post;
use App\Services\Posts\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @param CategoryService $categoryService
     */
    public function __construct(
        protected readonly CategoryService $categoryService
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->categoryService->all()
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'data' => $this->categoryService->element($category)
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        if ($request->user()->can('create', Category::class)) {
            return response()->json([
                'id' => $this->categoryService->saveElement(CategoryDto::from($request))
            ]);
        }

        return response()->json([
            'message' => 'You cannot create a new category . '
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        if ($request->user()->can('update', $category)) {
            return response()->json([
                'id' => $this->categoryService->updateElement(CategoryDto::from($request), $category)
            ]);
        }

        return response()->json([
            'message' => 'You cannot update a category . '
        ]);
    }

    public function destroy(Category $category): JsonResponse
    {
        if (request()->user()->can('delete', $category)) {
            return response()->json([
                'success' => $this->categoryService->deleteElement($category)
            ]);
        }

        return response()->json([
            'message' => 'You cannot delete a category . '
        ]);
    }
}
