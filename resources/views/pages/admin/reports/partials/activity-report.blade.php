<h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">User Activity Report</h3>
<form method="GET" action="{{ route('admin.reports.index') }}" class="mb-6">
    <input type="hidden" name="tab" value="activity">
     <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-white dark:bg-gray-900 rounded-lg">
        <div>
            <label class="text-sm">User</label>
            <select name="user_id" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                <option value="">All Users</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-sm">Start Date</label>
            <input type="date" name="activity_start_date" value="{{ request('activity_start_date') }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
        </div>
        <div>
            <label class="text-sm">End Date</label>
            <input type="date" name="activity_end_date" value="{{ request('activity_end_date') }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
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
                <th scope="col" class="px-6 py-3">Time</th>
                <th scope="col" class="px-6 py-3">User</th>
                <th scope="col" class="px-6 py-3">Aktivity</th>
                <th scope="col" class="px-6 py-3">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($userActivityReports as $activity)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">{{ $activity->created_at->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4">{{ $activity->user->name ?? 'N/A' }}</td>
                <td class="px-6 py-4">@if($activity->type == 'in') Record incoming goods @else Record outgoing goods @endif</td>
                <td class="px-6 py-4">{{ $activity->quantity }} unit "{{ $activity->product->name ?? 'N/A' }}"</td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center p-4">No activity.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>