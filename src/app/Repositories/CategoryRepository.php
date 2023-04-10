<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Category\Dto\CategoryGetTreeDto;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getTree(int $parentId): Collection
    {
        $maxLevel = Category::max('level');

        $level = 1;
        if ($parentId->parent) {
            $level = $parentId->parent->level;
        }

        $relArr = [];
        for ($i = $level; $i < $maxLevel - 1; $i++) {
            $relArr[] = 'relChildren';
        }

        $query = Category::query();

        if ($relArr) {
            $query->with(implode('.', $relArr));
        }

        if ($parentId->parent) {
            $query->where('level', '>=', $level);
        } else {
            $query->where('parent_id', '=', 0);
        }

        $query->orderBy('index');

        $categories = $query->get();

        if ($parentId->parent) {
            $categories = $categories->filter(function (Category $category, int $key) use ($parentId) {
                return $category->parent_id === $parentId->parent->id;
            });
        }

        return $categories;
    }

    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }
}
