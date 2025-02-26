<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return auth()->user()->role == "admin" ? redirect()->route('admin.dashboard') : redirect()->route('purchase.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::post('/purchase/{product}', [PurchaseController::class, 'buy'])->name('purchase.buy');
    Route::get('/purchase/history', [PurchaseController::class, 'history'])->name('purchase.history');
});



require __DIR__.'/auth.php';
