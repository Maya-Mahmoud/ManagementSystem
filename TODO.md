# QR Code Attendance System Implementation

## Current Task: Implement QR-based attendance for lectures

### Step 1: Create UI for QR Scanning (Priority)
- [x] Add route: GET /student/scan-qr
- [x] Create method in StudentDashboardController: scanQr() - returns view('student.scan-qr')
- [x] Create resources/views/student/scan-qr.blade.php with UI matching screenshot:
  - Header: "Scan QR Code to mark attendance"
  - Scan area: Black placeholder box with "Ready to scan" and circular icon
  - Button: "Start Scan" (purple)
  - Instructions: How to scan (1. Point camera, 2. Hold steady, 3. Wait for confirmation)
  - Use student-app layout
- [x] Update layouts/student-app.blade.php: Add navigation link to "Scan QR"
- [ ] Test UI: Access as student, verify page loads correctly

### Step 2: Backend Implementation (After UI Approval)
- [x] Create migration: create_lecture_attendances_table (student_id, lecture_id, status enum('present','absent'), scanned_at)
- [x] Create LectureAttendance model with relationships to Student and Lecture
- [x] Update QrCodeController::generateQrCode: After generating QR, create 'absent' records for eligible students in the lecture's department/year/subject
- [x] Add POST /student/scan-qr route to AttendanceController::scanQr: Decode QR (lecture ID), check eligibility, update to 'present', prevent duplicates
- [x] Integrate JS QR scanner in scan-qr.blade.php (e.g., html5-qrcode lib via CDN)
- [x] Add attendance() method to StudentDashboardController: Fetch grouped by subject (presents: count where status='present', absents: count where status='absent' and QR generated)
- [x] Create student/attendance.blade.php: List subjects with attendance/absence counts
- [x] Add route: GET /student/attendance
- [x] Update dashboard.blade.php: Add link to attendance page

### Step 3: Testing and Follow-up
- [x] Run migration: php artisan migrate
- [ ] Test QR generation: Creates absent records
- [ ] Test scanning: Updates to present, increments count
- [ ] Test attendance page: Displays correct counts per subject
- [ ] Handle edge cases: Invalid QR, already scanned, ineligible student
- [ ] Update Attendance model if needed (deprecate old one?)

Progress: Starting with UI creation.
