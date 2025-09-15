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
            ->latest('date')
            ->paginate(10); // Mengambil 10 tugas per halaman

        return view('pages.staff.dashboard', compact('pendingTasks'));
    }

    /**
     * Mengubah status tugas dari 'pending' menjadi 'completed' dan memperbarui stok.
     * Method ini akan dipanggil saat staff menekan tombol konfirmasi.
     */
    public function updateStatus(StockTransaction $transaction)
    {
        // Validasi untuk memastikan transaksi memang ada dan pending
        if ($transaction && $transaction->status === 'pending') {
            
            // Logika untuk mengubah stok HANYA jika tugas dikonfirmasi
            if ($transaction->type == 'in') {
                $transaction->product->increment('stock', $transaction->quantity);
            } elseif ($transaction->type == 'out') {
                $product = $transaction->product;
                // Periksa apakah stok mencukupi sebelum mengurangi
                if ($product->stock < $transaction->quantity) {
                    return redirect()->route('staff.dashboard')->with('error', 'Failed, not enough product stock for this transaction.');
                }
                $product->decrement('stock', $transaction->quantity);
            }
            
            // Ubah status menjadi 'completed'
            $transaction->status = 'completed';
            $transaction->save();

            // Kirim pesan sukses kembali ke dashboard staff
            return redirect()->route('staff.dashboard')->with('success', 'Task has been completed successfully.');
        }

        // Jika transaksi tidak ditemukan atau statusnya bukan pending
        return redirect()->route('staff.dashboard')->with('error', 'Task could not be updated or was not found.');
    }
}