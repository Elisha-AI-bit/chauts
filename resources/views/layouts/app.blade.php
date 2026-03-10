<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-chalimbana-text bg-chalimbana-light">
        <div class="min-h-screen flex flex-col">
            <!-- Top Navbar -->
            @include('layouts.navigation')

            <div class="flex flex-1 overflow-hidden">
                <!-- Sidebar -->
                <aside class="w-64 bg-chalimbana-blue hidden md:flex flex-col shadow-lg overflow-y-auto">
                    <div class="h-16 flex items-center px-6 border-b border-chalimbana-blue/50">
                        <span class="text-white font-bold text-lg tracking-wider">CSTS ⚡</span>
                    </div>
                    <nav class="flex-1 px-4 py-4 space-y-2">
                        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-sidebar-link>
                        
                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                        <x-sidebar-link :href="route('programs.index')" :active="request()->routeIs('programs.*')">
                            {{ __('Programs') }}
                        </x-sidebar-link>

                        <x-sidebar-link :href="route('courses.index')" :active="request()->routeIs('courses.*')">
                            {{ __('Courses') }}
                        </x-sidebar-link>

                        <x-sidebar-link :href="route('lecturers.index')" :active="request()->routeIs('lecturers.*')">
                            {{ __('Lecturers') }}
                        </x-sidebar-link>

                        <x-sidebar-link :href="route('rooms.index')" :active="request()->routeIs('rooms.*')">
                            {{ __('Rooms') }}
                        </x-sidebar-link>

                        <x-sidebar-link :href="route('import.index')" :active="request()->routeIs('import.*')">
                            {{ __('Import Data') }}
                        </x-sidebar-link>

                        @endif

                        <x-sidebar-link :href="route('timetables.index')" :active="request()->routeIs('timetables.*')">
                            {{ __('Timetables') }}
                        </x-sidebar-link>
                    </nav>
                </aside>

                <!-- Main Content Area -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow z-10">
                            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-chalimbana-light">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
