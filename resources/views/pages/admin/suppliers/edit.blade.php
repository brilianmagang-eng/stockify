@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Supplier</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Update the supplier details below.</p>
        </div>
        <a href="{{ route('admin.suppliers.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
            <i class="bi bi-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>

    {{-- Konten Form --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">
        <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Memanggil semua field input dari file partial --}}
            @include('pages.admin.suppliers.partials.form-fields')

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex justify-end gap-4">
                <a href="{{ route('admin.suppliers.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Update Supplier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
