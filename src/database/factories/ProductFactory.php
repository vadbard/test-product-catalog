<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence($nbWords = 3, $variableNbWords = true),
            'description' => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            'price' => fake()->randomNumber($nbDigits = NULL, $strict = false),
        ];
    }
}
