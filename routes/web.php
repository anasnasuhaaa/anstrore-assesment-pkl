<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\OrderlistShowController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderArrivedController;


Route::get('/', [UserProductController::class, 'all']);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin routes
Route::prefix('admin')->middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Product Routes
    Route::resource('product', ProductController::class)->names([
        'index' => 'admin.product.index',
        'create' => 'admin.product.create',
        'store' => 'admin.product.store',
        'show' => 'admin.product.show',
        'edit' => 'admin.product.edit',
        'update' => 'admin.product.update',
        'destroy' => 'admin.product.destroy',
    ]);

    // Payment Routes
    Route::resource('payment', PaymentController::class)->names([
        'index' => 'admin.payment.index',
        'create' => 'admin.payment.create',
        'store' => 'admin.payment.store',
        'show' => 'admin.payment.show',
        'edit' => 'admin.payment.edit',
        'update' => 'admin.payment.update',
        'destroy' => 'admin.payment.destroy',
    ]);

    // Order List Routes
    Route::get('/orderlist', [OrderListController::class, 'index'])->name('admin.orderlist.index');
    Route::get('/orderlist/{id}', [OrderListController::class, 'show'])->name('admin.orderlist.show');
    Route::post('/orderlist/{id}', [OrderListController::class, 'approve'])->name('admin.orderlist.approve');

    // Export Routes
    Route::get('/export/orderlist', [OrderListController::class, 'export'])->name('download.excel');
    Route::get('/export/product', [ProductController::class, 'export'])->name('product.excel');
});

// User routes
Route::prefix('user')->middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'userEdit'])->name('profile.useredit');

    // User Order List Routes
    Route::get('/orderlist', [OrderListController::class, 'userIndex'])->name('user.orderlist.index');
    Route::get('/orderlist/{id}', [OrderlistShowController::class, 'show'])->name('user.orderlist.show');
    Route::post('/orderlist/{id}/arrived', [OrderArrivedController::class, 'store'])->name('user.orderlist.arrived');
    Route::get('/orderlist/{id}/review', [ReviewController::class, 'index'])->name('user.orderlist.review');
    Route::post('/orderlist/{id}', [ReviewController::class, 'store'])->name('review.store');

    // Checkout Routes
    Route::post('/product/{id}', [UserProductController::class, 'checkout'])->name('product.checkout');
    Route::get('/product/{id}/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/product/{id}/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Product Routes
Route::get('/product/{id}', [UserProductController::class, 'show'])->name('product.detail');
Route::get('/product/qr/{id}', [UserProductController::class, 'qr'])->name('qrcode.download');
Route::get('/products', [UserProductController::class, 'all'])->name('products.index');
Route::get('/products/filter/{category}', [UserProductController::class, 'filter'])->name('products.filter');
