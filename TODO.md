# TODO List for Performance Page Implementation

## Current Work
Implementing a Performance page for admins with filters for year, semester, department, and subject, displaying relevant subjects or attendance data.

## Key Technical Concepts
- Laravel Controller for handling requests and data fetching.
- Blade views for UI with filters and dynamic loading via AJAX.
- Models: Subject, StudentSubjectAttendance, Department for data relationships.
- Routes: Adding new admin route protected by middleware.
- AJAX for dynamic dropdown population and data display.

## Relevant Files and Code
- New: app/Http/Controllers/Admin/PerformanceController.php - Handles index and API methods for filters.
- Edit: routes/web.php - Add route for performance.
- Edit: resources/views/components/admin-layout.blade.php - Update Performance link.
- New: resources/views/admin/performance.blade.php - View with filters and display logic.
- Models already exist: Subject, StudentSubjectAttendance, etc.

## Problem Solving
- Reuse existing filtering logic from SubjectController.
- Ensure dynamic subject loading based on year/semester/department selections.
- Display performance data like attendance counts per subject.

## Pending Tasks and Next Steps
- [x] Step 1: Create app/Http/Controllers/Admin/PerformanceController.php with index method to render view and API method to filter subjects by year, semester, department.
- [x] Step 2: Add route in routes/web.php: Route::get('performance', [PerformanceController::class, 'index'])->name('performance'); under admin middleware group.
- [x] Step 3: Update resources/views/components/admin-layout.blade.php to change Performance href to {{ route('admin.performance') }}.
- [x] Step 4: Create resources/views/admin/performance.blade.php with filter dropdowns (year, semester, department), AJAX to load subjects, and display section for subjects with attendance stats.
- [x] Step 5: Verify implementation (e.g., via browser or commands if needed). Route registered, server running, ready for testing.

Quote from recent conversation: "I want you to help me and do these things." - User confirmation to proceed.
