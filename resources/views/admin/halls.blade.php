<x-admin-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Hall Management</h1>
            <p class="text-gray-600">Monitor hall capacity, bookings, and availability</p>
        </div>

        <!-- Halls Grid - More Compact -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Amphitheater A -->
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Amphitheater A</h3>
                    <div class="flex items-center bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Booked
                    </div>
                </div>

                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Main Building, Floor 1
                    </div>

                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Capacity: <span class="font-medium ml-1">200</span>
                    </div>
                </div>

                <div class="bg-blue-50 p-2 rounded mb-3">
                    <p class="text-sm font-medium text-blue-900 mb-1">Current Lecture:</p>
                    <p class="text-sm text-blue-800">Advanced Mathematics</p>
                </div>

                <div class="mb-3">
                    <p class="text-sm font-medium text-gray-700 mb-2">Equipment:</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Projector</span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Sound System</span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Microphone</span>
                    </div>
                </div>

                <button class="w-full bg-pink-100 text-pink-800 py-2 px-3 rounded text-sm font-medium hover:bg-pink-200">
                    Release Hall
                </button>
            </div>

            <!-- Lab Room B -->
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Lab Room B</h3>
                    <div class="flex items-center bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Available
                    </div>
                </div>

                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Science Building, Floor 2
                    </div>

                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Capacity: <span class="font-medium ml-1">30</span>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="text-sm font-medium text-gray-700 mb-2">Equipment:</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Computers</span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Projector</span>
                    </div>
                </div>

                <button class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-2 px-3 rounded text-sm font-medium hover:from-purple-700 hover:to-blue-700">
                    Book Hall
                </button>
            </div>

            <!-- Lecture Hall C -->
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Lecture Hall C</h3>
                    <div class="flex items-center bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Booked
                    </div>
                </div>

                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Technology Building, Floor 3
                    </div>

                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Capacity: <span class="font-medium ml-1">100</span>
                    </div>
                </div>

                <div class="bg-blue-50 p-2 rounded mb-3">
                    <p class="text-sm font-medium text-blue-900 mb-1">Current Lecture:</p>
                    <p class="text-sm text-blue-800">Computer Science Fundamentals</p>
                </div>

                <div class="mb-3">
                    <p class="text-sm font-medium text-gray-700 mb-2">Equipment:</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Projector</span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Whiteboard</span>
                    </div>
                </div>

                <button class="w-full bg-pink-100 text-pink-800 py-2 px-3 rounded text-sm font-medium hover:bg-pink-200">
                    Release Hall
                </button>
            </div>

            <!-- Seminar Room D -->
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Seminar Room D</h3>
                    <div class="flex items-center bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Available
                    </div>
                </div>

                <div class="space-y-2 mb-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Main Building, Floor 2
                    </div>

                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Capacity: <span class="font-medium ml-1">25</span>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="text-sm font-medium text-gray-700 mb-2">Equipment:</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">TV Screen</span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Whiteboard</span>
                    </div>
                </div>

                <button class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-2 px-3 rounded text-sm font-medium hover:from-purple-700 hover:to-blue-700">
                    Book Hall
                </button>
            </div>
        </div>
    </div>
</x-admin-layout>
