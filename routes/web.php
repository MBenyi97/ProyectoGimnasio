<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
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

Route::get('/', function () {
    return view('welcome');
});

// Shows user data if not admin
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('activities', ActivityController::class)->middleware('auth');
Route::resource('sesions', SesionController::class)->middleware('auth');
Route::controller(ReservationController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('reservations/filter', 'filter');
        Route::post('reservations/create/{id}', 'create');
        // Destroy route and redirect to user id
        Route::delete('reservations/{userId}/{sesionId}', 'userSesionDestroy');
        Route::resource('reservations', ReservationController::class);
    });


// Route::get('method', [IndexController::class, 'index']);
// Route::get('method/create', [IndexController::class, 'create']);
// Route::get('method/{id}', [IndexController::class, 'show']);
// Route::post('method', [IndexController::class, 'store']);
// Route::get('method/{id}/edit', [IndexController::class, 'edit']);
// Route::put('method/{id}', [IndexController::class, 'update']);
// Route::delete('method/{id}', [IndexController::class, 'destroy']);

Route::get('img/{filename}', [ImageController::class, 'showJobImage']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
