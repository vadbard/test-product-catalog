<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Repositories\Category\Dto\GetProductsByCategoryDto;
use Illuminate\Foundation\Http\FormRequest;

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
            'categoryId' => 'integer|exists:categories,parent_id'
        ];
    }

    public function dto(): GetProductsByCategoryDto
    {
        $parent = null;
        if ($this->input('parentId')) {
            $parent = Category::findOrFail($this->input('parentId'));
        }

        return new GetProductsByCategoryDto([
            'parent' => $parent,
        ]);
    }
}
