<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk Staff, yang berisi daftar tugas
     * (transaksi yang perlu dikonfirmasi).
     */
    public function index()
    {
        // Ambil semua transaksi yang statusnya 'pending'
        $pendingTasks = StockTransaction::where('status', 'pending')
            ->with(['product', 'user']) // Eager load relasi untuk efisiensi
            ->latest()
            ->paginate(10);

        return view('pages.staff.dashboard', compact('pendingTasks'));
    }
}

