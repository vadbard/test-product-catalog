<?php

namespace App\Repositories;

use App\Exceptions\Repository\CategoryUpdateBadParameterRepositoryException;
use App\Models\Category;
use App\Repositories\Dto\CategoryUpdateDto;

class CategoryWriteRepository implements CategoryWriteRepositoryInterface
{
    public function updateById(int $id, CategoryUpdateDto $dto): void
    {
        $category = Category::findOrFail($id);

        if (isset($dto->parentId)) {
            if (! Category::where('id', $dto->parentId)->exists()) {
                throw new CategoryUpdateBadParameterRepositoryException('parent_id', $dto->parentId);
            }

            $category->parent_id = $dto->parentId;
        }

        if (isset($dto->index)) {
            $category->index = $dto->index;
        }

        if ($category->isDirty()) {
            $category->save();
        }
    }
}
