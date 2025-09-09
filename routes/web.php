<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

// Dashboard (hanya untuk user yang sudah login dan verifikasi)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman Notifikasi Jatuh Tempo
    Route::get('/borrows/notifications', [BorrowController::class, 'notifications'])->name('borrows.notifications');

    // Buku
    Route::resource('/books', BookController::class);

    // Peminjaman
    Route::resource('/borrows', BorrowController::class);

    // Pengembalian Buku
    Route::post('/borrows/{id}/return', [ReturnController::class, 'store'])->name('returns.store');

    // Laporan
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');


});

// Auth route dari Breeze/Fortify/Jetstream
require __DIR__ . '/auth.php';
