<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'sku' => strtoupper($this->faker->unique()->lexify('PROD-????')),
            'description' => $this->faker->sentence(),
            'purchase_price' => $this->faker->randomFloat(2, 10000, 50000),
            'selling_price' => $this->faker->randomFloat(2, 60000, 100000),
            'stock' => $this->faker->numberBetween(10, 100),
            'minimum_stock' => $this->faker->numberBetween(5, 20),
            'image' => null,
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}