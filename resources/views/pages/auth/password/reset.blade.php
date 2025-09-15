<!-- {{-- Ini adalah halaman untuk memasukkan password baru --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Stockify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">Stockify</a>
        <div class="w-full bg-white rounded-lg shadow-md md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold text-gray-900 md:text-2xl dark:text-white">Reset Password</h1>
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required value="{{ old('email', request()->email) }}">
                            @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium">New Password</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                            @error('password')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-6">Reset Password</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html> -->