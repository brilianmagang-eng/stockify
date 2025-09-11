<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Manager Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Welcome back, {{ Auth::user()->name }}! Here's the warehouse status.</p>

        {{-- Contoh stats cards untuk Manager --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Low Stock Items</p>
                <h3 class="text-2xl font-bold mt-1 text-red-600 dark:text-red-500">{{-- $lowStockCount --}}0</h3>
            </div>
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Items In Today</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{-- $itemsInToday --}}0</h3>
            </div>
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <p class="text-gray-500 text-sm dark:text-gray-400">Items Out Today</p>
                <h3 class="text-2xl font-bold mt-1 dark:text-white">{{-- $itemsOutToday --}}0</h3>
            </div>
        </div>

        {{-- Tabel atau konten lainnya untuk manajer bisa ditambahkan di sini --}}
        <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
            <h2 class="text-lg font-bold mb-4">Recent Stock Movements</h2>
            <p>Recent transactions table will be here...</p>
        </div>
    </div>
</x-layouts.app>
