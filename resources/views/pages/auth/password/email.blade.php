<!-- {{-- Ini adalah halaman untuk meminta link reset password --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Stockify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">Stockify</a>
        <div class="w-full bg-white rounded-lg shadow-md md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold text-gray-900 md:text-2xl dark:text-white">Forgot your password?</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">No problem. Just let us know your email address and we will email you a password reset link.</p>
                
                @if (session('status'))
                    <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required autofocus value="{{ old('email') }}">
                        @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">Email Password Reset Link</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html> -->
