<?php

namespace Database\Factories;

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
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1000, 100000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => \App\Models\Category::factory(),
            'sku' => $this->faker->unique()->ean8(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'slug' => $this->faker->slug(),
        ];
    }
}
