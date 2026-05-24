<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;


Route::get('/', function () {
    return view('welcome');
});
//admin protected routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    /**
     * Display all system users.
     */
    Route::get('/admin/users', [UserManagementController::class, 'index'])
        ->name('admin.users.index');

    /**
     * Display user creation form.
     */
    Route::get('/admin/users/create', [UserManagementController::class, 'create'])
        ->name('admin.users.create');

    /**
     * Store newly created users.
     */
    Route::post('/admin/users', [UserManagementController::class, 'store'])
        ->name('admin.users.store');

});
//faculty protected routes
Route::middleware(['auth', 'role:faculty'])->group(function () {

    Route::get('/faculty/dashboard', [DashboardController::class, 'facultyDashboard'])
        ->name('faculty.dashboard');

});
//student protected routes
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])
        ->name('student.dashboard');

});

require __DIR__.'/auth.php';