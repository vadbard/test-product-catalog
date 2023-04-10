<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryGetTreeRequest;
use App\Http\Resources\CategoryListItemResource;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function getOne(int $categoryId, CategoryRepositoryInterface $repository)
    {
        $category = $repository->getById($categoryId);

        if (!$category) {
            response('', 404);
        }

        return CategoryResource::make($category);
    }

    public function getTree(CategoryGetTreeRequest $request, CategoryRepositoryInterface $repository)
    {
        $tree = $repository->getTree($request->input('parentId', 0));

        return CategoryListItemResource::collection($tree);
    }
}
