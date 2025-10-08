# TODO: Add Subject Functionality

## Completed Tasks
- [x] Create Subject model with fillable fields: name, semester, year, department
- [x] Create migration for subjects table with enum columns for semester, year, department
- [x] Create SubjectController with index() and store() methods
- [x] Update routes/web.php to use SubjectController for subjects GET and add POST route
- [x] Update subjects.blade.php view to use Subject model, add modal for adding subjects with form fields
- [x] Run migration to create subjects table

## Next Steps
- [ ] Test the functionality by accessing the subjects page and adding a new subject
- [ ] Verify that the subject is saved to the database and displayed in the list
- [ ] Check for any errors in form validation or display
