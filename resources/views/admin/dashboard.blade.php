<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Admin Panel</h1>
            <p class="text-gray-600">Manage users, halls, and system settings</p>
        </div>

        <!-- Sub Navigation -->
        <div class="bg-white shadow-sm rounded-lg mb-6">
            <div class="px-6 py-4">
                <nav class="flex space-x-8">
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-purple-600 border-b-2 border-purple-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Overview
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Users
                    </a>
                    <a href="{{ route('admin.halls') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Halls
                    </a>
                    <a href="{{ route('admin.reports') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Reports
                    </a>
                </nav>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Users -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-gray-900">5</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ +12%</span>
                            </div>
                            <p class="text-sm text-gray-600">Total Users</p>
                            <p class="text-xs text-gray-500">2 Professors, 3 Students</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hall Utilization -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-gray-900">50%</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ +8%</span>
                            </div>
                            <p class="text-sm text-gray-600">Hall Utilization</p>
                            <p class="text-xs text-gray-500">2/4 halls booked</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Lectures -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-gray-900">0</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ +5%</span>
                            </div>
                            <p class="text-sm text-gray-600">Today's Lectures</p>
                            <p class="text-xs text-gray-500">4 total lectures</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-gray-900">98.5%</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ +0.2%</span>
                            </div>
                            <p class="text-sm text-gray-600">System Health</p>
                            <p class="text-xs text-gray-500">All systems operational</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Reports -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Reports</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- User Distribution -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-md font-medium text-gray-900 mb-4">User Distribution</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Professors</span>
                                    <span class="text-sm text-gray-600">2</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 40%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Students</span>
                                    <span class="text-sm text-gray-600">2</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 40%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hall Utilization -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Hall Utilization</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Booked Halls</span>
                                    <span class="text-sm text-gray-600">2</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: 50%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Available Halls</span>
                                    <span class="text-sm text-gray-600">2</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-purple-100 rounded-full">
                                <span class="text-sm font-medium text-purple-600">SA</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">System Admin</p>
                                <p class="text-sm text-gray-500">admin@college.edu</p>
                            </div>
                        </div>
                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Admin</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full">
                                <span class="text-sm font-medium text-blue-600">DS</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Dr. Smith</p>
                                <p class="text-sm text-gray-500">smith@college.edu</p>
                            </div>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Professor</span>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full">
                                <span class="text-sm font-medium text-green-600">AJ</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Alice Johnson</p>
                                <p class="text-sm text-gray-500">alice@college.edu</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Student</span>
                    </div>

                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full">
                                <span class="text-sm font-medium text-gray-600">PJ</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Prof. Johnson</p>
                                <p class="text-sm text-gray-500">johnson@college.edu</p>
                            </div>
                        </div>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Professor</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
