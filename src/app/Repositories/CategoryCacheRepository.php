<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\CategoryCacheRepositoryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryCacheRepository extends AbstractCacheRepository implements CategoryRepositoryInterface
{
    public function __construct(private readonly CategoryRepository $repository,
                                private readonly CategoryCacheRepositoryService $cacheService)
    {

    }

    public function getTree(int $parentId): Collection
    {
        return Cache::remember($this->cacheService->makeGetTreeKey($parentId), 1440, function () use ($parentId) {
            return $this->repository->getTree($parentId);
        });
    }

    public function getById(int $id): ?Category
    {
        return Cache::remember($this->cacheService->makeGetByIdKey($id), 1440, function () use ($id) {
            return $this->repository->getById($id);
        });
    }
}
