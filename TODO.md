# TODO: Add Subject Functionality

## Completed Tasks
- [x] Create Subject model with fillable fields: name, semester, year, department
- [x] Create migration for subjects table with enum columns for semester, year, department
- [x] Create SubjectController with index() and store() methods
- [x] Update routes/web.php to use SubjectController for subjects GET and add POST route
- [x] Update subjects.blade.php view to use Subject model, add modal for adding subjects with form fields
- [x] Run migration to create subjects table

## Completed Tasks: Update Lecture Subject to Select Dropdown
- [x] Update LectureController index() to pass subjects to view
- [x] Change subject input to select dropdown in lecture-management.blade.php for both add and edit modals
- [x] Populate select options with subjects from database

## Next Steps
- [ ] Test the functionality by accessing the subjects page and adding a new subject
- [ ] Test the lecture management page to ensure subject dropdown is populated and works correctly
- [ ] Verify that the form submission still works with the selected subject
- [ ] Check for any errors in form validation or display
