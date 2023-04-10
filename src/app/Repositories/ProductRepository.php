<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function getById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function getByCategoryId(int $id): Collection
    {
        return Product::where('category_id', $id)->get();
    }

    public function search(string $term): Collection
    {
        return Product::query()
            ->whereFullText(['name', 'description'], $term)
            ->get();
    }
}
