<?php

namespace App\Repositories;

use App\Enums\SortOrderEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getById(int $id): ?Product;

    public function getByCategoryId(int $id, SortOrderEnum $sortByName = null): Collection;

    public function search(string $term): Collection;
}
