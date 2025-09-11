<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Import semua controller yang dibutuhkan
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\StockTransactionController;
use App\Http\Controllers\Admin\UserController; // Controller baru
use App\Http\Controllers\Admin\ReportController; // Controller baru

use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
// Jika Anda belum punya Controller Manajer, buatlah. Untuk sementara bisa pakai yang Admin.
// use App\Http\Controllers\Manager\ProductController as ManagerProductController;
// use App\Http\Controllers\Manager\StockController as ManagerStockController;

use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
// Jika Anda belum punya Controller Staff, buatlah. Untuk sementara bisa pakai yang Admin.

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama ('/') akan dialihkan ke login jika belum login
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    // Jika sudah login, arahkan ke dashboard sesuai peran
    $role = auth()->user()->role;
    if ($role == 'admin') return redirect()->route('admin.dashboard');
    if ($role == 'manager') return redirect()->route('manager.dashboard');
    if ($role == 'staff') return redirect()->route('staff.dashboard');
});

// Rute untuk login dan logout
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');


// Grup Rute yang Dilindungi Middleware Autentikasi
Route::middleware('auth')->group(function () {
    
    // Grup Rute untuk ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Rute CRUD yang sudah ada
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        
        // Rute Stok untuk Admin
        Route::get('stock', [StockTransactionController::class, 'index'])->name('stock.index');
        Route::get('stock/create', [StockTransactionController::class, 'create'])->name('stock.create');
        Route::post('stock', [StockTransactionController::class, 'store'])->name('stock.store');

        // --- RUTE BARU DITAMBAHKAN DI SINI ---
        Route::resource('users', UserController::class);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // Grup Rute untuk MANAGER (Sekarang diaktifkan)
    // Manajer dan Admin bisa mengakses ini
    Route::middleware('role:manager,admin')->prefix('manager')->name('manager.')->group(function () {
        Route::get('dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
        // Contoh: Manajer bisa melihat produk
        // Route::get('products', [ManagerProductController::class, 'index'])->name('products.index');
        // Contoh: Manajer bisa menambah stok
        // Route::get('stock/create', [ManagerStockController::class, 'create'])->name('stock.create');
        // Route::post('stock', [ManagerStockController::class, 'store'])->name('stock.store');
    });

    // Grup Rute untuk STAFF (Sekarang diaktifkan)
    // Staff, Manajer, dan Admin bisa mengakses ini
    Route::middleware('role:staff,manager,admin')->prefix('staff')->name('staff.')->group(function () {
        Route::get('dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
        // Contoh: Rute untuk staff konfirmasi barang
        // Route::post('tasks/{task}/confirm', [StaffTaskController::class, 'confirm'])->name('tasks.confirm');
    });

});