<?php

namespace App\Enums;

enum SortOrderEnum: string
{
    case ASC = 'asc';
    case DESC = 'desc';

    public static function caseValues(): array
    {
        $values = [];
        foreach (SortOrderEnum::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
