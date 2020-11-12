<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SettingsController;
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

// Auth routes.
Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/', [HomeController::class, 'home'])->name('home');

// File routes
Route::prefix('file')->group(function () {
    Route::prefix('poster')->group(function () {
        // Show poster route.
        Route::get('{posterID}', [DisplayController::class, 'showPoster'])->name('poster.show');

        // Comment route.
        Route::post('comment', [CommentController::class, 'commentPoster'])->name('poster.comment');

        // Vote routes.
        Route::prefix('vote')->group(function () {
            Route::post('like', [VoteController::class, 'like'])->name('poster.vote.like');
            Route::post('dislike', [VoteController::class, 'dislike'])->name('poster.vote.dislike');
        });
    });
});

// User routes.
Route::prefix('user')->group(function () {
    // Update routes.
    Route::prefix('update')->group(function () {
        Route::post('profile', [UserController::class, 'changeProfile'])->name('user.update.profile');
        Route::post('password', [UserController::class, 'changePassword'])->name('user.update.password');
    });
});

// Administrator routes.
Route::prefix('administrator')->group(function () {
    // Manager routes.
    Route::prefix('manager')->group(function () {
        // Poster manager routes.
        Route::prefix('poster')->group(function () {
            Route::get('all', [ManagerController::class, 'poster'])->name('administrator.manager.posters');
            Route::get('edit/{posterID}', [EditController::class, 'editPoster'])->name('administrator.manager.poster.edit');
            Route::post('update', [EditController::class, 'updatePoster'])->name('administrator.manager.poster.update');
            Route::post('delete', [DeleteController::class, 'deletePoster'])->name('administrator.manager.poster.delete');
        });
    });

    // Upload routes.
    Route::prefix('upload')->group(function () {
        // Poster upload routes.
        Route::prefix('poster')->group(function () {
            Route::get('/', [UploadController::class, 'poster'])->name('administrator.upload.poster');
            Route::post('post', [UploadController::class, 'uploadPoster'])->name('administrator.upload.poster.post');
        });
    });

    // Settings routes.
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'settingsPage'])->name('administrator.settings.page');
        Route::post('update', [SettingsController::class, 'updateSettings'])->name('administrator.settings.update');
    });
});
