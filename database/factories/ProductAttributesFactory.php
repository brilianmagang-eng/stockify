<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttributes>
 */
class ProductAttributesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'name' => $this->faker->randomElement(['Warna', 'Ukuran']),
            'value' => $this->faker->randomElement(['Merah', 'Biru', 'Hijau', 'XL', 'L', 'M']),
        ];
    }
}
