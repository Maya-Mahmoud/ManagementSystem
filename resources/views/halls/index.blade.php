<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Halls Booking</h1>
                <p class="mt-2 text-sm text-gray-600">Book or release halls for your classes</p>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($halls as $hall)
                    @php
                        $currentLecture = $hall->lectures()->where('start_time', '<=', now())->where('end_time', '>', now())->first();
                        $currentBooking = $hall->currentBooking;
                    @endphp
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $hall->hall_name }}</h3>

                            <div class="space-y-3 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Capacity: <span class="font-medium ml-1">{{ $hall->capacity }}</span>
                                </div>

                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <span class="font-medium px-2 py-1 rounded-full text-xs {{ $hall->isOccupiedAt(now()) ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $hall->isOccupiedAt(now()) ? 'Occupied' : 'Available' }}
                                    </span>
                                </div>

                                @if($hall->isOccupiedAt(now()))
                                    <div class="text-xs text-gray-500 mt-1">
                                        @if($currentLecture)
                                            Lecture: {{ $currentLecture->title }} ({{ \Carbon\Carbon::parse($currentLecture->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($currentLecture->end_time)->format('H:i') }})
                                        @elseif($currentBooking)
                                            Booked by: {{ $currentBooking->user->name }}
                                        @endif
                                    </div>
                                @endif

                                @if($hall->equipment)
                                    <div class="text-xs text-gray-500">
                                        Equipment: {{ $hall->equipment }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    {{ $hall->building }}, Floor {{ $hall->floor }}
                                </div>

                                <button data-hall-id="{{ $hall->id }}" data-hall-name="{{ $hall->hall_name }}" class="booking-details-btn bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                                    Booking Details
                                </button>

                                @if($hall->currentBooking && $hall->currentBooking->user_id === auth()->id())
                                    <form action="{{ route('halls.release', $hall) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-700 transition-colors">
                                            Release Hall
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div id="bookingDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="bookingModalTitle">Booking Details</h3>
                    <button id="closeBookingModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div id="bookingDetailsContent">
                    <!-- Booking details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.booking-details-btn');
            buttons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const hallId = this.dataset.hallId;
                    const hallName = this.dataset.hallName;
                    showBookingDetails(hallId, hallName);
                });
            });
        });

        function showBookingDetails(hallId, hallName) {
            document.getElementById('bookingModalTitle').textContent = `Booking Details - ${hallName}`;
            const content = document.getElementById('bookingDetailsContent');

            // Show loading message
            content.innerHTML = '<p class="text-center text-gray-500">Loading...</p>';
            document.getElementById('bookingDetailsModal').classList.remove('hidden');

            // Fetch lectures for this hall
            fetch(`/api/halls/${hallId}/lectures`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.data && data.data.length > 0) {
                        let html = '<div class="space-y-4">';
                        data.data.forEach(lecture => {
                            html += `
                                <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Lecture Title:</label>
                                        <p class="text-sm text-gray-900">${lecture.title || 'N/A'}</p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Subject:</label>
                                        <p class="text-sm text-gray-900">${lecture.subject || 'N/A'}</p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Professor:</label>
                                        <p class="text-sm text-gray-900">${lecture.professor || 'N/A'}</p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Start Time:</label>
                                        <p class="text-sm text-gray-900">${lecture.start_time ? new Date(lecture.start_time).toLocaleString('en-GB') : 'N/A'}</p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">End Time:</label>
                                        <p class="text-sm text-gray-900">${lecture.end_time ? new Date(lecture.end_time).toLocaleString('en-GB') : 'N/A'}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status:</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                            lecture.status === 'ongoing' ? 'bg-green-100 text-green-800' :
                                            lecture.status === 'upcoming' ? 'bg-blue-100 text-blue-800' :
                                            'bg-gray-100 text-gray-800'
                                        }">
                                            ${lecture.status ? lecture.status.charAt(0).toUpperCase() + lecture.status.slice(1) : 'Unknown'}
                                        </span>
                                    </div>
                                </div>
                            `;
                        });
                        html += '</div>';
                        content.innerHTML = html;
                    } else {
                        content.innerHTML = '<p class="text-center text-gray-500">No lectures scheduled for this hall</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching lectures:', error);
                    content.innerHTML = `<p class="text-center text-red-500">Error loading booking details: ${error.message}</p>`;
                });
        }

        // Close modal functionality
        document.getElementById('closeBookingModal').addEventListener('click', function() {
            document.getElementById('bookingDetailsModal').classList.add('hidden');
        });

        document.getElementById('bookingDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</x-admin-layout>