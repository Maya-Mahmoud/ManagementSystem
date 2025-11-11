# TODO: Modify Advanced Scheduler for Professor Dropdown

## Step 1: Update LectureController::advancedScheduler()
- Fetch users with role 'professor' from the database.
- Pass the professors collection to the view.

## Step 2: Update advanced-scheduler.blade.php
- Replace the professor text input with a select dropdown.
- Populate the dropdown with professor names (only names, no role appended).
- Ensure the dropdown is required and has a placeholder.

## Step 3: Update LectureController::store()
- Add validation for 'professor_id' field (required, exists in users table with role professor).
- In the store logic, set 'user_id' to the selected professor_id and 'professor' to the selected user's name.
- Ensure the rest of the logic remains intact.

## Step 4: Test the Changes
- Verify the dropdown loads professors correctly.
- Test scheduling a lecture with a selected professor.
- Check that the lecture is created with the correct user_id and professor name.
