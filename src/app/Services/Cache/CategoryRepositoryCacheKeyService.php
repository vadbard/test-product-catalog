<?php

namespace App\Services\Cache;

use App\Repositories\CategoryCacheRepository;

class CategoryRepositoryCacheKeyService
{
    public function makeGetTreeKey(int $id): string
    {
        return CategoryCacheRepository::CACHE_PREFIX . '.getTree.' . $id;
    }

    public function makeGetByIdKey(int $id): string
    {
        return CategoryCacheRepository::CACHE_PREFIX . '.getById.' . $id;
    }
}
