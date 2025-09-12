<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Import semua controller yang dibutuhkan
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\StockTransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\ProductController as ManagerProductController;
use App\Http\Controllers\Manager\StockController as ManagerStockController;

use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\StaffStockController;

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
        Route::resource('products', AdminProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::get('stock', [StockTransactionController::class, 'index'])->name('stock.index');
        Route::get('stock/create', [StockTransactionController::class, 'create'])->name('stock.create');
        Route::post('stock', [StockTransactionController::class, 'store'])->name('stock.store');
        Route::resource('users', UserController::class);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // Grup Rute untuk MANAGER
    Route::middleware('role:manager,admin')->prefix('manager')->name('manager.')->group(function () {
        Route::get('dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ManagerProductController::class)->except(['destroy']);
        Route::get('/stock/in/create', [ManagerStockController::class, 'createIn'])->name('stock.createIn');
        Route::get('/stock/out/create', [ManagerStockController::class, 'createOut'])->name('stock.createOut');
        Route::post('/stock', [ManagerStockController::class, 'store'])->name('stock.store');
        Route::get('/stock/opname', [\App\Http\Controllers\Manager\StockController::class, 'opnameCreate'])->name('stock.opnameCreate');
        Route::post('/stock/opname', [\App\Http\Controllers\Manager\StockController::class, 'opnameStore'])->name('stock.opnameStore');
    });

    // Grup Rute untuk STAFF
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
    // Dashboard (Daftar Tugas)
    Route::get('dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    
    // Halaman untuk menampilkan detail konfirmasi
    Route::get('stock/{transaction}/confirm', [StaffStockController::class, 'showConfirm'])->name('stock.confirm');
    
    // Aksi untuk memproses konfirmasi
    Route::post('stock/{transaction}/confirm', [StaffStockController::class, 'processConfirm'])->name('stock.processConfirm');
    
    // RUTE BARU: Aksi untuk membatalkan transaksi
    Route::post('stock/{transaction}/cancel', [StaffStockController::class, 'processCancel'])->name('stock.processCancel');
});

});