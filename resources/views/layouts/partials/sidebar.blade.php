<aside class="w-64 bg-white shadow-md min-h-screen p-4 dark:bg-gray-800">
    <div class="flex items-center gap-2 mb-6">
        <div class="w-8 h-8 rounded-md bg-blue-600 flex items-center justify-center text-white font-bold">S</div>
        <span class="text-lg font-bold dark:text-white">Stockify</span>
    </div>
    <nav class="space-y-2">

        @if(Auth::check())
            @php $userRole = Auth::user()->role; @endphp

            {{-- =================== MENU UNTUK ADMIN =================== --}}
            @if($userRole == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('admin.products.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-box-seam-fill"></i> Products
                </a>
                <a href="{{ route('admin.suppliers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                    {{ request()->routeIs('admin.suppliers.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-truck"></i> Suppliers
                </a>
                <a href="{{ route('admin.stock.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('admin.stock.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-stack"></i> Stock Management
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('admin.users.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-people-fill"></i> Users
                </a>
                <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('admin.reports.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-graph-up"></i> Reports
                </a>
            
            {{-- =================== MENU UNTUK MANAGER =================== --}}
            @elseif($userRole == 'manager')
                <a href="{{ route('manager.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('manager.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
                <a href="{{ route('manager.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                    {{ request()->routeIs('manager.products.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-box-seam-fill"></i> Products
                </a>
                <a href="{{ route('manager.stock.createIn') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                    {{ request()->routeIs('manager.stock.createIn') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-box-arrow-in-down"></i> Record Item In
                </a>
                 <a href="{{ route('manager.stock.createOut') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                    {{ request()->routeIs('manager.stock.createOut') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-box-arrow-up"></i> Record Item Out
                </a>
                <a href="{{ route('manager.stock.opnameCreate') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                    {{ request()->routeIs('manager.stock.opnameCreate') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-clipboard-check"></i> Stock Opname
                </a>

            {{-- =================== MENU UNTUK STAFF =================== --}}
            @elseif($userRole == 'staff')
                <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                    {{ request()->routeIs('staff.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
            @endif

            {{-- Tombol Logout akan selalu ada di bagian bawah untuk semua role --}}
            <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-red-500 hover:bg-red-50 dark:hover:bg-gray-700">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </form>
            </div>
        @endif
    </nav>
</aside>
