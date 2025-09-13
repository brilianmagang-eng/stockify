<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Menyimpan atribut baru untuk sebuah produk.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $product->attributes()->create([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return back()->with('success', 'Attribute added successfully.');
    }

    /**
     * Menghapus sebuah atribut produk.
     */
    public function destroy(ProductAttributes $attribute)
    {
        $attribute->delete();
        return back()->with('success', 'Attribute deleted successfully.');
    }
}