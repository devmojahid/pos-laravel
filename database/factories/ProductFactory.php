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
            'name' => $this->faker->name,
            'sku' => $this->faker->unique()->randomNumber(8),
            'unit' => $this->faker->randomElement(['kg', 'g', 'l', 'ml']),
            'unit_value' => $this->faker->randomFloat(2, 1, 100),
            'selling_price' => $this->faker->randomFloat(2, 1, 100),
            'purchase_price' => $this->faker->randomFloat(2, 1, 100),
            'discount' => $this->faker->randomFloat(2, 1, 100),
            'tax' => $this->faker->randomFloat(2, 1, 100),
            'image' => $this->faker->imageUrl(200, 200, 'product', true),
        ];
    }
}
