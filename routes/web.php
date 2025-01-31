<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/explore", [PostController::class, 'explore'])->name('explore');
Route::get("/users/{user:username}", [UserController::class, 'index'])->middleware('auth')->name('users.profile');

Route::controller(PostController::class)->middleware("auth")->group(function() {
    Route::get('/', 'index')->name('posts.index');
    Route::get('/p/create', 'create')->name('posts.create');
    Route::post('/p/create', 'store')->name('posts.store');
    Route::get('/p/{post:slug}', 'show')->name('posts.show');
    Route::get('/p/{post:slug}/edit', 'edit')->name('posts.edit');
    Route::patch('/p/{post:slug}', 'update')->name('posts.update');
    Route::delete('/p/{post:slug}/delete', 'destroy')->name("posts.delete");
});

Route::post('/p/{post:slug}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
