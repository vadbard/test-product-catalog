<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()
            ->count(1)
            ->create([
                'parent_id' => 0,
                'level' => 1,
            ]);

        Category::factory()
            ->count(1)
            ->has(Category::factory()->state(['level' => 2])->count(1), 'relChildren')
            ->create([
                'parent_id' => 0,
                'level' => 1,
            ]);

        Category::factory()
            ->count(1)
            ->has(Category::factory()->state(['level' => 2])->count(1)
                ->has(Category::factory()->state(['level' => 3])->count(1), 'relChildren')
                , 'relChildren')
            ->create([
                'parent_id' => 0,
                'level' => 1,
            ]);

        $noChildrenCategories = Category::doesntHave('relChildren')->get();

        foreach ($noChildrenCategories as $category) {
            Product::factory()->count(25)->state([
                'category_id' =>  $category->id,
            ])->create();
        }
    }
}
