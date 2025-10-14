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
                        <svg class="w-5 h-5 mr-3"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Overview
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5 mr-3"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Users
                    </a>
                    <a href="{{ route('admin.halls') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5 mr-3"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Halls
                    </a>
                    <a href="{{ route('admin.subjects') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5 mr-3"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Subject
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
                                <span class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ {{ $userChange }}</span>
                            </div>
                            <p class="text-sm text-gray-600">Total Users</p>
                            <p class="text-xs text-gray-500">{{ $admins }} Admins, {{ $professors }} Professors, {{ $students }} Students</p>
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
                                <span class="text-2xl font-bold text-gray-900">{{ $hallUtilization }}%</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ {{ $hallChange }}</span>
                            </div>
                            <p class="text-sm text-gray-600">Hall Utilization</p>
                            <p class="text-xs text-gray-500">{{ $bookedHalls }}/{{ $totalHalls }} halls booked</p>
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
                                <span class="text-2xl font-bold text-gray-900">{{ $todayLectures }}</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ {{ $lectureChange }}</span>
                            </div>
                            <p class="text-sm text-gray-600">Today's Lectures</p>
                            <p class="text-xs text-gray-500">{{ $totalLectures }} total lectures</p>
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
                                <span class="text-2xl font-bold text-gray-900">{{ $health }}</span>
                                <span class="text-green-600 text-sm font-medium ml-2">↗ {{ $healthChange }}</span>
                            </div>
                            <p class="text-sm text-gray-600">System Health</p>
                            <p class="text-xs text-gray-500">All systems operational</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Subject -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Subject</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- User Distribution -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-md font-medium text-gray-900 mb-4">User Distribution</h4>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Admins</span>
                                    <span class="text-sm text-gray-600">{{ $admins }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $adminPercent }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Professors</span>
                                    <span class="text-sm text-gray-600">{{ $professors }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $professorPercent }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Students</span>
                                    <span class="text-sm text-gray-600">{{ $students }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $studentPercent }}%"></div>
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
                                    <span class="text-sm text-gray-600">{{ $bookedHalls }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ $bookedPercent }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-medium text-gray-700">Available Halls</span>
                                    <span class="text-sm text-gray-600">{{ $availableHalls }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $availablePercent }}%"></div>
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
                    @foreach($recentUsers as $user)
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-{{ $user->role == 'admin' ? 'purple' : ($user->role == 'professor' ? 'blue' : 'green') }}-100 rounded-full">
                                <span class="text-sm font-medium text-{{ $user->role == 'admin' ? 'purple' : ($user->role == 'professor' ? 'blue' : 'green') }}-600">{{ substr($user->name, 0, 2) }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="bg-{{ $user->role == 'admin' ? 'purple' : ($user->role == 'professor' ? 'blue' : 'green') }}-100 text-{{ $user->role == 'admin' ? 'purple' : ($user->role == 'professor' ? 'blue' : 'green') }}-800 text-xs px-2 py-1 rounded capitalize">{{ $user->role }}</span>
                    </div>
                    @endforeach
                    @if($recentUsers->count() < 4)
                        @for($i = $recentUsers->count(); $i < 4; $i++)
                        <div class="flex items-center justify-between py-3 border-b border-gray-200 opacity-50">
                            <span class="text-sm text-gray-500">No recent activity</span>
                        </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
