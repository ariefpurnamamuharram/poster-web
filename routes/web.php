<?php

use App\Http\Controllers\DeleteController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
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

Route::prefix('file')->group(function () {
    Route::get('poster/{posterID}', [DisplayController::class, 'showPoster'])->name('show.poster');
});

Route::prefix('vote')->group(function () {
    Route::prefix('poster')->group(function () {
        Route::post('like', [VoteController::class, 'like'])->name('poster.vote.like');
        Route::post('dislike', [VoteController::class, 'dislike'])->name('poster.vote.dislike');
    });
});

Route::prefix('user')->group(function () {
    Route::post('change-password', [UserController::class, 'changePassword'])->name('user.change.password');
});

Route::prefix('administrator')->group(function () {
    Route::get('home', [App\Http\Controllers\AdministratorController::class, 'index'])->name('administrator.home');

    Route::prefix('manager')->group(function () {
        Route::prefix('poster')->group(function () {
            Route::get('/', [ManagerController::class, 'poster'])->name('administrator.manager.poster');
            Route::post('delete', [DeleteController::class, 'deletePoster'])->name('administrator.manager.poster.delete');
        });
    });

    Route::prefix('upload')->group(function () {
        Route::prefix('poster')->group(function () {
            Route::get('/', [UploadController::class, 'poster'])->name('administrator.upload.poster');
            Route::post('post', [UploadController::class, 'uploadPoster'])->name('administrator.upload.poster.post');
        });
    });
});
