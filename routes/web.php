<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentAttendanceController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})
->middleware(['auth', 'verified'])
->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Management Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Student Management Routes
|--------------------------------------------------------------------------
*/

Route::get(
    '/students',
    [StudentController::class, 'index']
)->middleware('auth');

Route::post(
    '/students',
    [StudentController::class, 'store']
)->middleware('auth');

Route::put(
    '/students/{student}',
    [StudentController::class, 'update']
)->middleware('auth');

Route::delete(
    '/students/{student}',
    [StudentController::class, 'destroy']
)->middleware('auth');

/*
|--------------------------------------------------------------------------
| Student Attendance Routes
|--------------------------------------------------------------------------
*/

Route::get(
    '/students/attendance',
    [StudentAttendanceController::class, 'index']
)->middleware('auth');

Route::post(
    '/students/attendance',
    [StudentAttendanceController::class, 'store']
)->middleware('auth');

Route::delete(
    '/students/attendance/{attendance}',
    [StudentAttendanceController::class, 'destroy']
)->middleware('auth');

Route::put(
    '/students/attendance/{attendance}',
    [StudentAttendanceController::class, 'update']
)->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
