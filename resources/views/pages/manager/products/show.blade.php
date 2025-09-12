@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Product Detail</h1>
        <a href="{{ route('manager.products.index') }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-sm px-5 py-2.5">
            Back to List
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
            </div>
            
            <div class="md:col-span-2 space-y-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $product->sku }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="text-gray-500 dark:text-gray-400">Category:</div>
                    <div class="text-gray-900 dark:text-white font-semibold">{{ $product->category->name ?? 'N/A' }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Supplier:</div>
                    <div class="text-gray-900 dark:text-white font-semibold">{{ $product->supplier->name ?? 'N/A' }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Purchase Price:</div>
                    <div class="text-gray-900 dark:text-white font-semibold">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Selling Price:</div>
                    <div class="text-gray-900 dark:text-white font-semibold">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Current Stock:</div>
                    <div class="text-gray-900 dark:text-white font-semibold">{{ $product->stock }} pcs</div>
                    <div class="text-gray-500 dark:text-gray-400">Minimum Stock:</div>
                    <div class="text-gray-900 dark:text-white font-semibold">{{ $product->minimum_stock }} pcs</div>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Description</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        {{ $product->description ?? 'No description available.' }}
                    </p>
                </div>
                
                <div class="pt-4">
                    <a href="{{ route('manager.products.edit', $product) }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Edit Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection