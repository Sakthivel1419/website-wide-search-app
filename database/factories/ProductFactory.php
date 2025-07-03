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
            'name' => $this->faker->randomElement([
                'Smartphone',
                'Bluetooth Speaker',
                'Wireless Mouse',
                'LED Monitor',
                'Gaming Keyboard'
            ]),
            'description' => 'This is a sample product description for testing search.',
            'category' => $this->faker->randomElement(['Electronics', 'Accessories']),
            'price' => $this->faker->randomFloat(2, 99, 499),
        ];
    }
}
