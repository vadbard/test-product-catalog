<?php

namespace App\Repositories;

use App\Repositories\Dto\CategoryUpdateDto;

interface CategoryWriteRepositoryInterface
{
    public function updateById(int $id, CategoryUpdateDto $dto): void;
}
