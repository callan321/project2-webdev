<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// public routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});


// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});


// teacher  Routes
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

    Route::get('/assessments/create/{course_id}', [AssessmentController::class, 'create'])->name('assessments.create');
    Route::get('/assessments/{id}/edit', [AssessmentController::class, 'edit'])->name('assessments.edit');
    Route::put('/assessments/{id}', [AssessmentController::class, 'update'])->name('assessments.update');
    Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');

    // Teacher marking page
    Route::get('/assessments/{id}/marking', [ReviewController::class, 'marking'])->name('reviews.marking');


});

// auth routes
Route::middleware(['auth'])->group(function () {



    Route::get('/home', [CourseController::class, 'index'])->name('home');
    Route::get('/courses/{code}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/assessments/{id}', [AssessmentController::class, 'show'])->name('assessments.show');

    Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');

    // Peer review routes for students
    Route::get('/assessments/{id}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/assessments/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});



