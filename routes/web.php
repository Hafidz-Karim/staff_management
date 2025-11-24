<?php

use Illuminate\Support\Facades\Route;

// ========================================
// CONTROLLERS
// ========================================
use App\Http\Controllers\ProfileController;

// GURU
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\LaporanController;

// ADMIN
use App\Http\Controllers\Admin\JadwalKerjaController as AdminJadwalKerjaController;
use App\Http\Controllers\Admin\AdminAbsensiPegawaiController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\IzinAdminController;

// PEGAWAI
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\Pegawai\JadwalController as PegawaiJadwalController;

// ABSENSI PEGAWAI (User)
use App\Http\Controllers\AbsensiPegawaiController;

// IZIN PEGAWAI
use App\Http\Controllers\IzinController;


// ========================================
// HOME
// ========================================
Route::get('/', fn() => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// ========================================
// PROFILE
// ========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ========================================
// GURU
// ========================================
Route::prefix('guru')->name('guru.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('guru.dashboard'))->name('dashboard.index');

    Route::get('/jadwal', [GuruJadwalController::class, 'index'])->name('jadwal.index');

    Route::resource('laporan', LaporanController::class);

    Route::resource('absensi', AbsensiController::class)->except(['show']);
});


// ========================================
// ADMIN
// ========================================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard.index');

    // Jadwal kerja admin
    Route::get('/jadwal-kerja', [AdminJadwalKerjaController::class, 'index'])->name('jadwal_kerja.index');
    Route::get('/jadwal-kerja/create', [AdminJadwalKerjaController::class, 'create'])->name('jadwal_kerja.create');
    Route::post('/jadwal-kerja/store', [AdminJadwalKerjaController::class, 'store'])->name('jadwal_kerja.store');
    Route::delete('/jadwal-kerja/{id}', [AdminJadwalKerjaController::class, 'destroy'])->name('jadwal_kerja.destroy');

    // Absensi
    Route::get('/absensi', [AdminAbsensiPegawaiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/preview', [AdminAbsensiPegawaiController::class, 'preview'])->name('absensi.preview');
    Route::get('/absensi/export-pdf', [AdminAbsensiPegawaiController::class, 'exportPDF'])->name('absensi.export-pdf');

    // Izin — Admin
    Route::get('/izin', [IzinAdminController::class, 'index'])->name('izin.index');
    Route::post('/izin/{id}/update-status', [IzinAdminController::class, 'updateStatus'])->name('izin.update-status');
});


// ========================================
// IZIN — USER (PEGAWAI DAN GURU BOLEH MENGAJUKAN)
// ========================================
Route::middleware(['auth'])->group(function () {

    Route::get('/izin', [IzinController::class, 'index'])->name('izin.index');       // riwayat
    Route::get('/izin/create', [IzinController::class, 'create'])->name('izin.create');
    Route::post('/izin/store', [IzinController::class, 'store'])->name('izin.store');
});


// ========================================
// PEGAWAI
// ========================================
Route::prefix('pegawai')->name('pegawai.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');

    Route::get('/jadwal', [PegawaiJadwalController::class, 'index'])->name('jadwal.index');

    Route::get('/profile', [PegawaiDashboardController::class, 'profile'])->name('profile');
});


// ========================================
// ABSENSI PEGAWAI — USER ABSEN SENDIRI
// ========================================
Route::middleware(['auth'])->group(function () {

    Route::get('/absensi-pegawai', [AbsensiPegawaiController::class, 'index'])
        ->name('absensipegawai.index');

    Route::post('/absensi-pegawai', [AbsensiPegawaiController::class, 'store'])
        ->name('absensipegawai.store');
});


require __DIR__ . '/auth.php';
