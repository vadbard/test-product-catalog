<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getTree(int $parentId): Collection;

    public function getById(int $id): ?Category;
}
