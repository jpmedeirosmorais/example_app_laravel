<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Enums\StatusProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $categories = Category::all();

        return [
            'name' => fake()->word(),
            'category_id' => $categories->random()->id,
            'price' => fake()->randomFloat(2, 1, 1000),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement([StatusProduct::Active, StatusProduct::Inactive])
        ];
    }
}
