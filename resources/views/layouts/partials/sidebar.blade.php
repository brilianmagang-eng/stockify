<aside class="w-64 bg-white shadow-md min-h-screen p-4 dark:bg-gray-800">
    <div class="flex items-center gap-2 mb-6">
        <div class="w-8 h-8 rounded-md bg-blue-600 flex items-center justify-center text-white font-bold">S</div>
        <span class="text-lg font-bold dark:text-white">Stockify</span>
    </div>
    <nav class="space-y-2">

        @if(Auth::user()->role == 'admin')
            {{-- MENU UNTUK ADMIN --}}
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
                {{ request()->routeIs('admin.stock.*') ? 'bg-blue-100 text-blue-600 dark:bg-gray-700 dark:text-white' : 'hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
            <i class="bi bi-stack"></i> Stock Management
        </a>

        @elseif(Auth::user()->role == 'manager')
            {{-- MENU UNTUK MANAGER GUDANG --}}
            <a href="{{ route('manager.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                {{ request()->routeIs('manager.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            <a href="{{ route('manager.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                {{ request()->routeIs('manager.products.*') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                <i class="bi bi-box-seam-fill"></i> Products List
            </a>
            <a href="{{ route('manager.stock.createIn') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                {{ request()->routeIs('manager.stock.createIn') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                <i class="bi bi-box-arrow-in-down"></i> Record Item In
            </a>
             <a href="{{ route('manager.stock.createOut') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium
                {{ request()->routeIs('manager.stock.createOut') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                <i class="bi bi-box-arrow-up"></i> Record Item Out
            </a>
            

        @elseif(Auth::user()->role == 'staff')
            {{-- MENU UNTUK STAFF GUDANG --}}
            <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium 
                {{ request()->routeIs('staff.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100 dark:text-gray-200' }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            {{-- Tambahkan menu staff lain jika perlu --}}
        @endif
    </nav>
</aside>
