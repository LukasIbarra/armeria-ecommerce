<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CartController;

Route::name('web.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('category.show');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Additional cart routes like add, remove can be added later
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
