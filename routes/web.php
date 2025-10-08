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
use Illuminate\Support\Facades\Auth;

Route::prefix('admin/api')->group(function () {
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
    Route::get('reports', function () {
        return view('admin.reports');
    })->name('reports');
    Route::view('professors', 'admin.professors')->name('professors');
    Route::get('lectures', [LectureController::class, 'index'])->name('lectures');
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});

// مسارات مشتركة بين المدير والبروفيسور (مثل الـ API الذي تحتاجه القائمة المنسدلة) - محمية بـ AdminOrProfessorMiddleware
Route::middleware([AdminOrProfessorMiddleware::class])
    ->prefix('admin') // المسار ما يزال يبدأ بـ /admin/ كما هو مطلوب في الفرونت إند
    ->name('admin.')
    ->group(function () {
        Route::get('generate-qr', [\App\Http\Controllers\Admin\QrCodeController::class, 'index'])->name('generate-qr');
        Route::post('api/generate-qr', [\App\Http\Controllers\Admin\QrCodeController::class, 'generateQrCode']);

        // 🚨 التعديل الرئيسي: API لـ halls تم وضعه هنا ليكون متاحاً للمدير والبروفيسور
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('lectures', [LectureController::class, 'index'])->name('api.lectures');
            // مسار القاعات: AdminOrProfessorMiddleware يسمح لكلا الدورين بالوصول
            Route::apiResource('halls', \App\Http\Controllers\Admin\HallController::class); 
        });

        Route::get('advanced-scheduler', [LectureController::class, 'advancedScheduler'])->name('advanced-scheduler');
        
    });

// ⛔️⛔️ تم حذف المجموعة المكررة التي كانت تحتوي على API halls ومحمية فقط بـ AdminMiddleware ⛔️⛔️
// هذا الجزء تم حذفه لأنه كان يسبب التضارب والصلاحية المقيدة:
/* Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('api')->name('api.')->group(function () {
        Route::apiResource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::patch('users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
        // Route::apiResource('halls', \App\Http\Controllers\Admin\HallController::class); // هذا هو السطر الذي تم نقله/حذفه
    });
}); 
*/


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
Route::middleware([StudentMiddleware::class])->prefix('student')->name('student.')->group(function () {
    Route::get('dashboard', function () {
        return view('student.dashboard');
    })->name('dashboard');
});