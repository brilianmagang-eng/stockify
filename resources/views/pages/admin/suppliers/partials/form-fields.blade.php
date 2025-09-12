{{-- Menampilkan semua error validasi di bagian atas form --}}
@if ($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <span class="font-medium">Validation Error!</span> Please check the fields below for details.
    <ul class="mt-1.5 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Nama Supplier --}}
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $supplier->name ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email', $supplier->email ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>

    {{-- Nomor Telepon --}}
    <div class="md:col-span-2">
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $supplier->phone ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>
    
    {{-- Alamat --}}
    <div class="md:col-span-2">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
        <textarea id="address" name="address" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('address', $supplier->address ?? '') }}</textarea>
    </div>
</div>

