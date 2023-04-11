<?php

namespace App\Http\Controllers;

use App\Enums\SortOrderEnum;
use App\Http\Requests\CategoryGetTreeRequest;
use App\Http\Requests\ProductsGetByCategory;
use App\Http\Resources\ProductListItemResource;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function getOne(int $productId, ProductRepositoryInterface $repository): ProductResource
    {
        $product = $repository->getById($productId);

        if (!$product) {
            response('', 404);
        }

        return ProductResource::make($product);
    }

    public function getListByCategory(ProductsGetByCategory      $request,
                                      ProductRepositoryInterface $productRepository)
    {
        $categoryId = $request->input('categoryId');

        $sortName = null;
        if ($request->input('sortName')) {
            $sortName = SortOrderEnum::from($request->input('sortName'));
        }

        $products = $productRepository->getByCategoryId($categoryId, $sortName);

        return ProductListItemResource::collection($products);
    }

    public function search(CategoryGetTreeRequest $request, ProductRepositoryInterface $repository): AnonymousResourceCollection
    {
        $products = $repository->search($request->input('term', ''));

        return ProductListItemResource::collection($products);
    }
}
