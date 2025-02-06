<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
// use App\Http\Controllers\KasirController;
use App\Http\Controllers\PenjualanController;

Route::get('/', [dashboard::class, 'index'])->name('dashboard')->middleware('auth');
// register,login,logout
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('login/keluar', [LoginController::class, 'keluar'])->name('login.keluar');


Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('auth');
Route::post('/produk/tambah', [ProdukController::class, 'upload'])->name('produk.tambah')->middleware('auth');
Route::delete('/produk/hapus/{id}', [ProdukController::class, 'delete'])->name('produk.hapus')->middleware('auth');
Route::put('/produk/update', [ProdukController::class, 'update'])->name('produk.update')->middleware('auth');


Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
// Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
// Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);

//pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan')->middleware('auth');
Route::post('/pelanggan/tambah', [PelangganController::class, 'upload'])->name('pelanggan.tambah')->middleware('auth');
Route::delete('/pelanggan/hapus/{id}', [PelangganController::class, 'delete'])->name('pelanggan.hapus')->middleware('auth');
Route::put('/pelanggan/update', [PelangganController::class, 'update'])->name('pelanggan.update')->middleware('auth');
//Route::get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');

// Route::get('/register', [dashboard::class, 'register'])->name('register');

Route::get('/kasir', [\App\Http\Controllers\KasirController::class, 'index'])->name('kasir')->middleware('auth');
Route::post('/kasir/simpan', [\App\Http\Controllers\KasirController::class, 'simpan'])->name('kasir.simpan')->middleware('auth');