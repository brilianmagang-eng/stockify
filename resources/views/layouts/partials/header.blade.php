<header class="flex items-center justify-between bg-white px-6 py-3 shadow dark:bg-gray-800">
    <input type="text" placeholder="Search..." class="border rounded-lg px-3 py-2 w-1/3 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    <div class="flex items-center gap-4">
        <button class="relative text-gray-600 dark:text-gray-300">
            <i class="bi bi-bell text-xl"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">1</span>
        </button>

        {{-- Dropdown Profil Pengguna (Fungsi Sama, Desain Baru) --}}
        <div class="flex items-center">
            <button type="button" class="flex items-center gap-2" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" alt="user photo">
                <div class="text-left">
                    {{-- Mengambil nama dari database --}}
                    <p class="font-semibold text-sm dark:text-white">{{ Auth::user()->name }}</p>
                    {{-- Mengambil role dari database --}}
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </button>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                    <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>