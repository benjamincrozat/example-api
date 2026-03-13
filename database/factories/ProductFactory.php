<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Generates realistic Product records for tests and local development.
 *
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array{name: string, description: string|null}
     */
    public function definition() : array
    {
        return [
            'name' => fake()->unique()->words(asText: true),
            'description' => fake()->boolean() ? fake()->sentence() : null,
        ];
    }
}
