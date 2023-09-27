<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaseTrackerApi;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Landing Page
Route::get('/', [UserController::class, 'landing_page'])->name('landing_page');

// Testing Page
Route::get('/testing', function () {
});

// User Routes
Route::get('/register_user', [UserController::class, 'register_user'])->name('register_user');
Route::get('/user_privacy', [UserController::class, 'user_privacy'])->name('user_privacy');
Route::get('/user_terms', [UserController::class, 'user_terms'])->name('user_terms');
Route::get('/register_user', [UserController::class, 'register_user'])->name('register_user');


// Dashboard Routes
Route::middleware(['auth', 'verified'])->name('dashboard.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('index');
    Route::get('/add_tracker', [TrackerController::class, 'addtracker'])->name('addtracker');
    Route::get('/save_tracker', [TrackerController::class, 'save_tracker'])->name('save_tracker');
    Route::get('/trackers/remove/{tracker}', [TrackerController::class, 'remove'])->name('remove_tracker');
    Route::get('/setting', [UserController::class, 'setting'])->name('setting');
    Route::get('/active_tracker', [UserController::class, 'activeTracker'])->name('active_tracker');
    Route::post('/user_email', [UserController::class, 'userEmailStore'])->name('user_email');
    Route::get('/case_information', [CaseTrackerApi::class, 'case_information']);
    Route::get('/support', [UserController::class, 'support'])->name('support');
    Route::get('/privacy', [UserController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [UserController::class, 'terms'])->name('terms');
    Route::get('/payment', [UserController::class, 'payment'])->name('payment');
    Route::get('/subscription_cancel', [SubscriptionController::class, 'subscriptionCancel'])->name('subscription_cancel');
    Route::post('/renew_subscription', [RegisteredUserController::class, 'renewSubscription'])->name('renew_subscription');
});





require __DIR__ . '/auth.php';
