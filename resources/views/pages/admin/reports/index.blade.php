@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Laporan</h1>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="report-tab" data-tabs-toggle="#report-tab-content" role="tablist">
            <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2 rounded-t-lg" id="stock-tab" data-tabs-target="#stock" type="button" role="tab" aria-controls="stock" aria-selected="true">Stok Barang</button></li>
            <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2" id="transactions-tab" data-tabs-target="#transactions" type="button" role="tab" aria-controls="transactions" aria-selected="false">Transaksi</button></li>
            <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2" id="activity-tab" data-tabs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">Aktivitas Pengguna</button></li>
        </ul>
    </div>
    <div id="report-tab-content">
        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="stock" role="tabpanel" aria-labelledby="stock-tab">
            {{-- --- PERBAIKAN DI SINI --- --}}
            @include('pages.admin.reports.partials.stock-report')
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
            {{-- --- PERBAIKAN DI SINI --- --}}
            @include('pages.admin.reports.partials.transactions-report')
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="activity" role="tabpanel" aria-labelledby="activity-tab">
            {{-- --- PERBAIKAN DI SINI --- --}}
            @include('pages.admin.reports.partials.activity-report')
        </div>
    </div>
</div>
@endsection