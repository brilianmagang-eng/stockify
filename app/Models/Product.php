<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sku', 'description', 'purchase_price', 'selling_price',
        'stock', 'minimum_stock', 'image', 'category_id', 'supplier_id'
    ];

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke Atribut Produk
    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class);
    }

    // Relasi ke Transaksi Stok
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}
