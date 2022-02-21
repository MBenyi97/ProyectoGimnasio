<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome view
Route::get('/', function () {
    return view('welcome');
});

// Home view after logging in
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware(['auth', 'verified']);

// Auth routes with verification middleware
Auth::routes(['verify' => true]);

// Other routes
Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
Route::resource('activities', ActivityController::class)->middleware(['auth', 'verified']);
Route::resource('sesions', SesionController::class)->middleware(['auth', 'verified']);

// Group of reservations routes
Route::controller(ReservationController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('reservations/filter', 'filter');
        Route::post('reservations/create/{id}', 'create');
        // Destroy sesion route and redirect to user id
        Route::delete('reservations/{userId}/{sesionId}', 'userSesionDestroy');
        Route::resource('reservations', ReservationController::class);
    });

// Shows the email verification view
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Recevies the verification hash and redirects to home
Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resends the verification email
Route::post('/email/verification-notificaion', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Email de verificación reenviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Images route
Route::get('img/{filename}', [ImageController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Resource routes
|--------------------------------------------------------------------------
|
| Route::get('method', [IndexController::class, 'index']);
| Route::get('method/create', [IndexController::class, 'create']);
| Route::get('method/{id}', [IndexController::class, 'show']);
| Route::post('method', [IndexController::class, 'store']);
| Route::get('method/{id}/edit', [IndexController::class, 'edit']);
| Route::put('method/{id}', [IndexController::class, 'update']);
| Route::delete('method/{id}', [IndexController::class, 'destroy']);
|
*/
