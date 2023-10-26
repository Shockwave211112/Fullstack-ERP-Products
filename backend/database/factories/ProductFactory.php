<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->domainWord(),
            'article' => fake()->unique()->word(),
            'status' => 'available',
            'data' => json_encode(['color' => fake()->colorName(), 'size' => fake()->numberBetween(1, 30)]),
        ];
    }
}
