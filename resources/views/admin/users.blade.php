<x-admin-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #editUserModal, #addUserModal {
            display: none;
        }

        #editUserModal:not(.hidden), #addUserModal:not(.hidden) {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        #editUserModal .relative {
            max-width: 96%;
        }
    </style>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <p class="text-gray-600">Manage system users, roles, and permissions</p>
        </div>

        <!-- Sub Navigation -->
        <div class="bg-white shadow-sm rounded-lg mb-6">
            <div class="px-6 py-4">
                <nav class="flex space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Overview
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-purple-600 border-b-2 border-purple-600">
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
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Subject
                    </a>
                </nav>
            </div>
        </div>

        <!-- Search and Filters - مطابق للصورة -->
        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="searchInput" placeholder="Search users..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <select id="roleFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white min-w-[120px]">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="professor">Professor</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                </div>
                <button id="addUserBtn" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add User
                </button>
            </div>
        </div>

        <!-- Users Table - مطابق للصورة -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                        <!-- Users will be loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Add New User</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="addUserForm">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="userName" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="userEmail" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="userRole" name="role" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="professor">Professor</option>
                            <option value="student">Student</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" id="userPassword" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" id="userPasswordConfirm" name="password_confirmation" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Edit User</h3>
                    <button id="closeEditModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="editUserForm">
                    @csrf
                    <input type="hidden" id="editUserId" name="user_id">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="editUserName" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="editUserEmail" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="editUserRole" name="role" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="professor">Professor</option>
                            <option value="student">Student</option>
                        </select>
                    </div>



                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelEditBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // تعريف الدوال خارج النطاق الداخلي عشان تكون متاحة عالميًا
        async function editUser(userId) {
            console.log('editUser called with ID:', userId);

            try {
                console.log('Fetching user data from:', `/admin/api/users/${userId}`);
                const response = await fetch(`/admin/api/users/${userId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                console.log('Response status:', response.status);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const user = await response.json();
                console.log('User data received:', user);

                // Populate the edit form
                document.getElementById('editUserId').value = user.id;
                document.getElementById('editUserName').value = user.name;
                document.getElementById('editUserEmail').value = user.email;
                document.getElementById('editUserRole').value = user.role;

                // Show the edit modal
                const editUserModal = document.getElementById('editUserModal');
                console.log('Showing edit modal - current classes:', editUserModal.className);
                editUserModal.classList.remove('hidden');
                editUserModal.style.display = 'flex';
                console.log('Modal classes after toggle:', editUserModal.className);

            } catch (error) {
                console.error('Network Error:', error);
                alert('خطأ في تحميل بيانات المستخدم: ' + error.message);
            }
        }

        async function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                try {
                    const response = await fetch(`/admin/api/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        const result = await response.json();
                        alert(result.message || 'Error deleting user');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error deleting user');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addUserBtn = document.getElementById('addUserBtn');
            const addUserModal = document.getElementById('addUserModal');
            const closeModal = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const addUserForm = document.getElementById('addUserForm');
            const searchInput = document.getElementById('searchInput');
            const roleFilter = document.getElementById('roleFilter');

            // Edit modal elements
            const editUserModal = document.getElementById('editUserModal');
            const closeEditModal = document.getElementById('closeEditModal');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const editUserForm = document.getElementById('editUserForm');

            let allUsers = [];

            // Show modal
            addUserBtn.addEventListener('click', function() {
                addUserModal.classList.remove('hidden');
            });

            // Hide modal
            function hideModal() {
                addUserModal.classList.add('hidden');
                addUserForm.reset();
            }

            closeModal.addEventListener('click', hideModal);
            cancelBtn.addEventListener('click', hideModal);

            // Close modal when clicking outside
            addUserModal.addEventListener('click', function(e) {
                if (e.target === addUserModal) {
                    hideModal();
                }
            });

            // Edit modal event listeners
            function hideEditModal() {
                editUserModal.classList.add('hidden');
                editUserForm.reset();
            }

            closeEditModal.addEventListener('click', hideEditModal);
            cancelEditBtn.addEventListener('click', hideEditModal);

            // Close edit modal when clicking outside
            editUserModal.addEventListener('click', function(e) {
                if (e.target === editUserModal) {
                    hideEditModal();
                }
            });

            // Handle edit form submission
            editUserForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const data = Object.fromEntries(formData.entries());
                const userId = data.user_id;

                try {
                    const response = await fetch(`/admin/api/users/${userId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: data.name,
                            email: data.email,
                            role: data.role
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();

                    if (response.ok) {
                        alert('user updted successfully!');
                        location.reload();
                    } else {
                        alert(result.message || 'user update error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('user update error: ' + error.message);
                }
            });

            // Handle form submission
            addUserForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const data = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch('/admin/api/users', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert(result.message || 'Error creating user');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error creating user');
                }
            });

            // Load users on page load
            loadUsers();

            // Filter function
            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedRole = roleFilter.value;

                const filtered = allUsers.filter(user => {
                    const matchesSearch = user.name.toLowerCase().includes(searchTerm) || user.email.toLowerCase().includes(searchTerm);
                    const matchesRole = !selectedRole || user.role === selectedRole;
                    return matchesSearch && matchesRole;
                });

                updateUsersTable(filtered);
            }

            // Event listeners for filters
            searchInput.addEventListener('input', filterUsers);
            roleFilter.addEventListener('change', filterUsers);

            async function loadUsers() {
                try {
                    const response = await fetch('/admin/api/users');
                    const users = await response.json();

                    allUsers = users;
                    filterUsers();
                } catch (error) {
                    console.error('Error loading users:', error);
                }
            }

            function updateUsersTable(users) {
                const tbody = document.getElementById('usersTableBody');

                if (users.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">No users found</td></tr>';
                    return;
                }

                tbody.innerHTML = users.map(user => {
                    const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase();
                    const roleColors = {
                        'admin': 'purple',
                        'professor': 'blue',
                        'student': 'green'
                    };
                    const statusColors = {
                        'active': 'green',
                        'inactive': 'red'
                    };

                    return `
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-10 h-10 bg-${roleColors[user.role] || 'gray'}-500 rounded-full">
                                        <span class="text-sm font-medium text-white">${initials}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">${user.name}</div>
                                        <div class="text-sm text-gray-500">${user.email}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-${roleColors[user.role] || 'gray'}-100 text-${roleColors[user.role] || 'gray'}-800 text-xs px-2 py-1 rounded-full capitalize">${user.role}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${new Date(user.created_at).toLocaleDateString()}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-${statusColors[user.status] || 'gray'}-100 text-${statusColors[user.status] || 'gray'}-800 text-xs px-2 py-1 rounded-full capitalize">${user.status}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button onclick="editUser(${user.id})" class="text-purple-600 hover:text-purple-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteUser(${user.id})" class="text-red-600 hover:text-red-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                }).join('');
            }
        });
    </script>
</x-admin-layout>
