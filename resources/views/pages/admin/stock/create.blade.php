{{-- Menggunakan template utama --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Catat Transaksi Stok Baru</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Catat pergerakan stok baru (masuk atau keluar).</p>
        </div>
        <a href="{{ route('admin.stock.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali ke Riwayat
        </a>
    </div>

    {{-- Konten Form --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">
        <form action="{{ route('admin.stock.store') }}" method="POST">
            @csrf

            {{-- Menampilkan semua error validasi di bagian atas form --}}
            @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Error Validasi!</span> Silakan periksa kembali isian Anda.
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pilih Produk --}}
                <div>
                    <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produk</label>
                    <select id="product_id" name="product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        <option value="" disabled selected>Pilih Produk</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Stok Saat Ini: {{ $product->stock }})
                        </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Tipe Transaksi --}}
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Transaksi</label>
                    <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        <option value="" disabled selected>Pilih Tipe</option>
                        <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Stok Masuk (dari Supplier, Retur, dll)</option>
                        <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Stok Keluar (Penjualan, Rusak, dll)</option>
                    </select>
                </div>

                {{-- Jumlah --}}
                <div>
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required placeholder="Contoh: 50">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                    <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                </div>

                {{-- Catatan --}}
                <div class="md:col-span-2">
                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Contoh: Penerimaan dari Supplier ABC">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex justify-end gap-4">
                <a href="{{ route('admin.stock.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

