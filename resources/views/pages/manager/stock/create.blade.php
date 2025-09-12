@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
        Record Item {{ $type == 'in' ? 'In' : 'Out' }}
    </h1>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form action="{{ route('manager.stock.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                    <select id="product_id" name="product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                        <option selected disabled>Choose a product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Current Stock: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                    @error('product_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required min="1">
                    @error('quantity')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transaction Date</label>
                    <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
                    @error('date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes (Optional)</label>
                <textarea id="notes" name="notes" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600"></textarea>
                @error('notes')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Record Transaction</button>
            <a href="{{ route('manager.dashboard') }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-600">Cancel</a>
        </form>
    </div>
</div>
@endsection

