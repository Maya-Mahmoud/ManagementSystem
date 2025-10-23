@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- منع الحركة عند الضغط -->
    <style>
        a:focus, a:active {
            outline: none !important;
            box-shadow: none !important;
            transform: none !important;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Hall Manager</h1>
                        <p class="text-xs text-gray-500">College Management System</p>
                    </div>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    <!-- Notification Icon Updated -->
                            <div class="flex items-center bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 
                                        6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 
                                        6.165 6 8.388 6 11v3.159c0 .538-.214 
                                        1.055-.595 1.436L4 17h5m6 0a3 3 0 
                                        11-6 0h6z"/>
                                </svg>
                                2
                            </div>

                    <!-- Profile Button -->
                    <div class="flex items-center">
                        <a href="{{ route('student.profile') }}"
                           class="flex items-center bg-gray-100 px-2 py-1 rounded text-xs text-gray-700 hover:text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-0 select-none">
                            <svg class="w-4 h-4 text-gray-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                        </a>
                        <span class="ml-2 bg-purple-100 text-purple-800 text-xs px-1.5 py-0.5 rounded">{{ Auth::user()->role }}</span>
                    </div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Secondary Navigation Tabs -->
    <nav class="border-b border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-8" aria-label="Tabs" role="tablist">
                <a href="{{ route('student.dashboard') }}"
                   class="{{ request()->routeIs('student.dashboard') ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                   {{ request()->routeIs('student.dashboard') ? 'aria-current="page"' : '' }} role="tab">My Schedule</a>

                <a href="{{ route('student.subjects') }}"
                   class="{{ request()->routeIs('student.subjects') ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                   {{ request()->routeIs('student.subjects') ? 'aria-current="page"' : '' }} role="tab">Subjects</a>

                <a href="{{ route('student.scan-qr') }}"
                   class="{{ request()->routeIs('student.scan-qr') ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                   {{ request()->routeIs('student.scan-qr') ? 'aria-current="page"' : '' }} role="tab">Scan QR</a>

                <a href="{{ route('student.attendance') }}"
                   class="{{ request()->routeIs('student.attendance') ? 'border-purple-600 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                   {{ request()->routeIs('student.attendance') ? 'aria-current="page"' : '' }} role="tab">My presence</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</div>
@livewireScripts
</body>
</html>
