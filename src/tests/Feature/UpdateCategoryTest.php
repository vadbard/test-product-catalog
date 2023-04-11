<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testCategoryUpdate(): void
    {
        $this->seed();

        /** @var Category $categoryToUpdate */
        $categoryToUpdate = Category::orderBy('id')->first();

        /** @var Category $parent */
        $parent = Category::orderByDesc('id')->first();

        $data = [
            'parentId' => $parent->id,
            'index' => 1000,
        ];

        $this->makeRequest($categoryToUpdate->id, $data)
            ->assertStatus(200)
            ->assertJson(['data' => $data]);
    }

    public function testCategoryUpdateValidationFail(): void
    {
        $this->seed();

        /** @var Category $categoryToUpdate */
        $categoryToUpdate = Category::orderBy('id')->first();

        $data = [
            'parentId' => 0,
        ];

        $this->makeRequest($categoryToUpdate->id, $data)
            ->assertStatus(422);

        $data = [
            'index' => 'a',
        ];

        $this->makeRequest($categoryToUpdate->id, $data)
            ->assertStatus(422);
    }

    private function makeRequest(int $categoryId, array $data): TestResponse
    {
        return $this->patchJson(route('categories.updateCategory', ['categoryId' => $categoryId]), $data);
    }
}
