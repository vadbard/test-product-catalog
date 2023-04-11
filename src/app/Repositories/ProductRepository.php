<?php

namespace App\Repositories;

use App\Enums\SortOrderEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class ProductRepository implements ProductRepositoryInterface
{
    public function getById(int $id): ?Product
    {
        return Product::with('relCategory')->find($id);
    }

    public function getByCategoryId(int $id, SortOrderEnum $sortByName = null): SupportCollection
    {
        $categoryRepository = app(CategoryRepositoryInterface::class);

        $categoryTree = $categoryRepository->getTree($id);

        $categoryTreeIds = collect($id);

        foreach ($categoryTree as $category) {
            $categoryTreeIds->push($category->id);
            $categoryTreeIds->merge($categoryRepository->getAllChildrenIds($category));
        }

        $query = Product::whereIn('category_id', $categoryTreeIds->toArray());

        if ($sortByName) {
            $query->orderBy('name', $sortByName->value);
        }

        return $query->get();
    }

    public function search(string $term): Collection
    {
        return Product::query()
            ->where('name', 'ilike', '%' . $term . '%')
            ->orWhere('name', 'ilike', '%' . $term . '%')
            ->get();
    }
}
