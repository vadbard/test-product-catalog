<?php

namespace App\Services\Cache;

use App\Models\Product;
use App\Repositories\CategoryRepositoryInterface;
use Cache;

class ProductRepositoryCacheClearService
{
    public function __construct(private ProductRepositoryCacheKeyService $cacheKeyService,
                                private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function clearListsForProduct(Product $product): void
    {
        Cache::forget($this->cacheKeyService->makeGetByCategoryIdKey($product->relCategory->id));

        $parents = $this->categoryRepository->getAllParents($product->relCategory);

        foreach ($parents as $parent) {
            Cache::forget($this->cacheKeyService->makeGetByCategoryIdKey($parent->id));
        }
    }

    public function clearProduct(int $id): void
    {
        Cache::forget($this->cacheKeyService->makeGetByIdKey($id));
    }
}
