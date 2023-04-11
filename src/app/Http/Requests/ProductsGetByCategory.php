<?php

namespace App\Http\Requests;

use App\Enums\SortOrderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductsGetByCategory extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'categoryId' => 'required|integer|exists:categories,id',
            'sortName' => Rule::in(SortOrderEnum::caseValues()),
        ];
    }
}
