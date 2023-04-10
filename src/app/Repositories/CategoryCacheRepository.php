<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\Cache\CategoryRepositoryCacheKeyService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryCacheRepository extends CategoryRepository implements CategoryRepositoryInterface
{
    const CACHE_PREFIX = 'repository.category';

    public function __construct(private readonly CategoryRepository                $repository,
                                private readonly CategoryRepositoryCacheKeyService $cacheKeyService)
    {

    }

    public function getTree(int $parentId): Collection
    {
        return Cache::remember($this->cacheKeyService->makeGetTreeKey($parentId), 1440, function () use ($parentId) {
            return $this->repository->getTree($parentId);
        });
    }

    public function getById(int $id): ?Category
    {
        return Cache::remember($this->cacheKeyService->makeGetByIdKey($id), 1440, function () use ($id) {
            return $this->repository->getById($id);
        });
    }
}
