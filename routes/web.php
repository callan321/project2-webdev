<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        // Redirect to home if authenticated
        return redirect()->route('home');
    }

    // Otherwise, return the welcome view
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




Route::get('/home', [CourseController::class, 'index'])->name('home');
Route::get('/courses/{code}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/assessments/{id}', [AssessmentController::class, 'show'])->name('assessments.show');





Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');




Route::get('/assessments/create/{course_id}', [AssessmentController::class, 'create'])->name('assessments.create');
Route::get('/assessments/{id}/edit', [AssessmentController::class, 'edit'])->name('assessments.edit');
Route::put('/assessments/{id}', [AssessmentController::class, 'update'])->name('assessments.update');
Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');

// Routes for submitting and storing peer reviews
Route::get('/assessments/{id}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/assessments/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/assessments/{id}/marking', [ReviewController::class, 'marking'])->name('reviews.marking');





