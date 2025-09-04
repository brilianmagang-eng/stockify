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
        // Mengambil data ringkasan seperti di dokumen Stockify [cite: 56]
        $productCount = Product::count(); //[cite: 57]
        $supplierCount = Supplier::count();
        $incomingTransactions = StockTransaction::where('type', 'in')->count(); //[cite: 58]
        $outgoingTransactions = StockTransaction::where('type', 'out')->count(); //[cite: 58]

        return view('pages.admin.dashboard', [
            'productCount' => $productCount,
            'supplierCount' => $supplierCount,
            'incomingTransactions' => $incomingTransactions,
            'outgoingTransactions' => $outgoingTransactions,
        ]);
    }
}