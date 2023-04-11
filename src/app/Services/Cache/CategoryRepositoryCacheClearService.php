<?php

namespace App\Services\Cache;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Cache;

class CategoryRepositoryCacheClearService
{
    public function __construct(private readonly CategoryRepositoryCacheKeyService $cacheKeyService,
                                private readonly CategoryRepositoryInterface $repository)
    {
    }

    public function clearAllParentsTrees(Category $category): void
    {
        $parents = $this->repository->getAllParents($category);

        foreach ($parents as $parent) {
            Cache::forget($this->cacheKeyService->makeGetTreeKey($parent->id));
        }
    }

    public function clearCategory(Category $category): void
    {
        Cache::forget($this->cacheKeyService->makeGetByIdKey($category->id));
    }
}
