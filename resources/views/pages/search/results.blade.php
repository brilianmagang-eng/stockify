@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Baris Judul dan Keterangan Pencarian --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Search Results</h1>
        <p class="text-gray-600 dark:text-gray-400">Showing results for: <span class="font-semibold">"{{ $query }}"</span></p>
    </div>

    {{-- Tabel Hasil Pencarian --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Product Name</th>
                        <th scope="col" class="px-6 py-3">SKU</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Current Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{-- Buat nama produk bisa diklik untuk melihat detail --}}
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.products.show', $product) }}" class="hover:underline">{{ $product->name }}</a>
                            @else
                                <a href="{{ route('manager.products.show', $product) }}" class="hover:underline">{{ $product->name }}</a>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $product->sku }}</td>
                        <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No products found matching your search criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Link Paginasi (jika hasil pencarian lebih dari 10) --}}
        <div class="mt-6">
            {{ $products->appends(['query' => $query])->links() }}
        </div>
    </div>
</div>
@endsection