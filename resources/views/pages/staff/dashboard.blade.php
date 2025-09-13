@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Baris Judul dan Sambutan --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Staff Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400">Welcome, {{ Auth::user()->name }}! Here are your pending tasks.</p>
    </div>

    @include('layouts.partials.session-messages')

    {{-- Tabel Daftar Tugas --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Task List</h3>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Type</th>
                        <th scope="col" class="px-6 py-3">Product</th>
                        <th scope="col" class="px-6 py-3">Quantity</th>
                        <th scope="col" class="px-6 py-3">Notes</th>
                        <th scope="col" class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingTasks as $task)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($task->date)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if($task->type == 'in')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Incoming</span>
                            @else
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Outgoing</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $task->product->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $task->quantity }}</td>
                        <td class="px-6 py-4 text-xs">{{ $task->notes ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('staff.tasks.update', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="font-medium text-green-600 dark:text-green-500 hover:underline">Confirm Task</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No pending tasks. You're all caught up!
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