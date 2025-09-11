<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hanya menampilkan daftar tugas yang perlu dikerjakan
        $pendingTasks = StockTransaction::with('product')
            ->where('status', 'pending')
            ->latest('date')
            ->get();

        return view('pages.staff.dashboard', compact('pendingTasks'));
    }
}
