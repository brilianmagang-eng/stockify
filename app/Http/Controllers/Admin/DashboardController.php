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
     * Menampilkan halaman dashboard admin dengan data yang komprehensif.
     */
    public function index()
    {
        // 1. Data untuk Kartu Statistik (Stat Cards)
        // Ini adalah kode Anda yang sudah berfungsi, saya hanya menyesuaikan nama variabel agar lebih jelas.
        $totalProducts = \App\Models\Product::count();
        $totalSuppliers = \App\Models\Supplier::count();
        // Mengubah dari count() menjadi sum('quantity') agar yang dihitung adalah jumlah barang, bukan jumlah transaksinya.
        $totalIncomingItems = \App\Models\StockTransaction::where('type', 'in')->sum('quantity');
        $totalOutgoingItems = \App\Models\StockTransaction::where('type', 'out')->sum('quantity');


        // 2. Data untuk Grafik Stok Kritis
        // Mengambil 5 produk dengan stok terendah untuk ditampilkan di grafik.
        $lowStockProducts = Product::orderBy('stock', 'asc')->take(5)->get(['name', 'stock']);

        // 3. Data untuk Tabel Aktivitas Pengguna Terbaru
        // Mengambil 5 transaksi terakhir beserta relasi ke user dan produk.
        // Eager loading `with()` digunakan agar query lebih efisien.
        $recentActivities = StockTransaction::with(['user', 'product'])->latest()->take(5)->get();

        // Mengirim SEMUA data (yang lama dan yang baru) ke view
        return view('pages.admin.dashboard', compact(
            'totalProducts', 
            'totalSuppliers', 
            'totalIncomingItems', 
            'totalOutgoingItems',
            'lowStockProducts',      // Data baru untuk grafik
            'recentActivities'       // Data baru untuk tabel
        ));
    }
}

