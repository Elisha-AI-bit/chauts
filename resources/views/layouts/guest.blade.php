<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CHAUTS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .auth-bg {
                background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url('{{ asset("hero-bg.png") }}');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-bg">
            <div class="mb-8">
                <a href="/" class="text-3xl font-extrabold tracking-tight">
                    <span class="text-white">CHAU</span><span class="text-indigo-500">TS</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-card overflow-hidden sm:rounded-3xl shadow-2xl">
                {{ $slot }}
            </div>
            
            <p class="mt-8 text-slate-500 text-sm">
                &copy; {{ date('Y') }} Chalimbana University
            </p>
        </div>
    </body>
</html>
