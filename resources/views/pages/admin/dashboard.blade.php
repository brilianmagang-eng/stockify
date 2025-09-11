@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Baris Judul dan Sambutan --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Admin Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
    </div>

    {{-- Grid untuk Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Products Card -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalProducts ?? 0 }}</p>
        </div>
        <!-- Total Suppliers Card -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Suppliers</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalSuppliers ?? 0 }}</p>
        </div>
        <!-- Incoming Items Card -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Incoming Items (All Time)</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalIncomingItems ?? 0 }}</p>
        </div>
        <!-- Outgoing Items Card -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Outgoing Items (All Time)</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalOutgoingItems ?? 0 }}</p>
        </div>
    </div>

    {{-- Grid untuk Grafik dan Aktivitas Terbaru --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Kolom untuk Grafik Stok Kritis --}}
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Low Stock Products</h3>
            @if(isset($lowStockProducts) && $lowStockProducts->count() > 0)
                <div class="h-80">
                    <canvas id="lowStockChart"></canvas>
                </div>
            @else
                <div class="flex items-center justify-center h-80">
                    <p class="text-gray-500 dark:text-gray-400">All product stocks are safe.</p>
                </div>
            @endif
        </div>

        {{-- Kolom untuk Aktivitas Pengguna Terbaru --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activities</h3>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($recentActivities as $activity)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <span class="w-8 h-8 rounded-full flex items-center justify-center {{ $activity->type == 'in' ? 'bg-green-100 dark:bg-green-900' : 'bg-red-100 dark:bg-red-900' }}">
                                    @if($activity->type == 'in')
                                        <i class="bi bi-box-arrow-in-down text-green-600 dark:text-green-300"></i>
                                    @else
                                        <i class="bi bi-box-arrow-up text-red-600 dark:text-red-300"></i>
                                    @endif
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $activity->user->name ?? 'System' }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $activity->type == 'in' ? 'Recorded item in:' : 'Recorded item out:' }} {{ $activity->product->name ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $activity->quantity }} pcs
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="py-3 sm:py-4 text-center text-gray-500 dark:text-gray-400">
                        No recent activities.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Chart.js (hanya akan berjalan jika ada data) --}}
@if(isset($lowStockProducts) && $lowStockProducts->count() > 0)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('lowStockChart').getContext('2d');
        const lowStockData = @json($lowStockProducts);

        const productNames = lowStockData.map(product => product.name);
        const productStocks = lowStockData.map(product => product.stock);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Current Stock',
                    data: productStocks,
                    backgroundColor: 'rgba(239, 68, 68, 0.5)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
@endif
@endsection