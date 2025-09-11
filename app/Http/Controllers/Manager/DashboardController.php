<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     * Logika ini mirip dengan mengambil data ringkasan di React.
     */
    public function index()
    {
        // Untuk Kartu Peringatan
        $lowStockCount = Product::whereColumn('stock', '<=', 'minimum_stock')->count();
        $incomingTransactionsToday = StockTransaction::where('type', 'in')->whereDate('date', today())->count();
        $outgoingTransactionsToday = StockTransaction::where('type', 'out')->whereDate('date', today())->count();
        $pendingTasksCount = StockTransaction::where('status', 'pending')->count();

        // Untuk Tabel Produk Stok Rendah
        $lowStockProducts = Product::with('supplier')->whereColumn('stock', '<=', 'minimum_stock')->get();

        return view('pages.manager.dashboard', compact(
            'lowStockCount',
            'incomingTransactionsToday',
            'outgoingTransactionsToday',
            'pendingTasksCount',
            'lowStockProducts'
        ));
    }
}