<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffStockController extends Controller
{
    /**
     * Menampilkan halaman detail untuk konfirmasi transaksi.
     */
    public function showConfirm(StockTransaction $transaction)
    {
        // Pastikan hanya transaksi yang masih pending yang bisa diakses
        if ($transaction->status !== 'pending') {
            return redirect()->route('staff.dashboard')->with('error', 'Transaksi ini sudah tidak memerlukan konfirmasi.');
        }

        return view('pages.staff.stock.confirm', compact('transaction'));
    }

    /**
     * Memproses konfirmasi transaksi.
     * Ini akan mengubah status dan memperbarui stok produk.
     */
    public function processConfirm(Request $request, StockTransaction $transaction)
    {
        // Validasi ulang untuk keamanan
        if ($transaction->status !== 'pending') {
            return redirect()->route('staff.dashboard')->with('error', 'Transaksi ini sudah diproses sebelumnya.');
        }

        $product = $transaction->product;

        // Validasi khusus untuk barang keluar, pastikan stok masih cukup
        if ($transaction->type == 'out' && $product->stock < $transaction->quantity) {
            // Jika stok tidak cukup, batalkan transaksi
            $transaction->update(['status' => 'cancelled', 'notes' => 'Dibatalkan oleh staff karena stok tidak mencukupi.']);
            return redirect()->route('staff.dashboard')->with('error', 'Stok tidak mencukupi! Transaksi dibatalkan.');
        }

        try {
            DB::transaction(function () use ($transaction, $product) {
                // 1. Update status transaksi menjadi 'completed'
                $transaction->update(['status' => 'completed']);

                // 2. Update jumlah stok di tabel products
                if ($transaction->type == 'in') {
                    $product->increment('stock', $transaction->quantity);
                } else { // type == 'out'
                    $product->decrement('stock', $transaction->quantity);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses konfirmasi: ' . $e->getMessage());
        }

        return redirect()->route('staff.dashboard')->with('success', 'Transaksi berhasil dikonfirmasi.');
    }
}

