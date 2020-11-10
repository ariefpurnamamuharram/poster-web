<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::prefix('user')->group(function () {
    Route::post('change-password', [UserController::class, 'changePassword'])->name('user.change.password');
});

Route::prefix('administrator')->group(function () {
    Route::get('home', [App\Http\Controllers\AdministratorController::class, 'index'])->name('administrator.home');
});