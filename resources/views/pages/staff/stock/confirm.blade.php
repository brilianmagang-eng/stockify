@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Konfirmasi Transaksi</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Mohon periksa detail di bawah ini sebelum melakukan konfirmasi.</p>
        </div>
        <a href="{{ route('staff.dashboard') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali ke Daftar Tugas
        </a>
    </div>

    {{-- Konten Utama --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800 max-w-4xl mx-auto">
        
        @include('pages.admin.partials.session-messages')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Detail Transaksi --}}
            <div>
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white border-b pb-2">Detail Transaksi</h2>
                <div class="space-y-3 text-sm">
                    {{-- MENGGUNAKAN FLEXBOX UNTUK MERAPIKAN --}}
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">ID Transaksi:</span>
                        <span class="font-medium text-gray-900 dark:text-white">#{{ $transaction->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Tanggal Dibuat:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $transaction->date->format('d F Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Dibuat Oleh:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $transaction->user->name }} ({{ ucfirst($transaction->user->role) }})</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400">Tipe Transaksi:</span>
                        <span>
                            @if($transaction->type == 'in')
                                <span class="bg-blue-100 text-blue-800 font-medium px-3 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    <i class="bi bi-box-arrow-in-down mr-1"></i> Barang Masuk
                                </span>
                            @else
                                <span class="bg-orange-100 text-orange-800 font-medium px-3 py-1 rounded-full dark:bg-orange-900 dark:text-orange-300">
                                    <i class="bi bi-box-arrow-up mr-1"></i> Barang Keluar
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-500 dark:text-gray-400">Catatan:</span>
                        <p class="mt-1 p-2 bg-gray-50 rounded-md text-gray-700 dark:bg-gray-700 dark:text-gray-300">{{ $transaction->notes ?: '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Detail Produk --}}
            <div>
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white border-b pb-2">Detail Produk</h2>
                <div class="space-y-3 text-sm">
                    {{-- MENGGUNAKAN FLEXBOX UNTUK MERAPIKAN --}}
                     <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Nama Produk:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $transaction->product->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">SKU:</span>
                        <span class="font-mono text-gray-900 dark:text-white">{{ $transaction->product->sku }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Stok Saat Ini:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $transaction->product->stock }}</span>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="flex justify-between text-base">
                        <span class="text-gray-500 dark:text-gray-400">Jumlah Transaksi:</span>
                        <span class="font-bold {{ $transaction->type == 'in' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $transaction->type == 'in' ? '+' : '-' }}{{ $transaction->quantity }}
                        </span>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="flex justify-between text-base">
                        <span class="text-gray-500 dark:text-gray-400">Stok Setelah Konfirmasi:</span>
                        <span class="font-bold text-blue-600 dark:text-blue-400">
                            {{ $transaction->type == 'in' ? ($transaction->product->stock + $transaction->quantity) : ($transaction->product->stock - $transaction->quantity) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aksi Konfirmasi --}}
        <div class="mt-8 pt-6 border-t dark:border-gray-700">
            <p class="text-sm text-center text-gray-600 dark:text-gray-400 mb-4">
                Dengan menekan tombol di bawah, Anda mengonfirmasi bahwa transaksi ini telah diverifikasi dan jumlah stok akan diperbarui sesuai data di atas.
            </p>
            <form action="{{ route('staff.stock.processConfirm', $transaction) }}" method="POST" class="text-center">
                @csrf
                <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                    <i class="bi bi-check-circle-fill mr-2"></i>
                    Konfirmasi Transaksi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

