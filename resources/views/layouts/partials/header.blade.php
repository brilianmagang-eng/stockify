<header class="bg-white shadow-md p-4 flex items-center justify-between dark:bg-gray-800">
    {{-- Search Bar --}}
    <div class="w-1/3">
        <form action="{{ route('search.results') }}" method="GET">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="bi bi-search text-gray-500"></i>
                </div>
                <input type="search" name="query" id="default-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600" placeholder="Search products by name or SKU..." value="{{ $query ?? '' }}">
            </div>
        </form>
    </div>

    {{-- User Info & Notifications --}}
    <div class="flex items-center gap-4">
        
        {{-- Tombol Notifikasi --}}
        <div class="relative">
            <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="bi bi-bell-fill"></i>
                @if(isset($notificationCount) && $notificationCount > 0)
                    <div class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-1 dark:border-gray-900">{{ $notificationCount }}</div>
                @endif
            </button>
            <!-- Dropdown menu -->
            <div id="notification-dropdown" class="z-20 hidden w-80 max-w-sm my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600">
                <div class="block px-4 py-2 text-base font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-700 dark:text-white">
                    Notifications
                </div>
                <div>
                    @if(isset($notifications) && $notifications->count() > 0)
                        @foreach($notifications as $notification)
                            @if(Auth::user()->role === 'staff')
                                <a href="{{ route('staff.dashboard') }}" class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                    <div class="pl-3 w-full">
                                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                            New pending task: <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->product->name ?? 'N/A' }} ({{ $notification->quantity }} pcs)</span>
                                        </div>
                                        <div class="text-xs font-medium text-primary-700 dark:text-primary-400">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('manager.products.show', $notification) }}" class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                    <div class="pl-3 w-full">
                                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                            Low stock alert for <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->name }}</span>. Current stock is {{ $notification->stock }}.
                                        </div>
                                        <div class="text-xs font-medium text-primary-700 dark:text-primary-400">{{ $notification->updated_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @else
                        <div class="text-center py-4 text-sm text-gray-500 dark:text-gray-400">
                            No new notifications.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Info Pengguna --}}
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-orange-200 text-orange-600 font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </span>
            <div>
                <div class="font-bold dark:text-white">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>
    </div>
</header>