<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ProfessorMiddleware;
use App\Http\Middleware\AdminOrProfessorMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Livewire\Admin\Classrooms;
use App\Livewire\Admin\Users;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Professor\HallController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Auth;

Route::middleware([AdminOrProfessorMiddleware::class])->prefix('admin/api')->group(function () {
    Route::get('lectures-by-date', [LectureController::class, 'lecturesByDate']);
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'professor') {
            return redirect()->route('professor.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    })->name('dashboard');

    // Halls Booking Routes
    Route::get('/halls', [\App\Http\Controllers\HallBookingController::class, 'index'])->name('halls.index');
    Route::post('/halls/{hall}/book', [\App\Http\Controllers\HallBookingController::class, 'book'])->name('halls.book');
    Route::post('/halls/{hall}/release', [\App\Http\Controllers\HallBookingController::class, 'release'])->name('halls.release');
});

// مسارات واجهة المدير (Admin Panel Routes) - محمية بـ AdminMiddleware
Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users', function () {
        return view('admin.users');
    })->name('users');
    Route::get('classrooms', Classrooms::class)->name('classrooms');
    Route::get('halls', function () {
        return view('admin.hall-management');
    })->name('halls');
    Route::get('subjects', [App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('subjects');
    Route::post('subjects', [App\Http\Controllers\Admin\SubjectController::class, 'store'])->name('subjects.store');
    Route::view('professors', 'admin.professors')->name('professors');
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});

// مسارات مشتركة بين المدير والبروفيسور (مثل الـ API الذي تحتاجه القائمة المنسدلة) - محمية بـ AdminOrProfessorMiddleware
Route::middleware([AdminOrProfessorMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('lectures', [LectureController::class, 'index'])->name('lectures'); // تم نقل هذا من AdminMiddleware
        Route::get('generate-qr', [\App\Http\Controllers\Admin\QrCodeController::class, 'index'])->name('generate-qr');
        Route::post('api/generate-qr', [\App\Http\Controllers\Admin\QrCodeController::class, 'generateQrCode']);

        // 🚨 التعديل الرئيسي: API لـ halls وlectures تم وضعه هنا ليكون متاحاً للمدير والبروفيسور
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('lectures', [LectureController::class, 'index'])->name('api.lectures');
            Route::apiResource('halls', \App\Http\Controllers\Admin\HallController::class);
            Route::apiResource('lectures', LectureController::class); // إضافة هذا لدعم POST وCRUD الكامل
        });

        Route::get('advanced-scheduler', [LectureController::class, 'advancedScheduler'])->name('advanced-scheduler');

       
    });

// مسارات البروفيسور (Professor Routes) - محمية بـ AdminOrProfessorMiddleware
Route::middleware([AdminOrProfessorMiddleware::class])->prefix('professor')->name('professor.')->group(function () {
    Route::get('dashboard', function () {
        return redirect()->route('halls.index'); // Redirect professor dashboard to halls page
    })->name('dashboard');

    Route::get('lectures', [LectureController::class, 'index'])->name('lectures');

    Route::prefix('api')->name('api.')->group(function () {
        Route::apiResource('lectures', LectureController::class);
        Route::get('lectures-by-date', [LectureController::class, 'lecturesByDate']);
    });
});

// مسارات البروفيسور (Professor Routes) - محمية بـ ProfessorMiddleware فقط (قد تحتاج إلى مراجعة استخدام هذا الـ Middleware)
Route::middleware([ProfessorMiddleware::class])->prefix('professor')->name('professor.')->group(function () {
    Route::get('dashboard', function () {
        return redirect()->route('halls.index'); // Redirect professor dashboard to halls page
    })->name('dashboard');
});

// مسارات الطالب (Student Routes)
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

use App\Http\Controllers\StudentDashboardController;

Route::middleware([StudentMiddleware::class])->prefix('student')->name('student.')->group(function () {
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('subjects', [StudentDashboardController::class, 'subjects'])->name('subjects');
    Route::get('scan-qr', [StudentDashboardController::class, 'scanQr'])->name('scan-qr');
    Route::post('scan-qr', [AttendanceController::class, 'scanQr'])->name('scan-qr.scan');
    Route::get('attendance', [StudentDashboardController::class, 'attendance'])->name('attendance');
});
