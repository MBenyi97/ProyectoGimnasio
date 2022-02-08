<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
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

Route::resource('users', UserController::class);
Route::resource('activities', ActivityController::class);
Route::resource('sesions', SesionController::class);
Route::controller(ReservationController::class)
    ->group(function () {
        Route::get('reservations/create/{id}', 'create');
        Route::delete('reservations/{id}', 'destroy');
        Route::get('reservations', 'index');
    });



// Route::get('/reservations', 'index');
// Route::get('/reservations/create/{id}', 'create');
// Route::delete('/reservations/{id}', 'destroy');


// Route::get('method', [IndexController::class, 'index']);
// Route::get('method/create', [IndexController::class, 'create']);
// Route::get('method/{id}', [IndexController::class, 'show']);
// Route::post('method', [IndexController::class, 'store']);
// Route::get('method/{id}/edit', [IndexController::class, 'edit']);
// Route::put('method/{id}', [IndexController::class, 'update']);
// Route::delete('method/{id}', [IndexController::class, 'destroy']);

Route::get('img/{filename}', [ImageController::class, 'showJobImage']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
