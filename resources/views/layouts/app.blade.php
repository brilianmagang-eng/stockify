<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stockify</title>

        {{-- Google Fonts (dari desain Anda) --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
        
        {{-- Memanggil CSS dan JS dari Vite (termasuk Tailwind, Flowbite, Bootstrap Icons) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        <div class="flex">
            {{-- Memanggil Sidebar --}}
            @include('layouts.partials.sidebar')

            {{-- Konten Utama (Header + Isi Halaman) --}}
            <div class="flex-1 flex flex-col">
                {{-- Memanggil Header (Topbar) --}}
                @include('layouts.partials.header')
                
                <main>
                    @yield('content')
                </main>

                {{-- Memanggil Footer jika ada --}}
                {{-- @include('layouts.partials.footer') --}}
            </div>
        </div>
    </body>
</html>