@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manager Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Welcome back, {{ Auth::user()->name }}! Here are the operational highlights.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-red-500 dark:text-red-400">Products with Low Stock</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $lowStockCount ?? 0 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Incoming Transactions (Today)</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $incomingTransactionsToday ?? 0 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Outgoing Transactions (Today)</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $outgoingTransactionsToday ?? 0 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-yellow-500 dark:text-yellow-400">Pending Tasks</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $pendingTasksCount ?? 0 }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Low Stock Product Details</h3>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">SKU</th>
                        <th scope="col" class="px-6 py-3">Product Name</th>
                        <th scope="col" class="px-6 py-3">Current Stock</th>
                        <th scope="col" class="px-6 py-3">Minimum Stock</th>
                        <th scope="col" class="px-6 py-3">Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lowStockProducts as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->sku }}</td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4 font-bold text-red-600 dark:text-red-400">{{ $product->stock }}</td>
                        <td class="px-6 py-4">{{ $product->minimum_stock }}</td>
                        <td class="px-6 py-4">{{ $product->supplier->name ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No products with low stock. Great job!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection