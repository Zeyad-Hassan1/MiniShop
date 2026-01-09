<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\authcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
Route::get('/', function () {
    return view('home');
});

Route::get('/register' , [authcontroller::class , 'showregisterform'])->name('register.form');
Route::post('/register' , [authcontroller::class , 'register'])->name('register');
Route::get('/login' , [authcontroller::class , 'showloginform'])->name('login.form');
Route::post('/login' , [authcontroller::class , 'login'])->name('login');

// Route::get('products' , function(){
//     return view('products.index');
// });
Route::get('products' , [productcontroller::class , 'index'])->name('products');
Route::get('products/{id}', [productcontroller::class, 'show'])->name('products.show');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::get('/purchase', [CartController::class, 'purchase'])->name('purchase');

Route::get('/confirm-purchase', [ConfirmationController::class, 'showConfirmation'])->name('checkout.confirmation');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history')->middleware('auth');

Route::post('/cart/increase/{id}', [cartcontroller::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::post('/logout' , [authcontroller::class , 'logout'])->name('logout');

Route::post('/locale', function () {
    $locale = request('locale');
    if (in_array($locale, ['en', 'ar'])) {
        session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('locale.switch');

Route::post('/require-login', function () {
    $msg = request('redirect_message', '');
    return redirect()->route('login')->with('redirect_message', $msg);
})->name('require.login');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users/{user}/toggle-admin', [DashboardController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');
    Route::delete('/admin/users/{user}', [DashboardController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/products/create', [DashboardController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/products', [DashboardController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [DashboardController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [DashboardController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [DashboardController::class, 'destroyProduct'])->name('admin.products.destroy');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');