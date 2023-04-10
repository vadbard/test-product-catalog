<?php

namespace App\Services\Cache;

use App\Models\Category;
use Cache;

class CategoryRepositoryCacheClearService
{
    public function __construct(private CategoryRepositoryCacheKeyService $cacheKeyService)
    {
    }

    public function clearAllParentsTrees(Category $category): void
    {
        /** @var array<Category> $parents*/
        $parents = [];

        while(!is_null($category)) {
            $category = $category->relParent;

            $parents[] = $category;
        }

        foreach ($parents as $parent) {
            Cache::forget($this->cacheKeyService->makeGetTreeKey($parent->id));
        }
    }

    public function clearCategory(Category $category): void
    {
        Cache::forget($this->cacheKeyService->makeGetByIdKey($category->id));
    }
}
