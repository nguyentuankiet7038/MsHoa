<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

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
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.get');
Route::get('/login',[AuthController::class, 'showLogin'])->name('login');



Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/registration/{id}', [EnrollmentController::class, 'enrollmentCourse'])->name('enrollments.registration');
