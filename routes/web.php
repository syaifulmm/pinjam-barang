<?php

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [ClientController::class, 'index'])->name('guest');
Route::get('/add/{id}', [ClientController::class, 'add'])->name('cart.add');
Route::get('/status', [ClientController::class, 'status']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');
Route::resource('barang', \App\Http\Controllers\BarangController::class);
Route::post('barang/import_excel', [\App\Http\Controllers\BarangController::class, 'import'])->name('barang-upload');
Route::get('barang/export_excel', [BarangController::class, 'export'])->name('barang-download');
Route::resource('peminjaman', \App\Http\Controllers\PeminjamanController::class);
Route::put('peminjaman/{id}/accept', [PeminjamanController::class, 'accept'])->name('peminjaman.accept');
Route::put('peminjaman/{id}/deny', [PeminjamanController::class, 'deny'])->name('peminjaman.deny');
Route::get('/pengambilan', [PeminjamanController::class, 'pengambilan']);
Route::get('/pengambilan/{id_barang}', [PeminjamanController::class, 'ambil']);
Route::post('/pengambilan/{id_barang}/ambil', [PeminjamanController::class, 'bukti_ambil'])->name('ambil.bukti');
Route::get('kategori', [BarangController::class, 'kategori'])->name('kategori.index');
Route::post('kategori', [BarangController::class, 'kategori_store'])->name('kategori.store');
Route::delete('kategori/{id}/hapus', [BarangController::class, 'kategori_destroy'])->name('kategori.destroy');
Route::get('kategori/{id}/edit', [BarangController::class, 'kategori_edit'])->name('kategori.edit');
Route::put('kategori/{id}', [BarangController::class, 'kategori_update'])->name('kategori.update');


