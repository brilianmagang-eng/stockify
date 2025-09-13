    @extends('layouts.app')

    @section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Reports</h1>

        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="report-tab" data-tabs-toggle="#report-tab-content" role="tablist">
                <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2 rounded-t-lg" id="stock-tab" data-tabs-target="#stock" type="button" role="tab" aria-controls="stock" aria-selected="true">Stock Report</button></li>
                <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2" id="transactions-tab" data-tabs-target="#transactions" type="button" role="tab" aria-controls="transactions" aria-selected="false">Transactions Report</button></li>
            </ul>
        </div>
        <div id="report-tab-content">
            {{-- Tab Laporan Stok --}}
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="stock" role="tabpanel" aria-labelledby="stock-tab">
                @include('pages.manager.reports.partials.stock-report', ['stockReports' => $stockReports])
            </div>
            {{-- Tab Laporan Transaksi --}}
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
                @include('pages.manager.reports.partials.transactions-report', ['transactionReports' => $transactionReports])
            </div>
        </div>
    </div>
    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi komponen Tabs dari Flowbite
        const tabsElement = document.getElementById('report-tab');
        const tabElements = [
            { id: 'stock', triggerEl: document.getElementById('stock-tab'), targetEl: document.getElementById('stock') },
            { id: 'transactions', triggerEl: document.getElementById('transactions-tab'), targetEl: document.getElementById('transactions') },
        ];
        const options = {
            defaultTabId: 'stock',
            activeClasses: 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500',
            inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
        };
        const tabs = new Tabs(tabsElement, tabElements, options);

        // Periksa parameter URL untuk 'tab'
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');

        // Jika parameter 'tab' ada di URL, aktifkan tab yang sesuai
        if (activeTab) {
            tabs.show(activeTab);
        }
    });
</script>
@endpush
    @endsection
    
