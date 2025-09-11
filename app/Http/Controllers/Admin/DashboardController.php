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
    $productCount = \App\Models\Product::count();
    $supplierCount = \App\Models\Supplier::count();
    $incomingTransactions = \App\Models\StockTransaction::where('type', 'in')->count();
    $outgoingTransactions = \App\Models\StockTransaction::where('type', 'out')->count();

    return view('pages.admin.dashboard', compact(
        'productCount', 
        'supplierCount', 
        'incomingTransactions', 
        'outgoingTransactions'
    ));
}
}