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
        // 1. Data untuk Kartu Peringatan (Alert Cards)
        // Menghitung jumlah produk yang stoknya di bawah atau sama dengan batas minimum.
        $lowStockCount = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

        // Menghitung jumlah TRANSAKSI (bukan total unit) yang masuk hari ini.
        $incomingTransactionsToday = StockTransaction::where('type', 'in')->whereDate('date', today())->count();
        
        // Menghitung jumlah TRANSAKSI keluar hari ini.
        $outgoingTransactionsToday = StockTransaction::where('type', 'out')->whereDate('date', today())->count();
        
        // Menghitung jumlah transaksi yang statusnya masih 'pending'.
        $pendingTasksCount = StockTransaction::where('status', 'pending')->count();

        // 2. Data untuk Tabel Produk Stok Rendah
        // Mengambil daftar lengkap produk yang stoknya menipis beserta data suppliernya.
        $lowStockProducts = Product::with('supplier')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->get();

        // Mengirim semua data ke view
        return view('pages.manager.dashboard', compact(
            'lowStockCount',
            'incomingTransactionsToday',
            'outgoingTransactionsToday',
            'pendingTasksCount',
            'lowStockProducts'
        ));
    }
}

