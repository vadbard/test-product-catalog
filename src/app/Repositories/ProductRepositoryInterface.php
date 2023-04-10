<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getById(int $id): ?Product;

    public function getByCategoryId(int $id): Collection;

    public function search(string $term): Collection;
}
