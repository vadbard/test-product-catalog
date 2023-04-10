<?php

namespace App\Services\Cache;

use App\Repositories\ProductCacheRepository;

class ProductRepositoryCacheKeyService
{
    public function makeGetByIdKey(int $id): string
    {
        return ProductCacheRepository::CACHE_PREFIX . '.getById.' . $id;
    }

    public function makeGetByCategoryIdKey(int $id): string
    {
        return ProductCacheRepository::CACHE_PREFIX . '.getByCategoryId.' . $id;
    }
}
