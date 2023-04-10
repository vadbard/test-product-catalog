<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProductCacheRepository extends AbstractCacheRepository implements ProductRepositoryInterface
{
    protected string $cachePrefix = 'repository.product';

    public function __construct(private ProductRepository $repository)
    {

    }

    public function getById(int $id): ?Product
    {
        return Cache::remember($this->makeKey(__FUNCTION__, $id), 1440, function () use ($id) {
            return $this->repository->getById($id);
        });
    }

    public function getByCategoryId(int $id): Collection
    {
        return Cache::remember($this->makeKey(__FUNCTION__, $id), 1440, function () use ($id) {
            return $this->repository->getByCategoryId($id);
        });
    }

    public function search(string $term): Collection
    {
        return $this->repository->search($term);
    }
}
