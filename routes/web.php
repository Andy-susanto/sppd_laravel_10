<?php

use App\Http\Controllers\AlatAngkutController;
use App\Http\Controllers\BiayaPerdinController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\DataAnggaranController;
use App\Http\Controllers\DataPerdinController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisPerdinController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\KotaKabupatenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\TandaTanganController;
use App\Http\Controllers\UangHarianController;
use App\Http\Controllers\UangKeluarController;
use App\Http\Controllers\UangMasukController;
use App\Http\Controllers\UangTransportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(PageController::class)->group(function(){
	Route::get('/', 'index')->name('dashboard')->middleware('auth');
});

Route::controller(LoginController::class)->group(function(){
	Route::get('/login', 'index')->name('login')->middleware('guest');
	Route::post('/login', 'authenticate');
	Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::resource('/dashboard/login', LoginController::class)->middleware('auth');

Route::middleware('can:isAdmin')->group(function(){
	Route::resource('/dashboard/alat-angkut', AlatAngkutController::class)->middleware('auth');
	Route::resource('/dashboard/biaya-perdin', BiayaPerdinController::class)->middleware('auth');
	Route::resource('/dashboard/bidang', BidangController::class)->middleware('auth');
	Route::resource('/dashboard/golongan', GolonganController::class)->middleware('auth');
	Route::resource('/dashboard/jabatan', JabatanController::class)->middleware('auth');
	Route::resource('/dashboard/jenis-perdin', JenisPerdinController::class)->middleware('auth');
	Route::resource('/dashboard/kegiatan', KegiatanController::class)->middleware('auth');
	Route::resource('/dashboard/ketentuan', KetentuanController::class)->middleware('auth');
	Route::resource('/dashboard/kota-kabupaten', KotaKabupatenController::class)->middleware('auth');
	Route::resource('/dashboard/pegawai', PegawaiController::class)->middleware('auth');
	Route::resource('/dashboard/provinsi', ProvinsiController::class)->middleware('auth');
	Route::resource('/dashboard/seksi', SeksiController::class)->middleware('auth');
	Route::resource('/dashboard/tanda-tangan', TandaTanganController::class)->middleware('auth');
	Route::resource('/dashboard/uang-harian', UangHarianController::class)->middleware('auth');
	Route::resource('/dashboard/uang-transport', UangTransportController::class)->middleware('auth');
	Route::resource('/dashboard/user', UserController::class)->except('create', 'store', 'destroy')->middleware('auth');
	
	// Route::get('/dashboard/user', [UserController::class, 'index'])->name('user.index')->middleware('auth');
});

Route::middleware('can:isPegawai')->group(function(){
	Route::controller(DataPerdinController::class)->group(function(){
		Route::get('/dashboard/data-perdin/baru', 'indexBaru')->name('data-perdin.indexBaru')->middleware('auth');
		Route::get('/dashboard/data-perdin/ditolak', 'indexTolak')->name('data-perdin.indexTolak')->middleware('auth');
		Route::get('/dashboard/data-perdin/belum-ada-laporan', 'indexNoLaporan')->name('data-perdin.indexNoLaporan')->middleware('auth');
		Route::get('/dashboard/data-perdin/belum-bayar', 'indexBelumBayar')->name('data-perdin.indexBelumBayar')->middleware('auth');
		Route::get('/dashboard/data-perdin/sudah-bayar', 'indexSudahBayar')->name('data-perdin.indexSudahBayar')->middleware('auth');
	});	
	Route::resource('/dashboard/data-perdin', DataPerdinController::class)->except('index')->middleware('auth');

	Route::resource('/dashboard/data-anggaran', DataAnggaranController::class)->except('create', 'edit', 'update', 'destroy')->middleware('auth');
	Route::resource('/dashboard/uang-masuk', UangMasukController::class)->except('index')->middleware('auth');
	Route::resource('/dashboard/uang-keluar', UangKeluarController::class)->except('index')->middleware('auth');
});

Route::redirect('/dashboard', '/');