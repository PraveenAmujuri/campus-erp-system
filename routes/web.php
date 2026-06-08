<?php

use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentAttendanceController;

use App\Models\Notification;
use App\Models\NotificationTemplate;

use Illuminate\Support\Facades\Mail;
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
| Notification Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/notifications', function () {

    $type = request('type');
    $search = request('search');

    $notifications = Notification::query();

    if ($search) {

        $notifications->where(function ($query) use ($search) {

            $query->where('recipient', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");

        });
    }

    if ($type && $type !== 'ALL') {

        $notifications->where('type', $type);
    }

    $notifications = $notifications->latest()->get();

    $templates = NotificationTemplate::all();

    $totalNotifications = Notification::count();
    $emailCount = Notification::where('type', 'EMAIL')->count();
    $smsCount = Notification::where('type', 'SMS')->count();
    $whatsappCount = Notification::where('type', 'WHATSAPP')->count();
    $failedCount = Notification::where('status', 'FAILED')->count();

    return view(
        'notifications.index',
        compact(
            'notifications',
            'templates',
            'type',
            'search',
            'totalNotifications',
            'emailCount',
            'smsCount',
            'whatsappCount',
            'failedCount'
        )
    );

})->middleware('auth');

Route::post(
    '/notifications',
    [NotificationController::class, 'store']
)->middleware('auth');

Route::put(
    '/notifications/{notification}',
    [NotificationController::class, 'update']
)->middleware('auth');

Route::delete(
    '/notifications/{notification}',
    [NotificationController::class, 'destroy']
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

/*
|--------------------------------------------------------------------------
| TEMPORARY TESTING ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/test-email', function () {

    Mail::raw(
        'This is a test email from Campus ERP Notification Module.',
        function ($message) {

            $message->to('suryahero2004@gmail.com')
                    ->subject('Campus ERP Test Email');

        }
    );

    return 'Test email sent successfully.';
});

Route::get('/send-test-notification', function () {

    app(
        \App\Services\Notification\NotificationService::class
    )->sendEmail([

        'recipient' => 'suryahero2004@gmail.com',
        'title' => 'ERP Service Test',
        'message' => 'NotificationService is working properly.'

    ]);

    return 'Notification sent successfully.';
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';