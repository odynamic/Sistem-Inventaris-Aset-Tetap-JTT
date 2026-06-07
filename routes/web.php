<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Domains
use App\Http\Controllers\Domains\Assets\AssetController;
use App\Http\Controllers\Domains\Assets\UserAssetController;

use App\Http\Controllers\Domains\Submissions\SubmissionController;
use App\Http\Controllers\Domains\Submissions\UserSubmissionController;

use App\Http\Controllers\Domains\Surveys\SurveyController;
use App\Http\Controllers\Domains\Surveys\UserSurveyController;

use App\Http\Controllers\Domains\Reports\ReportController;

use App\Http\Controllers\Domains\Rooms\RoomController;
use App\Http\Controllers\Domains\Users\UserController;

// Profile & Logs
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ActivityLogController;




/* =====================================================
| WELCOME
===================================================== */
Route::get('/', fn() => view('welcome'))->name('welcome');



/* =====================================================
| DASHBOARD REDIRECT
===================================================== */
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');


/* =====================================================
| ADMIN
===================================================== */
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('dashboard');

        /* -------------------------
        | CRUD ASET
        ------------------------- */
        Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
        Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
        Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');
        /* -------------------------
        | CRUD ROOMS
        ------------------------- */
        Route::resource('rooms', RoomController::class);

        /* -------------------------
        | CRUD USERS (unit)
        ------------------------- */
        Route::resource('users', UserController::class);

        /* -------------------------
        | SUBMISSIONS (validasi)
        ------------------------- */
        Route::get('submissions', [SubmissionController::class, 'index'])
            ->name('submissions.index');

        Route::get('submissions/{id}', [SubmissionController::class, 'show'])
            ->name('submissions.show');

        Route::post('submissions/{id}/verify', [SubmissionController::class, 'verify'])
            ->name('submissions.verify');


        /* -------------------------
        | SURVEYS
        ------------------------- */
        Route::resource('surveys', SurveyController::class);

        Route::get('surveys/{survey}/fill', [SurveyController::class, 'fillForm'])
            ->name('surveys.fillForm');

        Route::post('surveys/{survey}/fill', [SurveyController::class, 'fillStore'])
            ->name('surveys.fillStore');

            

        Route::post('surveys/{survey}/approve', [SurveyController::class, 'approve'])
            ->name('surveys.approve');

        Route::post('surveys/{survey}/reject', [SurveyController::class, 'reject'])
            ->name('surveys.reject');


        /* -------------------------
        | REPORTS
        ------------------------- */
        Route::prefix('reports')->name('reports.')->group(function () {

            Route::get('/', [ReportController::class, 'index'])
                ->name('index');

            Route::get('/assets', [ReportController::class, 'assets'])
                ->name('assets');

            Route::get('/surveys', [ReportController::class, 'surveys'])
                ->name('surveys');

            Route::get('/submissions', [ReportController::class, 'submissions'])
                ->name('submissions');
        });

        


        
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('/assets/rooms/{unit_id}', [AssetController::class, 'getRooms'])
            ->name('assets.rooms');

        Route::get('/assets/get-next-code/{unit_id}/{room_id}', [AssetController::class, 'getNextCode'])
            ->name('assets.getNextCode');
    });

        /* -------------------------
        | ACTIVITY LOG
        ------------------------- */
        Route::get('/activity-log', [ActivityLogController::class, 'index'])
            ->name('activity.index');



            Route::prefix('profile')->name('profile.')->group(function () {
            
            Route::get('/', [ProfileController::class, 'index'])
                ->name('index');

            Route::post('/', [ProfileController::class, 'update'])
                ->name('update'); // Menggunakan POST /profile untuk update

            Route::post('/password', [ProfileController::class, 'updatePassword'])
                ->name('password');
        });
    });





/* =====================================================
| USER
===================================================== */
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'user'])
            ->name('dashboard');


        /* -------------------------
        | ASSETS (READ ONLY)
        ------------------------- */
        Route::get('/assets', [UserAssetController::class, 'index'])
            ->name('assets.index');


        /* -------------------------
        | USER SUBMISSIONS
        ------------------------- */
        Route::get('/submissions', [UserSubmissionController::class, 'index'])
            ->name('submissions.index');

        Route::get('/submissions/create', [UserSubmissionController::class, 'create'])
            ->name('submissions.create');

        Route::post('/submissions', [UserSubmissionController::class, 'store'])
            ->name('submissions.store');

        Route::get('/submissions/{id}', [UserSubmissionController::class, 'show'])
            ->name('submissions.show');

        Route::post('/submissions/{id}/cancel', [UserSubmissionController::class, 'cancel'])
            ->name('submissions.cancel');


        // AJAX for submissions
        Route::get('/rooms', [UserSubmissionController::class, 'getUserRooms'])
            ->name('rooms.byUnit');

        Route::get('/assets/by-room/{room_id}', [UserSubmissionController::class, 'getAssets'])
            ->name('assets.byRoom');

        Route::get('/assets/detail/{id}', [UserSubmissionController::class, 'getAssetDetail'])
            ->name('assets.detail');


        /* -------------------------
        | SURVEYS USER
        ------------------------- */
        Route::prefix('surveys')->name('surveys.')->group(function () {

            // History
            Route::get('/history/list', [UserSurveyController::class, 'history'])
                ->name('history');

            // Active surveys
            Route::get('/', [UserSurveyController::class, 'index'])
                ->name('index');

            // Fill survey
            Route::get('/{survey}/fill', [UserSurveyController::class, 'fillForm'])
                ->name('fillForm');

            Route::post('/{survey}/fill', [UserSurveyController::class, 'fillStore'])
                ->name('fillStore');

            // Show
            Route::get('/{survey}', [UserSurveyController::class, 'show'])
                ->name('show');
        });


        /* -------------------------
        | USER PROFILE
        ------------------------- */
        Route::prefix('profile')->name('profile.')->group(function () {

            Route::get('/', [UserProfileController::class, 'index'])
                ->name('index');

            Route::post('/update', [UserProfileController::class, 'update'])
                ->name('update');

            Route::post('/password', [UserProfileController::class, 'updatePassword'])
                ->name('password');

        });
    });





// Tandai satu notifikasi sebagai terbaca
Route::post('/notifications/{id}/read', function ($id) {
    $notif = auth()->user()->notifications()->find($id);
    if ($notif) $notif->markAsRead();
    return back();
})->name('notifications.read');

// Tandai semua notifikasi sebagai terbaca
Route::post('/notifications/mark-all-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAllRead');



/* =====================================================
| AUTH ROUTES (Breeze)
===================================================== */
require __DIR__.'/auth.php';
