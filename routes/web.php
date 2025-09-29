<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// untuk masing masing user
// Untuk dashboard admin
Route::get('/dashboard/admin', fn() => view('dashboard-admin'))->middleware(['auth'])->name('dashboard.admin');
// Untuk dashboard guru
Route::get('/dashboard/guru', fn() => view('dashboard-guru'))->middleware(['auth'])->name('dashboard.guru');
// Untuk Pegawai
Route::get('/dashboard/pegawai', fn() => view('dashboard-pegawai'))->middleware(['auth'])->name('dashboard.pegawai');

// Route untuk fitur guru
Route::prefix('guru')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('guru.dashboard'))->name('guru.dashboard');
    Route::get('/jadwal', fn() => view('guru.jadwal'))->name('guru.jadwal');
    Route::get('/laporan', fn() => view('guru.laporan'))->name('guru.laporan');
    Route::get('/absensi', fn() => view('guru.absensi'))->name('guru.absensi');
});


require __DIR__.'/auth.php';
