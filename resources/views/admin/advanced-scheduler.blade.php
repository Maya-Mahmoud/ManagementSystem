<x-admin-layout>
    <div class="flex justify-between items-center mb-6 px-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Advanced Scheduler</h1>
            <p class="text-gray-600 mt-1">Schedule lectures with conflict detection and recurring options</p>
        </div>
        <button id="scheduleLectureBtn" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded shadow">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Schedule Lecture
        </button>
    </div>

    <div class="bg-white rounded-lg shadow p-6 px-10 my-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Schedule Overview</h2>
            <input type="date" id="scheduleDate" class="border border-gray-300 rounded px-3 py-1" value="{{ date('Y-m-d') }}" />
        </div>
        <div id="scheduleOverview" class="flex flex-col py-4 text-gray-700">
            <!-- Lectures will be rendered here dynamically -->
        </div>
    </div>

    <!-- Schedule Lecture Modal -->
    <div id="scheduleLectureModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-[600px]">
            <h3 class="text-xl font-semibold mb-4">Schedule New Lecture</h3>
            <form id="scheduleLectureForm" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Lecture Title</label>
                    <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" id="subject" name="subject" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label for="professor" class="block text-sm font-medium text-gray-700">Professor</label>
                    <input type="text" id="professor" name="professor" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label for="hall_id" class="block text-sm font-medium text-gray-700">Hall</label>
                    <select id="hall_id" name="hall_id" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Select a hall</option>
                    </select>
                </div>
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="datetime-local" id="end_time" name="end_time" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label for="max_students" class="block text-sm font-medium text-gray-700">Max Students</label>
                    <input type="number" id="max_students" name="max_students" value="50" min="1" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label class="inline-flex items-center mt-2">
                        <input type="checkbox" id="recurringLecture" name="recurringLecture" class="form-checkbox" />
                        <span class="ml-2 text-gray-700">Make this a recurring lecture</span>
                    </label>
                </div>
                <div id="recurringOptions" class="hidden flex space-x-6 mt-2">
                    <div class="flex flex-col">
                        <label for="repeat_pattern" class="block text-sm font-medium text-gray-700">Repeat Pattern</label>
                        <select id="repeat_pattern" name="repeat_pattern" class="mt-1 block w-40 border border-gray-300 rounded px-3 py-2">
                            <option value="daily">Daily</option>
                            <option value="weekly" selected>Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="mt-1 block w-40 border border-gray-300 rounded px-3 py-2" />
                    </div>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelBtn" class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-purple-600 text-white hover:bg-purple-700">Schedule Lecture</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const scheduleLectureBtn = document.getElementById('scheduleLectureBtn');
        const scheduleLectureModal = document.getElementById('scheduleLectureModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const scheduleLectureForm = document.getElementById('scheduleLectureForm');

        scheduleLectureBtn.addEventListener('click', () => {
            scheduleLectureModal.classList.remove('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            scheduleLectureModal.classList.add('hidden');
        });

        scheduleLectureForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(scheduleLectureForm);
            const data = Object.fromEntries(formData.entries());

            // Convert recurringLecture to boolean
            data.recurringLecture = scheduleLectureForm.querySelector('#recurringLecture').checked;

            try {
                const response = await fetch('/admin/api/lectures', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    alert('Lecture scheduled successfully!');
                    scheduleLectureModal.classList.add('hidden');
                    // Redirect to lectures page to see the scheduled lectures
                    window.location.href = "{{ route('admin.lectures') }}";
                } else {
                    const errorData = await response.json();
                    alert(errorData.message || 'Failed to schedule lecture.');
                }
            } catch (error) {
                alert('Error scheduling lecture.');
                console.error(error);
            }
        });

        // Fetch halls dynamically when hall dropdown is focused (better than click)
        const hallDropdown = document.getElementById('hall_id');
        hallDropdown.addEventListener('focus', async () => {
            console.log('Hall dropdown focused');
            if (hallDropdown.options.length <= 1) { // Only fetch if options not loaded yet
                try {
                    const response = await fetch('/admin/api/halls');
                    if (response.ok) {
                        const halls = await response.json();
                        console.log('Fetched halls:', halls);
                        halls.forEach(hall => {
                            const option = document.createElement('option');
                            option.value = hall.id;
                            option.textContent = hall.hall_name; // Use hall_name as per model
                            hallDropdown.appendChild(option);
                        });
                    } else {
                        console.error('Failed to fetch halls');
                    }
                } catch (error) {
                    console.error('Error fetching halls:', error);
                }
            }
        });

        // Fetch and render lectures for selected date
        const scheduleDateInput = document.getElementById('scheduleDate');
        const scheduleOverview = document.getElementById('scheduleOverview');

        async function fetchLecturesByDate(date) {
            try {
                const response = await fetch(`/admin/api/lectures-by-date?date=${date}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch lectures');
                }
                const lectures = await response.json();
                renderLectures(lectures, date);
            } catch (error) {
                console.error('Error fetching lectures:', error);
                scheduleOverview.innerHTML = `<p class="text-red-500">Error loading lectures.</p>`;
            }
        }

        function renderLectures(lectures, date) {
            if (lectures.length === 0) {
                const formattedDate = new Date(date).toLocaleDateString(undefined, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                scheduleOverview.innerHTML = `
                    <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                        <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p>No lectures scheduled for ${formattedDate}</p>
                    </div>
                `;
                return;
            }

            scheduleOverview.innerHTML = '';
            lectures.forEach(lecture => {
                const startTime = new Date(lecture.start_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const endTime = new Date(lecture.end_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const hallName = lecture.hall.hall_name || 'Unknown Hall';
                const professorName = lecture.user ? `بروفيسور: ${lecture.user.name}` : 'Unknown Professor';

                const lectureDiv = document.createElement('div');
                lectureDiv.className = 'bg-gray-100 rounded p-4 mb-3 shadow w-full';
                lectureDiv.innerHTML = `
                    <div class="flex justify-between items-center mb-1">
                        <h3 class="font-semibold text-lg">${lecture.title}</h3>
                        <div class="flex space-x-2">
                            <span class="text-xs bg-purple-200 text-purple-800 rounded px-2 py-0.5">${lecture.subject}</span>
                            ${lecture.repeat_pattern ? `<span class="text-xs bg-blue-200 text-blue-800 rounded px-2 py-0.5">${lecture.repeat_pattern}</span>` : ''}
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <span>🕒 ${startTime} - ${endTime}</span> &nbsp;|&nbsp;
                        <span>🏛️ ${hallName}</span> &nbsp;|&nbsp;
                        <span>👨‍🏫 ${professorName}</span>
                    </div>
                `;
                scheduleOverview.appendChild(lectureDiv);
            });
        }

        // Initial fetch for today's date
        fetchLecturesByDate(scheduleDateInput.value);

        // Fetch lectures on date change
        scheduleDateInput.addEventListener('change', (e) => {
            fetchLecturesByDate(e.target.value);
        });

        // Toggle recurring options visibility on checkbox change
        const recurringCheckbox = document.getElementById('recurringLecture');
        const recurringOptions = document.getElementById('recurringOptions');
        recurringCheckbox.addEventListener('change', () => {
            if (recurringCheckbox.checked) {
                recurringOptions.classList.remove('hidden');
            } else {
                recurringOptions.classList.add('hidden');
            }
        });
    </script>
</x-admin-layout>