<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;


class StockController extends Controller
{
    public function createIn()
    {
        $products = Product::orderBy('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get(); // Ambil data supplier
        return view('pages.manager.stock.create', [
            'type' => 'in',
            'products' => $products,
            'suppliers' => $suppliers // Kirim data supplier ke view
        ]);
    }

    public function createOut()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('pages.manager.stock.create', [
            'type' => 'out',
            'products' => $products,
            'suppliers' => null // Tidak perlu supplier untuk barang keluar
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'supplier_id' => 'required_if:type,in|nullable|exists:suppliers,id', // Validasi supplier
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return back()->with('error', 'Stock is not sufficient for this transaction.');
        }

        StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'supplier_id' => $request->supplier_id, // Simpan supplier_id
            'type' => $request->type,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'status' => 'completed',
            'notes' => $request->notes,
        ]);

        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        $message = $request->type == 'in' ? 'Incoming stock recorded successfully.' : 'Outgoing stock recorded successfully.';
        
        return redirect()->route('manager.dashboard')->with('success', $message);
    }
    
    // ... method untuk stock opname akan ditambahkan di bawah ...
    /**
     * Menampilkan halaman formulir Stock Opname.
     */
    public function opnameCreate()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('pages.manager.stock.opname', compact('products'));
    }

    /**
     * Menyimpan hasil Stock Opname.
     */
    public function opnameStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'required|string|max:255',
        ]);

        return DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);
            $physicalStock = (int) $request->physical_stock;
            $systemStock = $product->stock;

            $variance = $physicalStock - $systemStock;

            if ($variance == 0) {
                return redirect()->route('manager.stock.opnameCreate')->with('success', 'No changes detected for ' . $product->name . '.');
            }

            // Perbarui stok produk
            $product->stock = $physicalStock;
            $product->save();

            // Catat transaksi penyesuaian (tipe baru 'adjustment')
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'type' => 'adjustment',
                'quantity' => abs($variance),
                'date' => now(),
                'status' => 'completed',
                'notes' => 'Stock Opname: ' . ($variance > 0 ? '+' : '') . $variance . '. ' . $request->notes,
            ]);

            return redirect()->route('manager.stock.opnameCreate')->with('success', 'Stock for ' . $product->name . ' has been adjusted successfully.');
        });
    }
}