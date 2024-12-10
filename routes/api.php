<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api')->name('user');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:instructor')->group(function () {
        Route::get('/instructor/courses', [CourseController::class, 'index'])->name('instructor.courses.index');
        Route::post('/courses/create', [CourseController::class, 'store'])->name('courses.store');
        Route::put('/courses/update/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/delete/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
        Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
    });

    Route::middleware('role:student')->group(function () {
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('enroll');
        Route::get('/courses/{course}/progress', [EnrollmentController::class, 'progress'])->name('progress');
        Route::post('/courses/{course}/review', [ReviewController::class, 'store'])->name('review.store');
    });


    Route::get('/courses/{course}/lessons/{lesson_id}', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
});