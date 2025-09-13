@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Product Detail</h1>
        <a href="{{ route('manager.products.index') }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-sm px-5 py-2.5">
            Back to List
        </a>
    </div>

    @include('layouts.partials.session-messages')

    {{-- BAGIAN DETAIL PRODUK UTAMA --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Product Image -->
            <div class="md:col-span-1">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
            </div>
            
            <!-- Product Details -->
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

    {{-- BAGIAN BARU: PRODUCT ATTRIBUTES --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Product Attributes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Form untuk menambah atribut baru --}}
            <div>
                <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">Add New Attribute</h4>
                <form action="{{ route('manager.products.attributes.store', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium">Attribute Name (e.g., Color)</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="value" class="block mb-2 text-sm font-medium">Value (e.g., Red)</label>
                        <input type="text" name="value" id="value" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5">Add Attribute</button>
                </form>
            </div>
            {{-- Daftar atribut yang sudah ada --}}
            <div>
                <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">Existing Attributes</h4>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($product->attributes as $attribute)
                    <li class="py-2 flex justify-between items-center">
                        <div>
                            <span class="font-semibold">{{ $attribute->name }}:</span> {{ $attribute->value }}
                        </div>
                        <form action="{{ route('manager.attributes.destroy', $attribute) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Delete</button>
                        </form>
                    </li>
                    @empty
                    <li class="py-2 text-gray-500">No attributes added yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection