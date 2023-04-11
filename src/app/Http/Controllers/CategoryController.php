<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryGetTreeRequest;
use App\Http\Requests\CategoryUpdateOneRequest;
use App\Http\Resources\CategoryListItemResource;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryWriteRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function getOne(mixed $categoryId, CategoryRepositoryInterface $repository)
    {
        if (getType($categoryId) != 'integer') {
            return response('', 404);
        }

        $category = $repository->getById($categoryId);

        if (!$category) {
            return response('', 404);
        }

        return CategoryResource::make($category);
    }

    public function getTree(CategoryGetTreeRequest $request, CategoryRepositoryInterface $repository): AnonymousResourceCollection
    {
        $tree = $repository->getTree($request->input('parentId', 0));

        return CategoryListItemResource::collection($tree);
    }

    public function updateOne(CategoryUpdateOneRequest         $request,
                              int                              $categoryId,
                              CategoryWriteRepositoryInterface $repositoryWrite,
                              CategoryRepositoryInterface      $repository): CategoryResource
    {
        $repositoryWrite->updateById($categoryId, $request->dto());

        return CategoryResource::make($repository->getById($categoryId));
    }
}
