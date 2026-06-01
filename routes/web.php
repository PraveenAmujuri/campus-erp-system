<?php

use App\Http\Controllers\ProfileController;
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
| Staff Management Routes
|--------------------------------------------------------------------------
*/

Route::get(
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


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';