<x-admin-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Subjects Management</h1>
            <p class="text-gray-600">Manage lecture subjects</p>
        </div>

        <!-- Sub Navigation -->
        <div class="bg-white shadow-sm rounded-lg mb-6">
            <div class="px-6 py-4">
                <nav class="flex space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
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
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-purple-600 border-b-2 border-purple-600">
                        <svg class="w-5 h-5 mr-3"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Subject
                    </a>
                </nav>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white shadow-sm rounded-lg mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Subjects</h3>
                <form method="GET" action="{{ route('admin.subjects') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <select name="department_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                        <select name="semester" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">All Semesters</option>
                            <option value="first" {{ request('semester') == 'first' ? 'selected' : '' }}>First</option>
                            <option value="second" {{ request('semester') == 'second' ? 'selected' : '' }}>Second</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                        <select name="year" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">All Years</option>
                            <option value="first" {{ request('year') == 'first' ? 'selected' : '' }}>First</option>
                            <option value="second" {{ request('year') == 'second' ? 'selected' : '' }}>Second</option>
                            <option value="third" {{ request('year') == 'third' ? 'selected' : '' }}>Third</option>
                            <option value="fourth" {{ request('year') == 'fourth' ? 'selected' : '' }}>Fourth</option>
                            <option value="fifth" {{ request('year') == 'fifth' ? 'selected' : '' }}>Fifth</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700">Search</button>
                        <a href="{{ route('admin.subjects') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-600">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subjects List -->
        <div class="bg-white shadow-sm rounded-lg">
            <div class="p-6 flex justify-between items-center border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Lecture Subjects</h3>
                <button id="addSubjectBtn" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-1 px-3 rounded">+ Add Subject</button>
            </div>
            <div class="p-6">
                @if($subjects->isEmpty())
                    <p class="text-gray-600">No subjects found.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($subjects as $subject)
                            @if(is_object($subject))
                                <div class="bg-gray-50 p-4 rounded-lg relative">
                                    <div class="absolute top-2 right-2 flex space-x-2">
                                        <button class="editSubjectBtn text-purple-600 hover:text-purple-800" data-id="{{ $subject->id }}" data-name="{{ $subject->name }}" data-semester="{{ $subject->semester }}" data-year="{{ $subject->year }}" data-department-id="{{ $subject->department_id }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <h4 class="text-md font-medium text-gray-900">{{ $subject->name }}</h4>
                                    <p class="text-sm text-gray-600">Year: {{ ucfirst($subject->year) }} | Semester: {{ ucfirst($subject->semester) }} | Department: {{ is_object($subject->department) ? $subject->department->name : ucfirst($subject->department) }}</p>
                                    <p class="text-sm text-gray-600">{{ \App\Models\Lecture::where('subject_id', $subject->id)->count() }} lectures</p>
                                </div>
                            @else
                                <p class="text-red-500">Invalid subject data: {{ $subject }}</p>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Add Subject Modal -->
        <div id="addSubjectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Add New Subject</h3>
                        <button id="closeAddModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="addSubjectForm" action="{{ route('admin.subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject Name</label>
                            <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                            <select name="semester" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">Select Semester</option>
                                <option value="first">First</option>
                                <option value="second">Second</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <select name="year" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">Select Year</option>
                                <option value="first">First</option>
                                <option value="second">Second</option>
                                <option value="third">Third</option>
                                <option value="fourth">Fourth</option>
                                <option value="fifth">Fifth</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <select id="subjectDepartment" name="department_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">Select a department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancelAddBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Subject Modal -->
        <div id="editSubjectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Edit Subject</h3>
                        <button id="closeEditModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="editSubjectForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject Name</label>
                            <input type="text" id="editName" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                            <select id="editSemester" name="semester" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="first">First</option>
                                <option value="second">Second</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <select id="editYear" name="year" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="first">First</option>
                                <option value="second">Second</option>
                                <option value="third">Third</option>
                                <option value="fourth">Fourth</option>
                                <option value="fifth">Fifth</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <select id="editDepartment" name="department_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">Select a department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancelEditBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addSubjectBtn = document.getElementById('addSubjectBtn');
                const addSubjectModal = document.getElementById('addSubjectModal');
                const closeAddModal = document.getElementById('closeAddModal');
                const cancelAddBtn = document.getElementById('cancelAddBtn');
                const addSubjectForm = document.getElementById('addSubjectForm');

                const editSubjectModal = document.getElementById('editSubjectModal');
                const closeEditModal = document.getElementById('closeEditModal');
                const cancelEditBtn = document.getElementById('cancelEditBtn');
                const editSubjectForm = document.getElementById('editSubjectForm');

                // Show add modal
                addSubjectBtn.addEventListener('click', function() {
                    addSubjectModal.classList.remove('hidden');
                });

                // Hide add modal
                function hideAddModal() {
                    addSubjectModal.classList.add('hidden');
                    addSubjectForm.reset();
                }

                closeAddModal.addEventListener('click', hideAddModal);
                cancelAddBtn.addEventListener('click', hideAddModal);

                // Close add modal when clicking outside
                addSubjectModal.addEventListener('click', function(e) {
                    if (e.target === addSubjectModal) {
                        hideAddModal();
                    }
                });

                // Handle add form submission
                addSubjectForm.addEventListener('submit', function(e) {
                    // Optional: Add loading state or validation
                });

                // Edit subject functionality
                document.querySelectorAll('.editSubjectBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        const semester = this.getAttribute('data-semester');
                        const year = this.getAttribute('data-year');
                        const departmentId = this.getAttribute('data-department-id');

                        // Populate edit form
                        document.getElementById('editName').value = name;
                        document.getElementById('editSemester').value = semester;
                        document.getElementById('editYear').value = year;
                        document.getElementById('editDepartment').value = departmentId;

                        // Set form action
                        editSubjectForm.action = `/admin/subjects/${id}`;

                        // Show edit modal
                        editSubjectModal.classList.remove('hidden');
                    });
                });

                // Hide edit modal
                function hideEditModal() {
                    editSubjectModal.classList.add('hidden');
                    editSubjectForm.reset();
                }

                closeEditModal.addEventListener('click', hideEditModal);
                cancelEditBtn.addEventListener('click', hideEditModal);

                // Close edit modal when clicking outside
                editSubjectModal.addEventListener('click', function(e) {
                    if (e.target === editSubjectModal) {
                        hideEditModal();
                    }
                });

                // Handle edit form submission
                editSubjectForm.addEventListener('submit', function(e) {
                    // Optional: Add loading state or validation
                });
            });
        </script>
    </div>
</x-admin-layout>