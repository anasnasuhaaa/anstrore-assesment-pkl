<?php

use App\Models\Product;
use App\Models\Category;
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

Route::get('/', function () {
    $products = Product::all()->map(function ($product) {
        if ($product->averageRating()) {
            $product->average_rating = number_format($product->averageRating(), 1, '.', '.');
        } else {
            $product->average_rating = number_format(0, 1, '.', '.');
        }
        return $product;
    });
    $categories = Category::all();



    return view('welcome', compact('products', 'categories'));
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

    // Order List Route
    Route::get('/admin/orderlist', [OrderListController::class, 'index'])->name('admin.orderlist.index');
    Route::get('/admin/orderlist/{id}', [OrderListController::class, 'show'])->name('admin.orderlist.show');
    Route::post('/admin/orderlist/{id}', [OrderListController::class, 'approve'])->name('admin.orderlist.approve');
    // Export Excel
    Route::get('/export/orderlist', [OrderListController::class, 'export'])->name('download.excel');
    Route::get('/export/product', [ProductController::class, 'export'])->name('product.excel');
});

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'userEdit'])->name('profile.useredit');

    Route::get('/user/orderlist', [OrderListController::class, 'userIndex'])->name('user.orderlist.index');
    Route::get('/user/orderlist/{id}', [OrderlistShowController::class, 'show'])->name('user.orderlist.show');
    // Route::post('/user/orderlist/{id}', [OrderArrivedController::class, 'store'])->name('order.arrived');
    Route::post('/orderlist/{id}', [OrderArrivedController::class, 'store'])->name('order.arrived');
    Route::get('/user/orderlist/{id}/review', [ReviewController::class, 'index'])->name('user.orderlist.review');
    Route::post('/user/orderlist/{id}', [ReviewController::class, 'store'])->name('review.store');

    Route::post('/product/{id}', [UserProductController::class, 'checkout'])->name('product.checkout');
    Route::get('/user/product/{id}/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/user/product/{id}/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});
// Product Route
Route::get('/product/{id}', [UserProductController::class, 'show'])->name('product.detail');
Route::get('/product/qr/{id}', [UserProductController::class, 'qr'])->name('qrcode.download');

Route::get('/products', [UserProductController::class, 'all'])->name('products.index');
Route::get('/products/filter/{category}', [UserProductController::class, 'filter'])->name('products.filter');
