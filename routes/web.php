<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ListTourController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

Route::get('language/{language}', [LanguageController::class, 'index'])->name('language');
Route::get('/', function () {
    return view('home');
})->name('home');

require __DIR__ . '/auth.php';

Route::resource('tours', TourController::class)->only([
    'index', 'show',
]);

Route::middleware('role')->prefix('admin')->group(function () {
    Route::resource('/', AdminController::class)->only([
        'index',
    ]);
    Route::resource('/admintours', ListTourController::class)
        ->middleware('role');

    Route::resource('/categories', CategoryController::class)->except([
        'show', 'destroy',
    ]);
});

Route::get('search/', [TourController::class, 'search'])->name('search');

Route::middleware(['auth'])->group(function () {

    Route::resource('profile', UserController::class)->only([
        'index', 'show', 'store', 'update',
    ]);

    Route::post('reviews/upload', [ReviewController::class, 'uploadImageToDir'])
        ->name('reviews.upload');

    Route::get('/heart', [LikeController::class, 'likeReview'])->name('heart');

    Route::resource('comments', CommentController::class)->only([
        'index', 'show', 'store',
    ])->middleware(['auth']);
});
