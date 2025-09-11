<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Untuk contoh ini, kita asumsikan 'pending' adalah tugas untuk staff
        // Dalam aplikasi nyata, mungkin ada tabel 'tasks' terpisah
        $incomingTasks = StockTransaction::where('type', 'in')->where('status', 'pending')->latest()->get();
        $outgoingTasks = StockTransaction::where('type', 'out')->where('status', 'pending')->latest()->get();

        return view('pages.staff.dashboard', compact('incomingTasks', 'outgoingTasks'));
    }
}
