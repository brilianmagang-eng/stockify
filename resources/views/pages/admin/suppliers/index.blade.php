{{-- Menggunakan template utama --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Supplier Management</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Manage all supplier data from this page.</p>
        </div>
        <a href="{{ route('admin.suppliers.create') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
            <i class="bi bi-plus-circle mr-2"></i>Add New Supplier
        </a>
    </div>

    {{-- Konten Utama (Tabel Supplier) --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">

        <!-- Notifikasi Pesan Sukses/Error -->
        @include('pages.admin.partials.session-messages')

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Supplier Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $supplier->name }}</td>
                        <td class="px-6 py-4">{{ $supplier->email ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $supplier->phone ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ Str::limit($supplier->address, 50) ?? 'N/A' }}</td>
                        <td class="px-6 py-4 flex items-center gap-4">
                            <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No suppliers found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Link Paginasi --}}
        <div class="mt-6">
            {{ $suppliers->links() }}
        </div>

    </div>
</div>
@endsection

