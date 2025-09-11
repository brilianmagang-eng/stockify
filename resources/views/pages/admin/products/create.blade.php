{{-- Menggunakan template utama --}}
@extends('layouts.app')

{{-- Mengisi bagian konten utama --}}
@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Add New Product</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Fill in the details to add a new product to the inventory.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
            <i class="bi bi-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>

    {{-- Konten Form --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">
        {{-- Form ini akan mengirim data ke method 'store' di ProductController --}}
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Memanggil semua field input dari file partial --}}
            @include('pages.admin.products.partials.form-fields')

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex justify-end gap-4">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

