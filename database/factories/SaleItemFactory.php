<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleItem>
 */
class SaleItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'sale_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, \App\Models\Product::count()),
        ];
    }
}
