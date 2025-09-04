<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stockify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
        </nav>

    <main>
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight">Dashboard Administrator Stockify</h1>
            <p class="mt-4 text-lg text-secondary-text">Kelola semua aktivitas penting dari sini.</p>
        </div>

        {{-- Menampilkan data ringkasan dari controller --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">
            <div class="p-6 bg-white border rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold">Total Produk</h3>
                <p class="text-3xl font-bold">{{ $productCount }}</p>
            </div>
            <div class="p-6 bg-white border rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold">Total Supplier</h3>
                <p class="text-3xl font-bold">{{ $supplierCount }}</p>
            </div>
            <div class="p-6 bg-white border rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold">Barang Masuk</h3>
                <p class="text-3xl font-bold">{{ $incomingTransactions }}</p>
            </div>
            <div class="p-6 bg-white border rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold">Barang Keluar</h3>
                <p class="text-3xl font-bold">{{ $outgoingTransactions }}</p>
            </div>
        </div>

        {{-- Mengadaptasi komponen form dari dashboard.tsx --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            
            {{-- ADAPTASI DARI "VerifyPartnerForm" MENJADI "Tambah Supplier" --}}
            <div class="p-6 bg-white border rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold mb-2">Tambah Supplier Baru</h2>
                <p class="text-sm text-gray-500 mb-4">Masukkan data supplier untuk mencatat pemasok barang. [cite: 46, 71]</p>
                <form action="{{-- route('admin.suppliers.store') --}}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block font-medium">Nama Supplier</label>
                        <input type="text" id="name" name="name" required class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="contact" class="block font-medium">Kontak</label>
                        <input type="text" id="contact" name="contact" required class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Supplier</button>
                </form>
            </div>

            {{-- ADAPTASI DARI "PayIncentiveForm" MENJADI "Catat Barang Masuk" --}}
            <div class="p-6 bg-white border rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold mb-2">Catat Barang Masuk</h2>
                <p class="text-sm text-gray-500 mb-4">Gunakan form ini untuk mencatat penerimaan barang dari supplier. [cite: 27, 42, 90]</p>
                <form action="{{-- route('admin.stock.in') --}}" method="POST" class="space-y-4">
                    @csrf
                     <div>
                        <label for="product_id" class="block font-medium">Pilih Produk</label>
                        {{-- Di sini Anda akan looping data produk dari database --}}
                        <select id="product_id" name="product_id" class="w-full p-2 border border-gray-300 rounded-md shadow-sm"></select>
                    </div>
                    <div>
                        <label for="quantity" class="block font-medium">Jumlah Masuk</label>
                        <input type="number" id="quantity" name="quantity" min="1" required class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5">Catat Penerimaan</button>
                </form>
            </div>

        </div>
    </div>
    </main>

    <footer>
        </footer>
</body>
</html>