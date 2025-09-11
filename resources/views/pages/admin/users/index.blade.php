@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">User Management</h1>
        <a href="{{ route('admin.users.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
            Add User
        </a>
    </div>

    @include('layouts.partials.session-messages')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Joined Date</th>
                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4"><span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded @if($user->role == 'admin') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @elseif($user->role == 'manager') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 @endif">{{ ucfirst($user->role) }}</span></td>
                    <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="#" data-modal-target="delete-modal-{{ $user->id }}" data-modal-toggle="delete-modal-{{ $user->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Delete</a>
                    </td>
                </tr>
                @include('layouts.partials.delete-modal', ['id' => $user->id, 'name' => $user->name, 'action' => route('admin.users.destroy', $user)])
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center">No user data found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $users->links() }}</div>
</div>
@endsection