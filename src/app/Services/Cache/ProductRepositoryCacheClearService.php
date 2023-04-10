<?php

namespace App\Services\Cache;

use Cache;

class ProductRepositoryCacheClearService
{
    public function __construct(private ProductRepositoryCacheKeyService $cacheKeyService)
    {
    }

    public function clearListByCategoryId(int $categoryId): void
    {
        Cache::forget($this->cacheKeyService->makeGetByCategoryIdKey($categoryId));
    }

    public function clearById(int $id): void
    {
        Cache::forget($this->cacheKeyService->makeGetByIdKey($id));
    }
}
