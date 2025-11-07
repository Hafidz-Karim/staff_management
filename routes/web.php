<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ========================
// GURU
// ========================
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\LaporanController;

// Absensi pegawai (user biasa/pegawai)
use App\Http\Controllers\AbsensiPegawaiController;

// ========================
// ADMIN
// ========================
use App\Http\Controllers\Admin\JadwalKerjaController as AdminJadwalKerjaController;
use App\Http\Controllers\Admin\AdminAbsensiPegawaiController;

// ========================
// PEGAWAI
// ========================
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\Pegawai\JadwalController as PegawaiJadwalController;

// ========================
// ROUTES
// ========================

Route::get('/', fn() => view('welcome'));

// Dashboard umum
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ========================
// PROFILE
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================
// GURU
// ========================
Route::prefix('guru')->name('guru.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('guru.dashboard'))->name('dashboard.index');
    Route::get('/jadwal', [GuruJadwalController::class, 'index'])->name('jadwal.index');
    Route::resource('laporan', LaporanController::class);
    Route::resource('absensi', AbsensiController::class)->except(['show']);
});

// ========================
// ADMIN
// ========================
   Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard.index');

    // Jadwal kerja admin
    Route::get('/jadwal-kerja', [AdminJadwalKerjaController::class, 'index'])->name('jadwal_kerja.index');
    Route::get('/jadwal-kerja/create', [AdminJadwalKerjaController::class, 'create'])->name('jadwal_kerja.create');
    Route::post('/jadwal-kerja/store', [AdminJadwalKerjaController::class, 'store'])->name('jadwal_kerja.store');
    Route::delete('/jadwal-kerja/{id}', [AdminJadwalKerjaController::class, 'destroy'])->name('jadwal_kerja.destroy');
    // Absensi pegawai (Admin lihat semua)
    Route::get('/absensi', [AdminAbsensiPegawaiController::class, 'index'])
    ->name('absensi.index');
    // ✅ Export PDF Absensi
    Route::get('/absensi/export-pdf', [AdminAbsensiPegawaiController::class, 'exportPDF'])
    ->name('absensi.export-pdf');
    //
    Route::get('/absensi/preview', [AdminAbsensiPegawaiController::class, 'preview'])
    ->name('absensi.preview');
});


// ========================
// PEGAWAI
// ========================
Route::prefix('pegawai')->name('pegawai.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jadwal', [PegawaiJadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/profile', [PegawaiDashboardController::class, 'profile'])->name('profile');
});

// ========================
// ABSENSI PEGAWAI (User Absen Sendiri)
// ========================
Route::middleware(['auth'])->group(function () {
    Route::get('/absensi-pegawai', [AbsensiPegawaiController::class, 'index'])->name('absensipegawai.index');
    Route::post('/absensi-pegawai', [AbsensiPegawaiController::class, 'store'])->name('absensipegawai.store');
});

require __DIR__ . '/auth.php';
