<?php

namespace App\Services;

use App\Models\Category;
use Cache;

class CategoryCacheRepositoryService
{
    protected string $cachePrefix = 'repository.category';

    public function makeGetTreeKey(int $id): string
    {
        return $this->cachePrefix . '.getTree.' . $id;
    }

    public function makeGetByIdKey(int $id): string
    {
        return $this->cachePrefix . '.getById.' . $id;
    }

    public function clearCategoryTreeParents(Category $category): void
    {
        while ($category->relParent) {
            Cache::forget('key');
        }
    }

    cache
}
