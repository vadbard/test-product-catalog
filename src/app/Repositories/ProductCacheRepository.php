<?php

namespace App\Repositories;

use App\Enums\SortOrderEnum;
use App\Models\Product;
use App\Services\Cache\ProductRepositoryCacheKeyService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProductCacheRepository extends ProductRepository implements ProductRepositoryInterface
{
    const CACHE_PREFIX = 'repository.product';

    public function __construct(private readonly ProductRepository                $repository,
                                private readonly ProductRepositoryCacheKeyService $cacheKeyService)
    {

    }

    public function getById(int $id): ?Product
    {
        return Cache::remember($this->cacheKeyService->makeGetByIdKey($id), 1440, function () use ($id) {
            return $this->repository->getById($id);
        });
    }

    public function getByCategoryId(int $id, SortOrderEnum $sortByName = null): Collection
    {
        return Cache::remember($this->cacheKeyService->makeGetByCategoryIdKey($id), 1440, function () use ($id) {
            return $this->repository->getByCategoryId($id);
        });
    }
}
