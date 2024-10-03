<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});

// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/home', [CourseController::class, 'index'])->name('home');
    Route::get('/courses/{code}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/assessments/{id}', [AssessmentController::class, 'show'])->name('assessments.show');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
});
