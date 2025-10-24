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
                    <!-- Notification Icon -->
                    <a href="{{ route('notifications.index') }}" class="flex items-center bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs hover:bg-red-200 transition-colors">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002
                                6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67
                                6.165 6 8.388 6 11v3.159c0 .538-.214
                                1.055-.595 1.436L4 17h5m6 0a3 3 0
                                11-6 0h6z"/>
                        </svg>
                        <span id="notification-count">0</span>
                    </a>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBtn = document.getElementById('notification-btn');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationCount = document.getElementById('notification-count');
        const notificationList = document.getElementById('notification-list');

        // Toggle dropdown
        notificationBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationDropdown.contains(e.target) && !notificationBtn.contains(e.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });

        let isLoading = false;

        // Load notifications
        function loadNotifications() {
            if (isLoading) return;
            isLoading = true;

            fetch('/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    notificationCount.textContent = data.count;
                    if (data.count > 0) {
                        notificationBtn.classList.add('bg-red-500', 'text-white');
                        notificationBtn.classList.remove('bg-red-100', 'text-red-800');
                    } else {
                        notificationBtn.classList.remove('bg-red-500', 'text-white');
                        notificationBtn.classList.add('bg-red-100', 'text-red-800');
                    }
                });

            // Load only unread notifications
            fetch('/notifications?unread_only=true')
                .then(response => response.json())
                .then(data => {
                    notificationList.innerHTML = '';

                    if (data.data && data.data.length === 0) {
                        notificationList.innerHTML = '<div class="px-4 py-2 text-sm text-gray-500">No new notifications</div>';
                    } else if (data.data) {
                        data.data.forEach(notification => {
                            const item = document.createElement('div');
                            item.className = 'px-4 py-2 border-b border-gray-100 hover:bg-gray-50 cursor-pointer bg-blue-50';
                            item.innerHTML = `
                                <div class="text-sm text-gray-900">${notification.data.message}</div>
                                <div class="text-xs text-gray-500 mt-1">${new Date(notification.created_at).toLocaleDateString()}</div>
                            `;
                            item.addEventListener('click', function() {
                                fetch(`/notifications/${notification.id}/mark-as-read`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Content-Type': 'application/json'
                                    }
                                }).then(() => {
                                    loadNotifications();
                                });
                            });
                            notificationList.appendChild(item);
                        });

                        // Mark all visible notifications as read when dropdown is opened
                        markAllVisibleAsRead(data.data);
                    }
                    isLoading = false;
                })
                .catch(() => {
                    isLoading = false;
                });
        }

        // Mark all visible notifications as read
        function markAllVisibleAsRead(notifications) {
            const unreadIds = notifications.filter(n => !n.read_at).map(n => n.id);
            if (unreadIds.length > 0) {
                fetch('/notifications/mark-multiple-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ ids: unreadIds })
                }).then(() => {
                    // Update the count after marking as read
                    fetch('/notifications/unread-count')
                        .then(response => response.json())
                        .then(data => {
                            notificationCount.textContent = data.count;
                            if (data.count === 0) {
                                notificationBtn.classList.remove('bg-red-500', 'text-white');
                                notificationBtn.classList.add('bg-red-100', 'text-red-800');
                            }
                        });
                });
            }
        }

        // Load notifications on page load
        loadNotifications();

        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);
    });
</script>

@livewireScripts
</body>
</html>
