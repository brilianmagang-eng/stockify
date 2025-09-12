<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Manajer Gudang.
     */
    public function index()
    {
        // Data untuk Kartu Peringatan
        $lowStockCount = Product::whereColumn('stock', '<=', 'minimum_stock')->count();
        $incomingTransactionsToday = StockTransaction::where('type', 'in')->whereDate('date', today())->count();
        $outgoingTransactionsToday = StockTransaction::where('type', 'out')->whereDate('date', today())->count();
        $pendingTasksCount = StockTransaction::where('status', 'pending')->count();

        // Data untuk Tabel Produk Stok Rendah
        $lowStockProducts = Product::with('supplier')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->get();

        return view('pages.manager.dashboard', compact(
            'lowStockCount',
            'incomingTransactionsToday',
            'outgoingTransactionsToday',
            'pendingTasksCount',
            'lowStockProducts'
        ));
    }
}