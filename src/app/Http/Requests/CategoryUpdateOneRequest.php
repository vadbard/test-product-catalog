<?php

namespace App\Http\Requests;

use App\Repositories\Dto\CategoryUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateOneRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'parentId' => 'integer|exists:categories,id',
            'index' => 'integer',
        ];
    }

    public function dto(): CategoryUpdateDto
    {
        return new CategoryUpdateDto([
            'parentId' => $this->input('parentId'),
            'index' => $this->input('index'),
        ]);
    }
}
