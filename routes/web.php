<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SesionController;
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
// Route::get('member', [MemberController::class, 'index']);
// Route::get('member/create', [MemberController::class, 'create']);
// Route::get('member/{id}', [MemberController::class, 'show']);
// Route::post('member', [MemberController::class, 'store']);
// Route::get('member/{id}/edit', [MemberController::class, 'edit']);
// Route::put('member/{id}', [MemberController::class, 'update']);
// Route::delete('member/{id}', [MemberController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
