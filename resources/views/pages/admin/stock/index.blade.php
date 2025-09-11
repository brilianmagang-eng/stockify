{{-- Menggunakan template utama --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Stok</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Lihat riwayat transaksi dan kelola level stok.</p>
        </div>
        <a href="{{ route('admin.stock.create') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
            <i class="bi bi-plus-circle mr-2"></i>Catat Transaksi Baru
        </a>
    </div>

    {{-- Konten Utama (Tabel Transaksi) --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">

        <!-- Notifikasi Pesan Sukses/Error -->
        @include('pages.admin.partials.session-messages')

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Produk</th>
                        <th scope="col" class="px-6 py-3">Tipe</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Pengguna</th>
                        <th scope="col" class="px-6 py-3">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $transaction->date->format('d M Y') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $transaction->product->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($transaction->type == 'in')
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    MASUK
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    KELUAR
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold {{ $transaction->type == 'in' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type == 'in' ? '+' : '-' }}{{ $transaction->quantity }}
                        </td>
                        <td class="px-6 py-4">{{ $transaction->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ Str::limit($transaction->notes, 40) ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada transaksi stok.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Link Paginasi --}}
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection

