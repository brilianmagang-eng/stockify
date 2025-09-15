{{-- Menampilkan semua error validasi di bagian atas form --}}
@if ($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <span class="font-medium">Error</span> Please double check your fields.
    <ul class="mt-1.5 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Nama Produk --}}
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        @error('name')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>
    
    {{-- SKU --}}
    <div>
        <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU (Stock Keeping Unit)</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        @error('sku')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>

    {{-- Kategori --}}
    <div>
        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
        <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <option value="" disabled selected>Select Category</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>

    {{-- Supplier --}}
    <div>
        <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
        <select id="supplier_id" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <option value="" disabled selected>Select Supplier</option>
            @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->name }}
            </option>
            @endforeach
        </select>
        @error('supplier_id')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>
    
    {{-- Harga Beli --}}
    <div>
        <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price (Rp)</label>
        <input type="number" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        @error('purchase_price')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>
    
    {{-- Harga Jual --}}
    <div>
        <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price (Rp)</label>
        <input type="number" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        @error('selling_price')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>
    
    {{-- Stok Awal --}}
    <div>
        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Initial Stock</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '0') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        @error('stock')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>
    
    {{-- Stok Minimum --}}
    <div>
        <label for="minimum_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minimum Stock Level</label>
        <input type="number" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock ?? '0') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        @error('minimum_stock')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>

    {{-- Deskripsi --}}
    <div class="md:col-span-2">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>

    {{-- Upload Gambar --}}
    <div class="md:col-span-2">
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
        <input type="file" id="image" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF (MAX. 2MB).</p>
        @error('image')<p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
    </div>
</div>

