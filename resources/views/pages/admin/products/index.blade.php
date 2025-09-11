{{-- Menggunakan template utama dari layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Mengisi bagian konten utama --}}
@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Product Management</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Manage all product data from this page.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
            <i class="bi bi-plus-circle mr-2"></i>Add New Product
        </a>
    </div>

    {{-- Konten Utama (Tabel Produk) --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">

        <!-- Notifikasi Pesan Sukses/Error -->
        @include('pages.admin.partials.session-messages')

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3">SKU</th>
                        <th scope="col" class="px-6 py-3">Product Name</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Supplier</th>
                        <th scope="col" class="px-6 py-3">Selling Price</th>
                        <th scope="col" class="px-6 py-3">Stock</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <img class="h-12 w-12 object-cover rounded-md" src="{{ $product->image ? Storage::url($product->image) : 'https://placehold.co/100x100/e2e8f0/e2e8f0' }}" alt="{{ $product->name }}">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->sku }}</td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $product->supplier->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            {{-- Memberi tanda jika stok di bawah minimum --}}
                            <span class="font-bold {{ $product->stock <= $product->minimum_stock ? 'text-red-500' : 'text-green-500' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex items-center gap-4">
                            <a href="{{ route('admin.products.edit', $product) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Link Paginasi --}}
        <div class="mt-6">
            {{ $products->links() }}
        </div>

    </div>
</div>
@endsection

