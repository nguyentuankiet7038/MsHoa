<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\LearningProgressController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TeacherDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course/{id}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('form.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('form.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- OTP ROUTES ---
Route::get('/otp', [\App\Http\Controllers\OtpController::class, 'show'])->name('otp.show');
Route::post('/otp/verify', [\App\Http\Controllers\OtpController::class, 'verify'])->name('otp.verify');
Route::post('/otp/resend', [\App\Http\Controllers\OtpController::class, 'resend'])->name('otp.resend');

// --- SOCIAL LOGIN ROUTES ---
Route::get('/auth/google', [\App\Http\Controllers\SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\SocialAuthController::class, 'handleGoogleCallback']);

// --- AUTHENTICATED USER ROUTES ---
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    // Notifications
    Route::get('/api/notifications/unread', [\App\Http\Controllers\NotificationController::class, 'getUnread'])->name('notifications.unread');
    Route::post('/api/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/api/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
});

// --- STUDENT ROUTES ---
Route::middleware(['auth', 'role:student,user'])->group(function () {
    Route::post('/registration/{id}', [App\Http\Controllers\EnrollmentController::class, 'enrollmentCourse'])->name('enrollments.registration');
    Route::get('/my-grades', [App\Http\Controllers\LearningProgressController::class, 'studentIndex'])->name('student.grades');
    Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support');
    Route::post('/support/chat', [App\Http\Controllers\SupportController::class, 'chat'])->name('support.chat');
    
    // Feedback & Course History
    Route::get('/my-courses', [\App\Http\Controllers\FeedbackController::class, 'index'])->name('student.courses');
    Route::get('/feedback/create/{classid}', [\App\Http\Controllers\FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback/store/{classid}', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');
});

// --- TEACHER ROUTES ---
Route::middleware(['auth', 'role:teacher,admin'])->prefix('teacher')->group(function () {
    Route::get('/schedule', [TeacherDashboardController::class, 'schedule'])->name('teacher.schedule');
    Route::get('/grades-attendance', [TeacherDashboardController::class, 'gradesAttendance'])->name('teacher.grades_attendance');
    Route::post('/grades-attendance/update', [TeacherDashboardController::class, 'updateGradesAttendance'])->name('teacher.grades_attendance.update');
});

// --- SHARED DASHBOARD ROUTES (Admin & Consultant) ---
Route::middleware(['auth', 'role:admin,consultant'])->prefix('dashboard')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    
    // Payments (Consultant can confirm, Admin can manage)
    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payment.admin');
        Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');
        Route::post('/', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('payment.show');
        Route::get('/export/csv', [PaymentController::class, 'exportCSV'])->name('payment.export');
    });

    // Registrations (Consultant manages registrations)
    Route::prefix('registrations')->group(function () {
        Route::get('/', [EnrollmentController::class, 'index'])->name('admin.registrations.index');
        Route::get('/{id}/edit', [EnrollmentController::class, 'edit'])->name('admin.registrations.edit');
        Route::put('/{id}', [EnrollmentController::class, 'update'])->name('admin.registrations.update');
        Route::delete('/{id}', [EnrollmentController::class, 'destroy'])->name('admin.registrations.destroy');
    });

    // Help Center (Support)
    Route::prefix('help-center')->group(function () {
        Route::get('/', [HelpCenterController::class, 'index'])->name('admin.help-center.index');
    });

    // --- ADMIN ONLY WITHIN DASHBOARD ---
    Route::middleware(['role:admin'])->group(function () {
        
        // Users Management
        Route::prefix('users')->group(function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
            Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');
            Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
        });

        // Courses
        Route::prefix('courses')->group(function () {
            Route::get('/', [CourseController::class, 'admincourses'])->name('admin.courses');
            Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
            Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
            Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
            Route::put('/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
            Route::delete('/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
        });

        // Teachers
        Route::prefix('teachers')->group(function () {
            Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
            Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
            Route::post('/', [TeacherController::class, 'store'])->name('admin.teachers.store');
            Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
            Route::put('/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
            Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
        });

        // Students
        Route::prefix('students')->group(function () {
            Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
            Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
            Route::post('/', [StudentController::class, 'store'])->name('admin.students.store');
            Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
            Route::put('/{id}', [StudentController::class, 'update'])->name('admin.students.update');
            Route::delete('/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
        });

        // Learning Progress
        Route::prefix('learning-progress')->group(function () {
            Route::get('/', [LearningProgressController::class, 'index'])->name('admin.learning-progress.index');
            Route::get('/create', [LearningProgressController::class, 'create'])->name('admin.learning-progress.create');
            Route::post('/', [LearningProgressController::class, 'store'])->name('admin.learning-progress.store');
            Route::get('/{id}/edit', [LearningProgressController::class, 'edit'])->name('admin.learning-progress.edit');
            Route::put('/{id}', [LearningProgressController::class, 'update'])->name('admin.learning-progress.update');
            Route::delete('/{id}', [LearningProgressController::class, 'destroy'])->name('admin.learning-progress.destroy');
        });

        // Marketing
        Route::prefix('marketing')->group(function () {
            Route::get('/', [MarketingController::class, 'index'])->name('marketing.admin');
            Route::post('/', [MarketingController::class, 'store'])->name('admin.marketing.store');
            Route::put('/{campaign}', [MarketingController::class, 'update'])->name('admin.marketing.update');
            Route::delete('/{campaign}', [MarketingController::class, 'destroy'])->name('admin.marketing.destroy');
            Route::post('/{campaign}/broadcast', [MarketingController::class, 'broadcast'])->name('admin.marketing.broadcast');
        });

        // Classes
        Route::prefix('classes')->group(function () {
            Route::get('/', [ClassesController::class, 'index'])->name('admin.classes.index');
            Route::get('/create', [ClassesController::class, 'create'])->name('admin.classes.create');
            Route::post('/', [ClassesController::class, 'store'])->name('admin.classes.store');
            Route::get('/get-students', [ClassesController::class, 'getAvailableStudents'])->name('admin.classes.getStudents');
            Route::get('/get-teachers', [ClassesController::class, 'getAvailableTeachers'])->name('admin.classes.getTeachers');
            Route::post('/auto-arrange', [ClassesController::class, 'autoArrange'])->name('admin.classes.autoArrange');
            
            Route::get('/{id}', [ClassesController::class, 'show'])->name('admin.classes.show');
            Route::get('/{id}/edit', [ClassesController::class, 'edit'])->name('admin.classes.edit');
            Route::put('/{id}', [ClassesController::class, 'update'])->name('admin.classes.update');
            Route::delete('/{id}', [ClassesController::class, 'destroy'])->name('admin.classes.destroy');
            Route::get('/{id}/export', [ClassesController::class, 'exportExcel'])->name('admin.classes.export');
        });

        // Help Center (Admin can edit training data)
        Route::prefix('help-center')->group(function () {
            Route::post('/', [HelpCenterController::class, 'store'])->name('admin.help-center.store');
            Route::put('/{id}', [HelpCenterController::class, 'update'])->name('admin.help-center.update');
            Route::delete('/{id}', [HelpCenterController::class, 'destroy'])->name('admin.help-center.destroy');
            Route::patch('/{id}/toggle', [HelpCenterController::class, 'toggleStatus'])->name('admin.help-center.toggle');
        });
    });
});
