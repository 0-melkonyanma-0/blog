<?php

declare(strict_types=1);

namespace App\Services\Posts;

use App\DTO\Posts\CategoryDto;
use App\Models\Posts\Category;
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

class CategoryService
{
    public function all(): Paginator|Enumerable|array|Collection|DataCollection|CursorPaginatedDataCollection|AbstractCursorPaginator|PaginatedDataCollection|LazyCollection|AbstractPaginator|CursorPaginator
    {
        return CategoryDto::collect(Category::all());
    }

    /**
     * @param CategoryDto $dto
     * @return int
     */
    public function save(CategoryDto $dto): int
    {
        return (Category::create($dto->toArray()))->id;
    }

    /**
     * @param Category $category
     * @return CategoryDto
     */
    public function element(Category $category): CategoryDto
    {
        return CategoryDto::from($category);
    }

    /**
     * @param CategoryDto $dto
     * @param Category $category
     * @return int
     */
    public function updateElement(CategoryDto $dto, Category $category): int
    {
        $category->update($dto->toArray());
        return $category->id;
    }

    /**
     * @param Category $post
     * @return bool
     */
    public function deleteElement(Category $post): bool
    {
        return $post->delete();
    }
}
