<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\SupportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Giao diện người dùng
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::post('/support/chat', [SupportController::class, 'chat'])->name('support.chat');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    
    // Help Center (AI Teaching)
    Route::prefix('help-center')->group(function () {
        Route::get('/', [HelpCenterController::class, 'index'])->name('admin.help-center.index');
        Route::post('/', [HelpCenterController::class, 'store'])->name('admin.help-center.store');
        Route::put('/{id}', [HelpCenterController::class, 'update'])->name('admin.help-center.update');
        Route::delete('/{id}', [HelpCenterController::class, 'destroy'])->name('admin.help-center.destroy');
        Route::patch('/{id}/toggle', [HelpCenterController::class, 'toggleStatus'])->name('admin.help-center.toggle');
    });
    Route::get('/courses', [CourseController::class, 'admincourses'])->name('admin.courses');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

    // Teachers
    Route::get('/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');

    //marketing
    Route::prefix('marketing')->group(function () {
        Route::get('/', [MarketingController::class, 'index'])->name('marketing.admin');
        Route::post('/', [MarketingController::class, 'store'])->name('admin.marketing.store');
        Route::put('/{campaign}', [MarketingController::class, 'update'])->name('admin.marketing.update');
        Route::delete('/{campaign}', [MarketingController::class, 'destroy'])->name('admin.marketing.destroy');
        Route::post('/{campaign}/broadcast', [MarketingController::class, 'broadcast'])->name('admin.marketing.broadcast');
    });

    //payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.admin');
    Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::get('/payment/export/csv', [PaymentController::class, 'exportCSV'])->name('payment.export');

    //help-center
    Route::get('/help-center', [HelpCenterController::class, 'index'])->name('admin.help-center.index');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/registration/{id}', [EnrollmentController::class, 'enrollmentCourse'])->name('enrollments.registration');
