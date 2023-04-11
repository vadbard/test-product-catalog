<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getTree(int $parentId): Collection;

    public function getById(int $id): ?Category;

    public function getAllParents(Category $category): array;

    public function getAllChildrenIds(Category $category, array $ids = []): array;
}
