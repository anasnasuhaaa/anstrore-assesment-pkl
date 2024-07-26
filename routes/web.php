<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $product = Product::all();
    return view('welcome', ['product' => $product]);
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Cateroty Route
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Product Route
    Route::resource('admin/product', ProductController::class);

    // Payment Route
    Route::resource('admin/payment', PaymentController::class);
});

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'userEdit'])->name('profile.useredit');
});
