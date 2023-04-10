<?php

namespace App\Repositories\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class CategoryUpdateDto extends DataTransferObject
{
    public ?int $parentId = null;
    public ?int $index = null;
}
