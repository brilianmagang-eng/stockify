<?php

use Illuminate\Support\Facades\Route;

// Baris-baris ini ditambahkan untuk memberitahu Laravel Controller mana yang akan kita gunakan.
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute default yang sudah ada, biarkan saja.
Route::get('/', function () {
    return view('welcome');
});

// === KODE DARI LANGKAH 3 DITAMBAHKAN DI SINI ===

// [cite_start];// Rute untuk menampilkan dashboard admin [cite: 55]
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// [cite_start];// Rute untuk manajemen pengguna (CRUD) oleh Admin [cite: 11, 73]
// Route::resource('/admin/users', UserController::class);

// // [cite_start];// Rute untuk manajemen produk (CRUD) oleh Admin [cite: 9, 62]
// Route::resource('/admin/products', ProductController::class);

// Anda bisa menambahkan rute lain di sini sesuai kebutuhan, misalnya untuk supplier
// use App\Http\Controllers\Admin\SupplierController;
// Route::resource('/admin/suppliers', SupplierController::class);