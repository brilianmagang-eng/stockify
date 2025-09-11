<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    // Menampilkan form untuk mencatat BARANG MASUK
    public function createIn()
    {
        $products = Product::orderBy('name')->get();
        return view('pages.manager.stock.create-in', compact('products'));
    }

    // Menyimpan data BARANG MASUK
    public function storeIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Catat transaksi
            StockTransaction::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'type' => 'in',
                'quantity' => $request->quantity,
                'notes' => $request->notes,
                'date' => now(),
                'status' => 'completed', // Manajer langsung complete
            ]);

            // 2. Update stok produk
            $product = Product::find($request->product_id);
            $product->increment('stock', $request->quantity);
        });

        return redirect()->route('manager.dashboard')->with('success', 'Stock-in recorded successfully.');
    }
    
    // Menampilkan form untuk mencatat BARANG KELUAR
    public function createOut()
    {
        $products = Product::orderBy('name')->get();
        return view('pages.manager.stock.create-out', compact('products'));
    }

    // Menyimpan data BARANG KELUAR
    public function storeOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi tambahan agar stok tidak minus
        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock. Available: ' . $product->stock])->withInput();
        }

        DB::transaction(function () use ($request, $product) {
            // 1. Catat transaksi
            StockTransaction::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'type' => 'out',
                'quantity' => $request->quantity,
                'notes' => $request->notes,
                'date' => now(),
                'status' => 'completed',
            ]);

            // 2. Update stok produk
            $product->decrement('stock', $request->quantity);
        });

        return redirect()->route('manager.dashboard')->with('success', 'Stock-out recorded successfully.');
    }
}
