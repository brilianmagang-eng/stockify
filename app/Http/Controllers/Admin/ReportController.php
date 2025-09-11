<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $stockReports = Product::with('category', 'supplier')->orderBy('stock', 'asc')->get();

        $transactionQuery = StockTransaction::with('product', 'user')->latest('date');
        if ($request->filled('start_date')) $transactionQuery->whereDate('date', '>=', $request->start_date);
        if ($request->filled('end_date')) $transactionQuery->whereDate('date', '<=', $request->end_date);
        if ($request->filled('type')) $transactionQuery->where('type', $request->type);
        $transactionReports = $transactionQuery->get();

        $userActivityQuery = StockTransaction::with('product', 'user')->latest();
        if ($request->filled('user_id')) $userActivityQuery->where('user_id', $request->user_id);
        if ($request->filled('activity_start_date')) $userActivityQuery->whereDate('created_at', '>=', $request->activity_start_date);
        if ($request->filled('activity_end_date')) $userActivityQuery->whereDate('created_at', '<=', $request->activity_end_date);
        $userActivityReports = $userActivityQuery->get();
        
        $users = User::all();

        // --- PERBAIKAN DI SINI ---
        return view('pages.admin.reports.index', compact('stockReports', 'transactionReports', 'userActivityReports', 'users'));
    }
}