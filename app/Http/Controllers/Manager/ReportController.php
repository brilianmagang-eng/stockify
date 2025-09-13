<?php
    namespace App\Http\Controllers\Manager;

    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\StockTransaction;
    use Illuminate\Http\Request;

    class ReportController extends Controller
    {
        /**
         * Menampilkan halaman laporan untuk Manajer.
         */
        public function index(Request $request)
        {
            // Data untuk Laporan Stok Barang
            $stockReports = Product::with('category', 'supplier')->orderBy('stock', 'asc')->get();

            // Data untuk Laporan Transaksi
            $transactionQuery = StockTransaction::with('product', 'user')->latest('date');
            if ($request->filled('start_date')) $transactionQuery->whereDate('date', '>=', $request->start_date);
            if ($request->filled('end_date')) $transactionQuery->whereDate('date', '<=', $request->end_date);
            if ($request->filled('type')) $transactionQuery->where('type', $request->type);
            $transactionReports = $transactionQuery->get();

            return view('pages.manager.reports.index', compact('stockReports', 'transactionReports'));
        }
    }
    
