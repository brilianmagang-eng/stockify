<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Menangani permintaan pencarian dan menampilkan hasilnya.
     */
    public function results(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
                           ->orWhere('sku', 'LIKE', "%{$query}%")
                           ->paginate(10);

        return view('pages.search.results', compact('products', 'query'));
    }
}