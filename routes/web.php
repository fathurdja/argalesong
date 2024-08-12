<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\formBaruDaftarController;
use App\Http\Controllers\formeditDaftarController;
use App\Http\Controllers\JatuhTempoController;
use App\Http\Controllers\kp_bukanPelangganController;
use App\Http\Controllers\kp_PelangganController;
use App\Http\Controllers\pbAfiliasiController;
use App\Http\Controllers\pbSewaMenyewaController;
use App\Http\Controllers\pp_baruController;
use App\Http\Controllers\pp_pengajuan;
use App\Http\Controllers\Sp_bulananController;
use App\Http\Controllers\Sp_HarianController;
use App\Http\Controllers\tagihanController;
use App\Http\Controllers\UmurPiutangController;
use Illuminate\Support\Facades\Route;


Route::get('/', [dashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/login', function () {
    return view('loginform');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/form-tambah-tagihan', [tagihanController::class, 'create'])->name('tambahForm')->middleware('auth');
Route::get('/form-edit-daftar-pelanggan', [formeditDaftarController::class, 'index'])->name('daftarpelanggan')->middleware('auth');
Route::get('/form-baru-daftar-pelanggan', [formBaruDaftarController::class, 'index'])->name('daftarpelangganBaru')->middleware('auth');
Route::get('/form-pb-afiliasi', [pbAfiliasiController::class, 'index'])->name('afiliasi')->middleware('auth');
Route::get('/form-pb-sewa-menyewa', [pbSewaMenyewaController::class, 'index'])->name('sewa-menyewa')->middleware('auth');
Route::get('/kp-Pelanggan', [kp_PelangganController::class, 'index'])->name('kp-pelanggan')->middleware('auth');
Route::get('/kp-bukan-Pelanggan', [kp_bukanPelangganController::class, 'index'])->name('kp-bukanpelanggan')->middleware('auth');
Route::get('/umur-piutang', [UmurPiutangController::class, 'index'])->name('umur-piutang')->middleware('auth');
Route::get('/sp-bulanan', [Sp_bulananController::class, 'index'])->name('sp-bulanan')->middleware('auth');
Route::get('/sp-harian', [Sp_HarianController::class, 'index'])->name('sp-harian')->middleware('auth');
Route::get('/jatuh-tempo', [JatuhTempoController::class, 'index'])->name('jatuh-tempo')->middleware('auth');
Route::get('/pp-pengajuan', [pp_pengajuan::class, 'index'])->name('pp-pengajuan')->middleware('auth');
Route::get('/pp-baru', [pp_baruController::class, 'index'])->name('pp-baru')->middleware('auth');
Route::post('/tagihan/get-data', [tagihanController::class, 'getData'])->middleware('auth');
