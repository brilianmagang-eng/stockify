<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    /**
     * Menampilkan halaman riwayat transaksi stok.
     */
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'user'])
            ->latest()
            ->paginate(15);
            
        return view('pages.admin.stock.index', compact('transactions'));
    }

    /**
     * Menampilkan form untuk membuat transaksi stok baru.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('pages.admin.stock.create', compact('products'));
    }

    /**
     * Menyimpan transaksi stok baru (barang masuk/keluar).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi khusus untuk barang keluar
        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi. Stok saat ini: ' . $product->stock)
                ->withInput();
        }

        try {
            // Menggunakan DB Transaction untuk memastikan integritas data
            DB::transaction(function () use ($request, $product) {
                // 1. Catat transaksi di tabel stock_transactions
                StockTransaction::create([
                    'product_id' => $request->product_id,
                    'user_id' => Auth::id(), // ID admin yang sedang login
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'date' => $request->date,
                    'notes' => $request->notes,
                ]);

                // 2. Update jumlah stok di tabel products
                if ($request->type == 'in') {
                    $product->increment('stock', $request->quantity);
                } else {
                    $product->decrement('stock', $request->quantity);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.stock.index')->with('success', 'Transaksi stok berhasil dicatat.');
    }
}

