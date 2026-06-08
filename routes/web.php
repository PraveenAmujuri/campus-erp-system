<?php

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentAttendanceController;

use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\AttendanceController;
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
<<<<<<< HEAD
| Student Management Routes
=======
| Staff Management Routes
>>>>>>> staff-management-module
|--------------------------------------------------------------------------
*/

Route::get(
<<<<<<< HEAD
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

Route::post(
    '/students/attendance/bulk',
    [
        StudentAttendanceController::class,
        'bulkStore'
    ]
);
=======
    '/staff',
    [StaffController::class, 'index']
)->middleware('auth');

Route::post(
    '/staff',
    [StaffController::class, 'store']
)->middleware('auth');

Route::get(
    '/staff/{staff}/edit',
    [StaffController::class, 'edit']
)->middleware('auth');

Route::put(
    '/staff/{staff}',
    [StaffController::class, 'update']
)->middleware('auth');

Route::delete(
    '/staff/{staff}',
    [StaffController::class, 'destroy']
)->middleware('auth');



 /*                                                                         
| -------------------------------------------------------------------------- 
| Staff Attendance Routes                                                    
| -------------------------------------------------------------------------- 
 */                                                                         

Route::get(
'/staff/attendance',
[AttendanceController::class, 'index']
)->middleware('auth');

Route::post(
'/staff/attendance',
[AttendanceController::class, 'store']
)->middleware('auth');

Route::put(
'/staff/attendance/{attendance}',
[AttendanceController::class, 'update']
)->middleware('auth');

Route::delete(
'/staff/attendance/{attendance}',
[AttendanceController::class, 'destroy']
)->middleware('auth');

>>>>>>> staff-management-module

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
require __DIR__.'/auth.php';
=======
require __DIR__.'/auth.php';
>>>>>>> staff-management-module
