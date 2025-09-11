<h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Laporan Transaksi</h3>
<form method="GET" action="{{ route('admin.reports.index') }}" class="mb-6">
    <input type="hidden" name="tab" value="transactions">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-white dark:bg-gray-900 rounded-lg">
        <div>
            <label for="start_date" class="text-sm">Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div>
            <label for="end_date" class="text-sm">Tanggal Akhir</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div>
            <label for="type" class="text-sm">Tipe</label>
            <select name="type" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                <option value="">Semua</option>
                <option value="in" @selected(request('type') == 'in')>Masuk</option>
                <option value="out" @selected(request('type') == 'out')>Keluar</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Filter</button>
        </div>
    </div>
</form>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Tanggal</th><th scope="col" class="px-6 py-3">Produk</th><th scope="col" class="px-6 py-3">Tipe</th><th scope="col" class="px-6 py-3">Jumlah</th><th scope="col" class="px-6 py-3">Oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactionReports as $trx)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</td>
                <td class="px-6 py-4">{{ $trx->product->name ?? 'N/A' }}</td>
                <td class="px-6 py-4">@if($trx->type == 'in') Masuk @else Keluar @endif</td>
                <td class="px-6 py-4">{{ $trx->quantity }}</td>
                <td class="px-6 py-4">{{ $trx->user->name ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center p-4">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>