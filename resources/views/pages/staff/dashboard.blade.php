<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Staff Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Welcome, {{ Auth::user()->name }}! Here are your tasks for today.</p>

        {{-- Contoh daftar tugas untuk Staff --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <h2 class="text-lg font-bold mb-4">Incoming Items to Verify</h2>
                <ul class="list-disc list-inside">
                    <li>PO-001 from Supplier A (50 pcs Smartphone)</li>
                    <li>PO-002 from Supplier B (100 pcs T-Shirt)</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl shadow p-6 dark:bg-gray-800">
                <h2 class="text-lg font-bold mb-4">Outgoing Items to Prepare</h2>
                 <ul class="list-disc list-inside">
                    <li>SO-001 for Customer X (2 pcs Headphones)</li>
                    <li>SO-002 for Customer Y (5 pcs T-Shirt)</li>
                </ul>
            </div>
        </div>
    </div>
</x-layouts.app>
