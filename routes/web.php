<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DendaController;

// Homepage Route
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Rute untuk login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk halaman home
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

// Rute untuk dashboard yang memerlukan autentikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Barang Routes
Route::middleware('auth')->group(function () {
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/print', [BarangController::class, 'print'])->name('barang.print');

    // Siswa Routes
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/print', [SiswaController::class, 'print'])->name('siswa.print');

    // Peminjaman Routes
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index'); // Rute untuk menampilkan daftar peminjaman
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create'); // Rute untuk menampilkan form pembuatan peminjaman
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store'); // Rute untuk menyimpan peminjaman
    Route::get('/peminjaman/{peminjaman}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit'); // Rute untuk menampilkan form edit peminjaman
    Route::put('/peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update'); // Rute untuk memperbarui peminjaman
    Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy'); // Rute untuk menghapus peminjaman
    Route::post('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan'); // Rute untuk mengembalikan peminjaman
    Route::get('/peminjaman/print', [PeminjamanController::class, 'print'])->name('peminjaman.print'); // Rute untuk mencetak 

        // Denda Routes
        Route::get('/denda/create', [DendaController::class, 'create'])->name('denda.create');
        Route::post('/denda', [DendaController::class, 'store'])->name('denda.store');
        Route::get('/denda/{denda}/edit', [DendaController::class, 'edit'])->name('denda.edit');
        Route::put('/denda/{denda}', [DendaController::class, 'update'])->name('denda.update');
        Route::delete('/denda/{denda}', [DendaController::class, 'destroy'])->name('denda.destroy');
        Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
        Route::get('/denda/print', [DendaController::class, 'print'])->name('denda.print');
        Route::get('denda/{id}/bayar', [DendaController::class, 'bayarDenda'])->name('denda.bayarDenda');
        Route::get('/denda/show/id_denda', [DendaController::class, 'show'])->name('denda.show');
    });



