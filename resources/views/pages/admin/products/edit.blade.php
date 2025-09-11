{{-- Menggunakan template utama --}}
@extends('layouts.app')

{{-- Mengisi bagian konten utama --}}
@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Product</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Update the product details below.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
            <i class="bi bi-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>

    {{-- Konten Form --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">
        {{-- Form ini akan mengirim data ke method 'update' di ProductController --}}
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Memberitahu Laravel bahwa ini adalah request UPDATE --}}
            @method('PUT')
            
            {{-- Menampilkan gambar produk saat ini --}}
            @if($product->image)
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Image</label>
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover rounded-md">
                </div>
            @endif

            {{-- Memanggil semua field input dari file partial.
                 Karena variabel $product ada, semua field akan terisi otomatis. --}}
            @include('pages.admin.products.partials.form-fields')

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex justify-end gap-4">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

