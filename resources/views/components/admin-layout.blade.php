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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        
                        <!-- Logo -->
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg mr-3
                                        bg-gradient-to-br from-indigo-500 to-purple-700 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-purple-700">Hall Manager</h4>
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

                            <!-- Profile -->
                            <div class="flex items-center bg-gray-100 px-2 py-1 rounded text-xs">
                                <svg class="w-4 h-4 text-gray-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 
                                        018 0zM12 14a7 7 0 00-7 7h14a7 
                                        7 0 00-7-7z"/>
                                </svg>

                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'professor')
                                    <a href="{{ route('admin.profile') }}" class="text-xs font-medium text-gray-700 hover:text-purple-600 transition-colors">
                                        {{ Auth::user()->name }}
                                    </a>
                                @else
                                    <span class="text-xs font-medium text-gray-700">
                                        {{ Auth::user()->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- User Role Badge -->
                            <span class="ml-1 bg-purple-100 text-purple-800 text-xs px-1 py-0.5 rounded">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" x-data @submit.prevent="$root.submit()">
                                @csrf
                                <button type="submit" class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                                    <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 
                                            4v1a3 3 0 01-3 3H6a3 3 0 
                                            01-3-3V7a3 3 0 013-3h4a3 
                                            3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </header>

            <!-- Navigation -->
            <nav class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-12">
                        <div class="flex">
                            @can('admin panel')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('admin.dashboard') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                    Admin Panel
                                </a>
                            @endcan

                            <a href="{{ route('halls.index') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('halls.index') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Book Halls
                            </a>

                            @can('lectures')
                                <a href="{{ route('admin.lectures') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('admin.lectures') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                    Lectures
                                </a>
                            @endcan

                            @if(Auth::user()->role === 'professor')
                                <a href="{{ route('professor.lectures') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('professor.lectures') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                    Lectures
                                </a>
                            @endif

                            <a href="{{ route('admin.generate-qr') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('admin.generate-qr') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Generate QR
                            </a>

                            <a href="{{ route('admin.advanced-scheduler') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('admin.advanced-scheduler') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Advanced Scheduler
                            </a>

                            <a href="{{ route('admin.performance') }}" class="flex items-center px-3 py-2 text-lg font-medium {{ request()->routeIs('admin.performance') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                                Performance
                            </a>
                            
                            <a href="#" class="flex items-center px-3 py-2 text-lg font-medium text-gray-500 hover:text-gray-700">
                                Calendar
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="py-8">
                {{ $slot }}
            </main>

        </div>
    </body>
</html>
