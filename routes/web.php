<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPeminjamanController;
use App\Http\Controllers\DataPeminjamanUserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'level:user'], function () {
    Route::get('/Dashboard', [DataPeminjamanUserController::class,'indexUser'])->name('dashboard.user');
    Route::get('/Tabel-Peminjaman', [DataPeminjamanUserController::class,'tabelPeminjaman'])->name('peminjaman.user');
    Route::get('/Pinjam-Kendaraan/{id}',[DataPeminjamanUserController::class,'pinjamKendaraan'])->name('form.pinjam');
    Route::post('/peminjaman/submit', [DataPeminjamanUserController::class, 'submitFormPinjam'])->name('peminjaman.submit');
    Route::post('/Progres-Peminjaman/{id}', [DataPeminjamanUserController::class, 'storePinjam'])->name('barang.store.pinjam');
});

Route::group(['middleware' => 'level:administrator'], function () {
Route::get('/Dashboard-Admin',[DataPeminjamanController::class,'index'])->name('dashboard.admin');
Route::get('/Tabel-Data-Peminjaman',[DataPeminjamanController::class,'tabelKendaraan'])->name('tabel.peminjaman');
Route::get('/Tambah-Kendaraan-Peminjaman',[DataPeminjamanController::class,'tambahKendaraan'])->name('tambah.kendaraan');
Route::get('/History-Kendaraan', [DataPeminjamanController::class,'historyKendaraan'])->name('history.kendaraan');
Route::post('/Progres-Tambah-Kendaraan', [DataPeminjamanController::class, 'store'])->name('kendaraan.store');
Route::get('/kendaraan/{id}/edit', [DataPeminjamanController::class, 'edit'])->name('kendaraan.edit');
Route::put('/kendaraan/{id}', [DataPeminjamanController::class, 'update'])->name('kendaraan.update');
Route::get('/kendaraan/keluar/{id}', [DataPeminjamanController::class, 'keluarKendaraan'])->name('kendaraan.keluar');
Route::put('/Proses-Keluar/{id}', [DataPeminjamanController::class, 'prosesKeluar'])->name('proses.keluar');
Route::get('/logout-admin', [AuthController::class,'LogoutAdmin'])->name('logout.admin');
});

Route::group(['middleware' => 'role:management'], function () {
    // Rute khusus untuk manajemen
});


// //Admin
// Route::get('/Dashboard-Peminjaman',[DataPeminjamanController::class,'index'])->name('dashboard.user');
// Route::get('/Tabel-Peminjaman',[DataPeminjamanController::class,'tabelKendaraan'])->name('tabel.peminjaman');
// Route::get('/Tambah-Kendaraan-Peminjaman',[DataPeminjamanController::class,'tambahKendaraan'])->name('tambah.kendaraan');
// Route::get('/History-Kendaraan', [DataPeminjamanController::class,'historyKendaraan'])->name('history.kendaraan');
// Route::post('/Progres-Tambah-Kendaraan', [DataPeminjamanController::class, 'store'])->name('kendaraan.store');
// Route::get('/kendaraan/{id}/edit', [DataPeminjamanController::class, 'edit'])->name('kendaraan.edit');
// Route::put('/kendaraan/{id}', [DataPeminjamanController::class, 'update'])->name('kendaraan.update');


Route::get('/login', [AuthController::class,'index'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', 'AuthController@logout')->name('logout');