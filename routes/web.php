<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\fetchdata;
use App\Http\Controllers\formBaruDaftarController;
use App\Http\Controllers\formeditDaftarController;
use App\Http\Controllers\JatuhTempoController;
use App\Http\Controllers\kp_bukanPelangganController;
use App\Http\Controllers\kp_PelangganController;
use App\Http\Controllers\masterdatacontroller;
use App\Http\Controllers\MasterDataPajakController;
use App\Http\Controllers\pbAfiliasiController;
use App\Http\Controllers\pbSewaMenyewaController;
use App\Http\Controllers\PembayaranPiutang;
use App\Http\Controllers\PembayaranPiutangController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\pp_baruController;
use App\Http\Controllers\pp_pengajuan;
use App\Http\Controllers\Sp_bulananController;
use App\Http\Controllers\Sp_HarianController;
use App\Http\Controllers\tagihanController;
use App\Http\Controllers\TipePelangganController;
use App\Http\Controllers\UmurPiutangController;
use App\Models\masterDataPajak;
use Illuminate\Support\Facades\Route;


Route::get('/', [dashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/login', function () {
    return view('loginform');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'Register'])->name('register');
Route::post('/register', [RegisterController::class, 'MakeAccount'])->name('makeAccount');


Route::resource('customer', CustomerController::class)->middleware('auth');
Route::resource('masterDataPajak', MasterDataPajakController::class)->middleware('auth');
Route::resource('piutang-types', PiutangController::class)->middleware('auth');


Route::get('/get-monthly-report', [Sp_bulananController::class, 'getMonthlyReport'])->middleware('auth');

Route::get('/customer/search', [CustomerController::class, 'index'])->name('customer.search')->middleware('auth');
Route::get('/piutang/group', [UmurPiutangController::class, 'index'])->name('detailpiutang.index')->middleware('auth');
Route::get('/pembayaran-piutang', [PembayaranPiutang::class, 'showForm'])->name('pembayaran-piutang.show')->middleware('auth');
Route::post('/pembayaran-piutang/proses', [PembayaranPiutang::class, 'proses'])->name('pembayaran-piutang.proses')->middleware('auth');

// Route::post('/tipe-pelanggan', [TipePelangganController::class, 'store'])->name('tambah-tipePelanggan')->middleware('auth');
// Route for fetching invoice details


Route::get('/form-tambah-tagihan', [tagihanController::class, 'create'])->name('tambahForm')->middleware('auth');
Route::get('/master-data-piutang', [masterdatacontroller::class, 'index'])->name('master_data_piutang')->middleware('auth');
Route::get('/master-data-piutang-create', [masterdatacontroller::class, 'create'])->name('master_data_piutang_create')->middleware('auth');
Route::post('/storeTipePelanggan', [masterdatacontroller::class, 'storeTipePelanggan'])->name('storeTipePelanggan')->middleware('auth');
Route::post('/storeTipePiutang', [masterdatacontroller::class, 'storeTipePiutang'])->name('storeTipePiutang')->middleware('auth');
Route::get('/kp-Pelanggan', [kp_PelangganController::class, 'index'])->name('kp-pelanggan')->middleware('auth');
Route::get('/kp-bukan-Pelanggan', [kp_bukanPelangganController::class, 'index'])->name('kp-bukanpelanggan')->middleware('auth');
Route::get('/umur-piutang', [UmurPiutangController::class, 'index'])->name('umur-piutang')->middleware('auth');
Route::get('/sp-bulanan', [Sp_bulananController::class, 'index'])->name('sp-bulanan')->middleware('auth');
Route::get('/sp-harian', [Sp_HarianController::class, 'index'])->name('sp-harian')->middleware('auth');
Route::get('/jatuh-tempo', [JatuhTempoController::class, 'index'])->name('jatuh-tempo')->middleware('auth');
Route::get('/pp-pengajuan', [pp_pengajuan::class, 'index'])->name('pp-pengajuan')->middleware('auth');
Route::get('/pp-baru', [pp_baruController::class, 'index'])->name('pp-baru')->middleware('auth');
Route::post('/tagihan/get-data', [tagihanController::class, 'getData'])->middleware('auth');
