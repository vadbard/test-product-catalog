<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getTree(int $parentId): Collection
    {
        $maxLevel = Category::max('level');

        $level = 1;
        if ($parentId > 0) {
            $level = Category::findOrFail($parentId)->level;
        }

        $relArr = [];
        for ($i = $level; $i < $maxLevel - 1; $i++) {
            $relArr[] = 'relChildren';
        }

        $query = Category::query();

        if ($relArr) {
            $query->with(implode('.', $relArr));
        }

        if ($parentId > 0) {
            $query->where('level', '>=', $level);
        } else {
            $query->where('parent_id', '=', 0);
        }

        $query->orderBy('index');

        $categories = $query->get();

        if ($parentId > 0) {
            $categories = $categories->filter(function (Category $category, int $key) use ($parentId) {
                return $category->parent_id === $parentId;
            });
        }

        return $categories;
    }

    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function getAllParents(Category $category): array
    {
        /** @var array<Category> $parents*/
        $parents = [];

        while(!is_null($category)) {
            $category = $category->relParent;

            if ($category) {
                $parents[] = $category;
            }
        }

        return $parents;
    }

    public function getAllChildrenIds(Category $category, array $ids = []): array
    {
        $ids[] = $category->id;

        foreach ($category->relChildren as $category) {
            $ids[] = $category->id;

            if ($category->relChildren) {
                $this->getAllChildrenIds($category);
            }
        }

        return $ids;
    }
}
