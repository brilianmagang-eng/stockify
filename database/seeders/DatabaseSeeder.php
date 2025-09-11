<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributes;
use App\Models\StockTransaction;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin untuk login
        User::factory()->create([
            'name' => 'Dyxxans',
            'email' => 'admin@stockify.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Buat kategori & supplier dulu
        $categories = Category::factory(5)->create();
        $suppliers = Supplier::factory(5)->create();

        // Buat produk untuk setiap kategori & supplier
        $products = Product::factory(20)->create([
            'category_id' => $categories->random()->id,
            'supplier_id' => $suppliers->random()->id,
        ]);

        // Tambahkan atribut untuk setiap produk
        foreach ($products as $product) {
            ProductAttributes::factory(2)->create([
                'product_id' => $product->id
            ]);
        }

        // Tambahkan transaksi stok
        foreach ($products as $product) {
            StockTransaction::factory(3)->create([
                'product_id' => $product->id,
                'user_id' => 1, // Admin user
            ]);
        }
    }
}
