<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/create_product', [ProductController::class, 'create'])->name('products.create');
// Route::post('/create_product', [ProductController::class, 'store'])->name('products.store');

// Route::get('/dashboard', [ProductController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MypostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/mypost', [MypostController::class, 'index'])->name('mypost');



Route::middleware('auth')->group(function () {
    Route::get('/create_product', [ProductController::class, 'create'])->name('products.create');
    Route::post('/create_product', [ProductController::class, 'store'])->name('products.store');
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/create_post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/create_post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
