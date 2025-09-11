<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\StockTransactionController;
use App\Http\Controllers\Manager\StockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda mendaftarkan rute web untuk aplikasi Anda.
|
*/

// --- PERUBAHAN DI SINI ---
// Halaman utama ('/') sekarang akan otomatis mengarahkan ke halaman login.
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk menampilkan form login dan memprosesnya
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');


// Grup Rute yang Dilindungi Middleware Autentikasi
Route::middleware('auth')->group(function () {
    
    // Grup Rute untuk ADMIN
    // Hanya pengguna dengan peran 'admin' yang bisa mengakses URL berawalan /admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Rute resource untuk semua fitur CRUD Admin
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        
        // Rute untuk Stock Management
        Route::get('stock', [StockTransactionController::class, 'index'])->name('stock.index');
        Route::get('stock/create', [StockTransactionController::class, 'create'])->name('stock.create');
        Route::post('stock', [StockTransactionController::class, 'store'])->name('stock.store');
    });

     // Grup Rute untuk MANAGER
    // Route::middleware('role:manager')->prefix('manager')->name('manager.')->group(function () {
    //     Route::get('dashboard', [\App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('dashboard');
    //     Route::get('products', [\App\Http\Controllers\Manager\ProductController::class, 'index'])->name('products.index');
    //     Route::get('stock/in/create', [\App\Http\Controllers\Manager\StockController::class, 'createIn'])->name('stock.createIn');
    //     Route::post('stock/in', [\App\Http\Controllers\Manager\StockController::class, 'storeIn'])->name('stock.storeIn');
    //     Route::get('stock/out/create', [\App\Http\Controllers\Manager\StockController::class, 'createOut'])->name('stock.createOut');
    //     Route::post('stock/out', [\App\Http\Controllers\Manager\StockController::class, 'storeOut'])->name('stock.storeOut');
    // });

    // Grup Rute untuk STAFF
    // Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
    //     Route::get('dashboard', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('dashboard');
    //     // Anda bisa menambahkan rute lain untuk staff di sini, misalnya konfirmasi
    // });

});