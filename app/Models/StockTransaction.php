<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id', 'supplier_id', 'type', 'quantity', 'date', 'status', 'notes'
    ];

    /**
     * The attributes that should be cast.
     * Ini akan mengubah kolom 'date' menjadi objek Carbon secara otomatis.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

