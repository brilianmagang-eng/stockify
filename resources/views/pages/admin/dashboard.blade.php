{{-- Memberitahu Laravel untuk menggunakan template dari layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Mendefinisikan bagian yang akan mengisi @yield('content') di dalam layout --}}
@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Admin Dashboard</h1>
        {{-- Mengambil nama pengguna yang sedang login --}}
        <p class="text-gray-600 dark:text-gray-300 mb-6">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>

        {{-- Kartu Statistik (data dikirim dari DashboardController) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            
            <!-- Kartu Total Produk -->
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Total Products</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{ $productCount ?? '0' }}</h3>
            </div>
            
            <!-- Kartu Total Supplier -->
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Total Suppliers</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{ $supplierCount ?? '0' }}</h3>
            </div>
            
            <!-- Kartu Barang Masuk -->
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Incoming Items</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{ $incomingTransactions ?? '0' }}</h3>
            </div>
            
            <!-- Kartu Barang Keluar -->
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Outgoing Items</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{ $outgoingTransactions ?? '0' }}</h3>
            </div>

        </div>

        {{-- Anda bisa menambahkan konten lain di sini, seperti grafik atau tabel ringkasan --}}

    </div>
@endsection
