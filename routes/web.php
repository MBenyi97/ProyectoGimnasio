<?php

use App\Http\Controllers\MemberController;
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

Route::resource('members', MemberController::class);
// Route::get('members', [MemberController::class, 'index']);
// Route::get('members/create', [MemberController::class, 'create']);
// Route::get('members/{id}', [MemberController::class, 'show']);
// Route::post('members', [MemberController::class, 'store']);
// Route::get('members/{id}/edit', [MemberController::class, 'edit']);
// Route::put('members/{id}', [MemberController::class, 'update']);
// Route::delete('members/{id}', [MemberController::class, 'destroy']);
