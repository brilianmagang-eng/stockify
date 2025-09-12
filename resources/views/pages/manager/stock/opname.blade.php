@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Stock Opname</h1>

    @include('layouts.partials.session-messages')

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form action="{{ route('manager.stock.opnameStore') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="product_id" class="block mb-2 text-sm font-medium">Product</label>
                    <select id="product_id" name="product_id" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                        <option selected disabled value="">Choose a product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-stock="{{ $product->stock }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="system_stock" class="block mb-2 text-sm font-medium">System Stock</label>
                    <input type="number" id="system_stock" class="bg-gray-200 border border-gray-300 text-sm rounded-lg block w-full p-2.5" readonly>
                </div>
                
                <div>
                    <label for="physical_stock" class="block mb-2 text-sm font-medium">Physical Stock (Counted)</label>
                    <input type="number" id="physical_stock" name="physical_stock" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required min="0">
                    @error('physical_stock')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="variance" class="block mb-2 text-sm font-medium">Variance</label>
                    <input type="number" id="variance" class="bg-gray-200 border border-gray-300 text-sm rounded-lg block w-full p-2.5" readonly>
                </div>
            </div>

            <div class="mb-6">
                <label for="notes" class="block mb-2 text-sm font-medium">Reason / Notes for Adjustment</label>
                <textarea id="notes" name="notes" rows="4" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>{{ old('notes') }}</textarea>
                @error('notes')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Adjust Stock</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productSelect = document.getElementById('product_id');
    const systemStockInput = document.getElementById('system_stock');
    const physicalStockInput = document.getElementById('physical_stock');
    const varianceInput = document.getElementById('variance');

    function updateVariance() {
        const systemStock = parseInt(systemStockInput.value) || 0;
        const physicalStock = parseInt(physicalStockInput.value) || 0;
        varianceInput.value = physicalStock - systemStock;
    }

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');
        systemStockInput.value = stock;
        updateVariance();
    });

    physicalStockInput.addEventListener('input', updateVariance);
});
</script>
@endpush
@endsection