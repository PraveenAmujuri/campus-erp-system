<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard');

});

Route::middleware(['auth', 'role:faculty'])->group(function () {

    Route::get('/faculty/dashboard', [DashboardController::class, 'facultyDashboard'])
        ->name('faculty.dashboard');

});

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])
        ->name('student.dashboard');

});

require __DIR__.'/auth.php';