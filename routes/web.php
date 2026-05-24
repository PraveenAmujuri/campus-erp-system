<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ProfileController;

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
/*
Profile Management Routes
Routes for authenticated users to manage
profile information and account settings.
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});
require __DIR__.'/auth.php';