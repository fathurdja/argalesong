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
use App\Http\Controllers\kp_pelangganController;
use App\Http\Controllers\masterCompany;
use App\Http\Controllers\masterdatacontroller;
use App\Http\Controllers\MasterDataPajakController;
use App\Http\Controllers\pbAfiliasiController;
use App\Http\Controllers\pbSewaMenyewaController;
use App\Http\Controllers\PembayaranPiutang;
use App\Http\Controllers\PembayaranPiutangController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\pp_baruController;
use App\Http\Controllers\pp_pengajuan;
use App\Http\Controllers\riwayatPembayaran;
use App\Http\Controllers\riwayatpiutang;
use App\Http\Controllers\Sp_bulananController;
use App\Http\Controllers\Sp_HarianController;
use App\Http\Controllers\tagihanController;
use App\Http\Controllers\TipePelangganController;
use App\Http\Controllers\UmurPiutangController;

use Illuminate\Support\Facades\Route;

// Route untuk Dashboard
Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

// Route untuk Login dan Register
Route::get('/login', function () {
    return view('loginform');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'Register'])->name('register');
Route::post('/register', [RegisterController::class, 'MakeAccount'])->name('makeAccount');

// Resource Controllers
Route::resource('customer', CustomerController::class);
Route::resource('masterDataPajak', MasterDataPajakController::class);
Route::resource('piutang-types', PiutangController::class);
Route::get('/get-customers/{idcompany}', [PiutangController::class, 'getCustomers']);
// Route untuk Laporan Bulanan
Route::get('/get-monthly-report', [Sp_bulananController::class, 'getMonthlyReport']);
Route::get('/riwayatPiutang', [riwayatpiutang::class, 'index'])->name('riwayatPiutang');
Route::get('/riwayatPiutang/printPreview', [riwayatpiutang::class, 'print_Preview'])->name('printriwayatPiutang');
// dhimas buat detail
Route::get('/riwayatPiutang/detail/{no_invoice}', [riwayatpiutang::class, 'detail'])->name('detailpiutang.detail');
Route::get('/riwayatPembayaran', [riwayatPembayaran::class, 'index'])->name('riwayatPembayaran');
//mbul buat detail
Route::get('/riwayatPembayaran/detail/{IDPembayaran}', [riwayatPembayaran::class, 'detail'])->name('riwayatPembayaran.detail');


// Route untuk Pencarian Customer dan Piutang

Route::get('/customer/search', [CustomerController::class, 'index'])->name('customer.search');
Route::get('/piutang/group', [UmurPiutangController::class, 'index'])->name('detailpiutang.index');
Route::get('/fetch-companies', [masterCompany::class, 'fetchAndStoreCompanies']);
// delete mbul
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
// Route untuk Pembayaran Piutang
Route::get('/pembayaran-piutang', [PembayaranPiutang::class, 'showForm'])->name('pembayaran-piutang.show');
Route::get('/pembayaran-piutang/proses', [PembayaranPiutang::class, 'proses'])->name('pembayaran-piutang.proses');
Route::post('/pembayaran-piutang/bayar', [PembayaranPiutang::class, 'store'])->name('pembayaran-piutang.store');
Route::get('/api/invoices-by-customer/{customerId}', [PembayaranPiutang::class, 'getInvoicesByCustomer'])->name('invoices.by-customer');
Route::get('/api/customers-by-company/{companyId}', [PembayaranPiutang::class, 'getCustomersByCompany'])->name('customer.by-company');
Route::get('/get-customers/{idcompany}', [kp_pelangganController::class, 'getCustomersByCompany']);

// Route untuk Pengaturan Pajak berdasarkan tipe Piutang
Route::get('/api/pajak/{type}', [PiutangController::class, 'getPajakRate'])->name('getpajakRate');

// Route untuk Master Data Piutang dan Tagihan
Route::get('/form-tambah-tagihan', [tagihanController::class, 'create'])->name('tambahForm');
Route::get('/master-data-piutang', [masterdatacontroller::class, 'index'])->name('master_data_piutang');
Route::get('/master-data-piutang-create', [masterdatacontroller::class, 'create'])->name('master_data_piutang_create');
Route::post('/storeTipePelanggan', [masterdatacontroller::class, 'storeTipePelanggan'])->name('storeTipePelanggan');
Route::post('/storeTipePiutang', [masterdatacontroller::class, 'storeTipePiutang'])->name('storeTipePiutang');
// -> delete master piutang
// Route::delete('/master-data-piutang/{id}', [masterdatacontroller::class, 'destroy'])->name('master_data_piutang_delete');

Route::get('/kartu-pelanggan', [kp_pelangganController::class, 'index'])->name('kp_pelanggan');

// Route to fetch and display the data after form submission (POST request)
Route::post('/kartu-pelanggan-fetchData', [kp_pelangganController::class, 'fetchData'])->name('kartu-pelanggan-fetchData');
// Route untuk Data Pelanggan Khusus (KP Pelanggan dan Bukan Pelanggan)

Route::get('/kp-bukan-Pelanggan', [kp_bukanPelangganController::class, 'index'])->name('kp-bukanpelanggan');

// Route untuk Pengajuan dan Pengajuan Baru
Route::get('/pp-pengajuan', [pp_pengajuan::class, 'index'])->name('pp-pengajuan');
Route::get('/pp-baru', [pp_baruController::class, 'index'])->name('pp-baru');

// Route untuk Laporan SP Bulanan dan Harian
Route::get('/sp-bulanan', [Sp_bulananController::class, 'index'])->name('sp-bulanan');
Route::get('/sp-harian', [Sp_HarianController::class, 'index'])->name('sp-harian');
// Route untuk API mendapatkan laporan harian
Route::get('/daily-report', [Sp_HarianController::class, 'getDailyReport']);

// Route untuk Jatuh Tempo
Route::get('/jatuh-tempo', [JatuhTempoController::class, 'index'])->name('jatuh-tempo');
// mbul jatuh tempo
Route::get('/jatuh-tempo/data/{year}/{month}', [JatuhTempoController::class, 'getJatuhTempo']);


// Route untuk mendapatkan data Tagihan
Route::post('/tagihan/get-data', [tagihanController::class, 'getData']);

// Route tambahan untuk Umur Piutang
Route::get('/umur-piutang', [UmurPiutangController::class, 'index'])->name('umur-piutang');




// mbul testing
Route::get('/mbul-test', function(){
    return view('pembayaran_piutang/pembayaranDetail');
});
Route::get('/riwayatPembayaranDetail', function(){
    return view('pembayaran_piutang/riwayatPembayaranDetail');
});