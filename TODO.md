# TODO: Automate Hall Status Based on Lectures

## Overview
Implement automatic hall status updates: 'booked' when a lecture starts, 'available' when it ends. Include overlap checks and time-based automation.

## Steps
- [x] Identify lecture creation file (e.g., Livewire component or controller for adding lectures) - Found: app/Http/Controllers/Admin/LectureController.php (store method)
- [x] Enhance Hall model: Add `isOccupiedAt()` and `updateStatusBasedOnLectures()` methods
- [x] Enhance Lecture model: Add `overlapsWith()` method for conflict checks
- [x] Enhance Booking model: Add `overlapsWith()` method (and consider adding `end_time` field via migration)
- [x] Create Artisan command: `UpdateHallStatuses` for scheduled status updates
- [x] Update Kernel.php: Schedule the command to run every 5 minutes
- [x] Modify lecture creation flow: Add overlap validation before saving lecture
- [x] Update HallBookingController: Add overlap checks in `book()` and recompute status in `release()`
- [x] Update views: Display dynamic status in hall/lecture management pages
- [x] Create migration: Add `end_time` to bookings if keeping manual bookings with duration
- [x] Test: Run migrations, schedule, and verify status changes
- [x] Edge cases: Handle ongoing lectures at startup, multiple lectures per hall
- [x] Fix modal: Update JavaScript to use data attributes and add CSRF token; fix route middleware
