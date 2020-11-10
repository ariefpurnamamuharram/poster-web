<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\AdministratorController::class, 'index'])->name('home');
Route::post('/change-password', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('change.password');
