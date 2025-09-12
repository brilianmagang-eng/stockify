@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Tugas</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Berikut adalah daftar transaksi yang memerlukan konfirmasi Anda.</p>
        </div>
    </div>

    {{-- Konten Utama (Tabel Tugas) --}}
    <div class="bg-white rounded-xl shadow-md p-6 dark:bg-gray-800">

        @include('pages.admin.partials.session-messages')

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Tipe</th>
                        <th scope="col" class="px-6 py-3">Produk</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Pembuat</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingTasks as $task)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $task->date->format('d F Y') }}</td>
                        <td class="px-6 py-4">
                            @if($task->type == 'in')
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    <i class="bi bi-box-arrow-in-down mr-1"></i> Barang Masuk
                                </span>
                            @else
                                <span class="bg-orange-100 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                                    <i class="bi bi-box-arrow-up mr-1"></i> Barang Keluar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $task->product->name }}
                        </td>
                        <td class="px-6 py-4 font-bold">{{ $task->quantity }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $task->user->name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('staff.stock.confirm', $task) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Lihat & Konfirmasi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada tugas yang perlu dikonfirmasi saat ini. Kerja bagus!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $pendingTasks->links() }}
        </div>
    </div>
</div>
@endsection

