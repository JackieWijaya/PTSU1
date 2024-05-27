<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DataPribadiController;
use App\Http\Controllers\DataPelamarController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\DataKeluargaIntiController;
use App\Http\Controllers\DataKeluargaKandungController;
use App\Http\Controllers\DataPendidikanController;
use App\Http\Controllers\PelatihanSertifikatController;
use App\Http\Controllers\PengalamanKerjaController;
use App\Http\Controllers\BahasaAsingController;
use App\Http\Controllers\PengaturanPresensiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RekapPresensiController;
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



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/jabatan', JabatanController::class);
Route::resource('/data_pribadi', DataPribadiController::class);
Route::resource('/data_pelamar', DataPelamarController::class);
Route::resource('/data_karyawan', DataKaryawanController::class);
Route::resource('/data_keluarga_inti', DataKeluargaIntiController::class);
Route::resource('/data_keluarga_kandung', DataKeluargaKandungController::class);
Route::resource('/data_pendidikan', DataPendidikanController::class);
Route::resource('/pelatihan_sertifikat', PelatihanSertifikatController::class);
Route::resource('/pengalaman_kerja', PengalamanKerjaController::class);
Route::resource('/bahasa_asing', BahasaAsingController::class);
Route::resource('/presensi', PresensiController::class);
Route::post('/presensi/store', [PresensiController::class, 'store']);
Route::resource('/pengaturan_presensi', PengaturanPresensiController::class);
Route::resource('/rekap_presensi', RekapPresensiController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
