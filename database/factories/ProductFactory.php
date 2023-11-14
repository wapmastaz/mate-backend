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
            'name' => fake()->jobTitle(),
            'code' => uniqid(),
            'price' => rand(500, 10000),
            'image' => 'def.png',
            'quantity' => 100,
            'quantity_alert' => 10,
            'status' => true,
        ];
    }
}
