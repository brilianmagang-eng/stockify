@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Add New Product</h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form action="{{ route('manager.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Memanggil semua field input dari file partial. Pastikan path ini benar. --}}
            {{-- Jika Anda menyalinnya, seharusnya lokasinya sudah benar. --}}
            @include('pages.manager.products.partials.form-fields')

            {{-- Tombol Aksi --}}
            <div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save Product</button>
                <a href="{{ route('manager.products.index') }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection