<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/transaksi/pembelian', [App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian_index');
Route::post('/transaksi/pembelian/tambah', [App\Http\Controllers\PembelianController::class, 'tambahTransaksi'])->name('pembelian_tambah');
Route::get('/transaksi/pembelian/{id}/view', [App\Http\Controllers\PembelianController::class, 'viewTransaksi'])->name('pembelian_view');
Route::get('/transaksi/pembelian/{id}/delete', [App\Http\Controllers\PembelianController::class, 'deleteBarang'])->name('pembelian_delete_barang');
Route::get('/transaksi/pembelian/{id}/print', [App\Http\Controllers\PembelianController::class, 'print'])->name('pembelian_print');
Route::post('/transaksi/pembelian/store', [App\Http\Controllers\PembelianController::class, 'store'])->name('pembelian_store');
Route::post('/transaksi/pembelian/bayar', [App\Http\Controllers\PembelianController::class, 'submitBayar'])->name('pembelian_bayar');

Route::get('/master/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('master_barang');
Route::get('/master/barang/{id}', [App\Http\Controllers\BarangController::class, 'show'])->name('master_barang_show');
Route::post('/master/barang/store', [App\Http\Controllers\BarangController::class, 'store'])->name('master_barang_simpan');
Route::get('/master/barang/{id}/edit', [App\Http\Controllers\BarangController::class, 'edit'])->name('master_barang_edit');
Route::post('/master/barang/update', [App\Http\Controllers\BarangController::class, 'update'])->name('master_barang_update');
Route::get('/master/barang/{id}/delete', [App\Http\Controllers\BarangController::class, 'delete'])->name('master_barang_delete');

Route::get('/master/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('master_pelanggan');
Route::post('/master/pelanggan/store', [App\Http\Controllers\PelangganController::class, 'store'])->name('master_pelanggan_simpan');
Route::get('/master/pelanggan/{id}/edit', [App\Http\Controllers\PelangganController::class, 'edit'])->name('master_pelanggan_edit');
Route::post('/master/pelanggan/update', [App\Http\Controllers\PelangganController::class, 'update'])->name('master_pelanggan_update');
Route::get('/master/pelanggan/{id}/delete', [App\Http\Controllers\PelangganController::class, 'delete'])->name('master_pelanggan_delete');

Route::get('/master/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('master_supplier');
Route::post('/master/supplier/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('master_supplier_simpan');
Route::get('/master/supplier/{id}/edit', [App\Http\Controllers\SupplierController::class, 'edit'])->name('master_supplier_edit');
Route::post('/master/supplier/update', [App\Http\Controllers\SupplierController::class, 'update'])->name('master_supplier_update');
Route::get('/master/supplier/{id}/delete', [App\Http\Controllers\SupplierController::class, 'delete'])->name('master_supplier_delete');

Route::get('/setting/toko', [App\Http\Controllers\SettingTokoController::class, 'index'])->name('setting_toko');
Route::get('/setting/toko/edit', [App\Http\Controllers\SettingTokoController::class, 'edit'])->name('setting_toko_edit');
Route::post('/setting/toko', [App\Http\Controllers\SettingTokoController::class, 'update'])->name('setting_toko_update');
