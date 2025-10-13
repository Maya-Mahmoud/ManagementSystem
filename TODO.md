# TODO: Add Edit and Delete Functionality to Subjects Cards

## Current Work
- User requested adding edit (pencil icon) and delete (trash icon) icons at the top of each subject card in admin/subjects.blade.php.
- Plan approved: Add update/destroy methods to SubjectController, routes (already added), update view with icons and modals/forms.

## Key Technical Concepts
- Laravel routes: PUT for update, DELETE for destroy.
- Blade templating: Add icons using Heroicons or similar, modals for edit, forms for delete with CSRF.
- JavaScript: Handle modal population for edit, confirmation for delete.
- Model relations: Subject hasMany Lectures; delete will cascade due to foreign key.

## Relevant Files and Code
- routes/web.php: Added PUT subjects/{subject} and DELETE subjects/{subject}.
- app/Http/Controllers/Admin/SubjectController.php: Needs update() and destroy() methods.
- resources/views/admin/subjects.blade.php: Add icons in card header, edit modal (similar to add modal), delete form.
- app/Models/Subject.php: Existing hasMany Lectures.

## Problem Solving
- Ensure delete checks for associated lectures? For now, allow cascade delete.
- Edit modal: Pre-populate fields with subject data via data attributes or JS fetch.

## Pending Tasks and Next Steps
1. Add update() method to SubjectController: Validate input, update subject, redirect with success.
   - Quote: "إضافة method update لتعديل المادة (عبر modal)."
2. Add destroy() method to SubjectController: Find subject, delete, redirect with success. Handle if lectures exist (optional soft delete).
   - Quote: "إضافة method destroy في SubjectController لحذف المادة."
3. Update subjects.blade.php:
   - Add edit icon (e.g., Heroicon pencil) and delete icon (trash) in each card's top-right.
   - Create edit modal similar to add modal, with form action to update route, pre-fill data.
   - For delete: Use form with @method('DELETE') and CSRF, add JS confirmation.
   - Load subject data for edit via data-id or inline script.
   - Quote: "تعديل subjects.blade.php لإضافة أيقونات التعديل (قلم) والحذف (سلة) في أعلى كل كرت. للتعديل: فتح modal لتعديل المادة. للحذف: form مع تأكيد أو مباشر."
4. Test: Add/edit/delete subjects, ensure no errors, lectures cascade if deleted.
   - Run server, simulate actions.

Progress: [ ] 1 [ ] 2 [ ] 3 [ ] 4
