<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Dokumen\DokumenController;
use Illuminate\Support\Facades\Route;

// Import API Controllers
use App\Http\Controllers\Api\KolamController;
use App\Http\Controllers\Api\PakanController;
use App\Http\Controllers\Api\JadwalPakanController;
use App\Http\Controllers\Api\PanenController;
use App\Http\Controllers\Api\PenjualanController;
use App\Http\Controllers\Api\PengeluaranController;
use App\Http\Controllers\Api\JenisIkanController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\GajiKaryawanController;
use App\Http\Controllers\Api\BiayaOperasionalController;
use App\Http\Controllers\Api\LaporanKeuanganController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('main.welcome');
});

// Redirect setelah login berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Keuangan Routes
    Route::get('/keuangan', function () {
        return view('admin.laporanKeuangan');
    })->name('keuangan');

    Route::get('/biaya', function () {
        return view('admin.biayaOperasional');
    })->name('biaya');

    Route::get('/pengeluaran', function () {
        return view('admin.pengeluaran');
    })->name('pengeluaran');

    Route::get('/penjualan', function () {
        return view('admin.penjualan');
    })->name('penjualan');

    // Budidaya Routes
    Route::get('/kolam', function () {
        return view('admin.kolam');
    })->name('kolam');

    Route::get('/ikan', function () {
        return view('admin.jenisIkan');
    })->name('ikan');

    Route::get('/pakan', function () {
        return view('admin.pakan');
    })->name('pakan');

    Route::get('/jadwal-pakan', function () {
        return view('admin.jadwalPakan');
    })->name('jadwal-pakan');

    Route::get('/panen', function () {
        return view('admin.panen');
    })->name('panen');

    // SDM Routes
    Route::get('/pegawai', function () {
        return view('admin.pegawai');
    })->name('pegawai');

    Route::get('/gaji', function () {
        return view('admin.gajiKaryawan');
    })->name('gaji');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');
});

// User Routes
Route::middleware(['auth', 'verified', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');

    // Keuangan Routes
    Route::get('/keuangan', function () {
        return view('user.laporanKeuangan');
    })->name('keuangan');

    Route::get('/biaya', function () {
        return view('user.biayaOperasional');
    })->name('biaya');

    Route::get('/penjualan', function () {
        return view('user.penjualan');
    })->name('penjualan');

    // Budidaya Routes
    Route::get('/kolam', function () {
        return view('user.kolam');
    })->name('kolam');

    Route::get('/ikan', function () {
        return view('user.jenisIkan');
    })->name('ikan');

    Route::get('/pakan', function () {
        return view('user.pakan');
    })->name('pakan');

    Route::get('/jadwal-pakan', function () {
        return view('user.jadwalPakan');
    })->name('jadwal-pakan');

    Route::get('/panen', function () {
        return view('user.panen');
    })->name('panen');

    // SDM Routes
    Route::get('/pegawai', function () {
        return view('user.pegawai');
    })->name('pegawai');

    Route::get('/gaji', function () {
        return view('user.gajiKaryawan');
    })->name('gaji');

    // Dokumen Routes
    Route::prefix('dokumen')->name('dokumen.')->group(function () {
        Route::get('/', [DokumenController::class, 'index'])->name('index');
        Route::post('/', [DokumenController::class, 'store'])->name('store');
        Route::get('/{document}/download', [DokumenController::class, 'download'])->name('download');
        Route::delete('/{document}', [DokumenController::class, 'destroy'])->name('destroy');
    });
});

// Profile Routes (accessible by both)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('api')->group(function () {

    // Kolam API
    Route::get('/kolam', [KolamController::class, 'index']);
    Route::post('/kolam', [KolamController::class, 'store']);
    Route::get('/kolam/{kolam}', [KolamController::class, 'show']);
    Route::put('/kolam/{kolam}', [KolamController::class, 'update']);
    Route::delete('/kolam/{kolam}', [KolamController::class, 'destroy']);

    // Pakan API
    Route::get('/pakan', [PakanController::class, 'index']);
    Route::post('/pakan', [PakanController::class, 'store']);
    Route::get('/pakan/{pakan}', [PakanController::class, 'show']);
    Route::put('/pakan/{pakan}', [PakanController::class, 'update']);
    Route::delete('/pakan/{pakan}', [PakanController::class, 'destroy']);

    // Jadwal Pakan API
    Route::get('/jadwal-pakan', [JadwalPakanController::class, 'index']);
    Route::post('/jadwal-pakan', [JadwalPakanController::class, 'store']);
    Route::get('/jadwal-pakan/{jadwalPakan}', [JadwalPakanController::class, 'show']);
    Route::put('/jadwal-pakan/{jadwalPakan}', [JadwalPakanController::class, 'update']);
    Route::delete('/jadwal-pakan/{jadwalPakan}', [JadwalPakanController::class, 'destroy']);

    // Panen API
    Route::get('/panen', [PanenController::class, 'index']);
    Route::post('/panen', [PanenController::class, 'store']);
    Route::get('/panen/{panen}', [PanenController::class, 'show']);
    Route::put('/panen/{panen}', [PanenController::class, 'update']);
    Route::delete('/panen/{panen}', [PanenController::class, 'destroy']);

    // Penjualan API
    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
    Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'show']);
    Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update']);
    Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy']);

    // Pengeluaran API
    Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
    Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
    Route::get('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'show']);
    Route::put('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'update']);
    Route::delete('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'destroy']);

    // Jenis Ikan API
    Route::get('/jenis-ikan', [JenisIkanController::class, 'index']);
    Route::post('/jenis-ikan', [JenisIkanController::class, 'store']);
    Route::get('/jenis-ikan/{jenisIkan}', [JenisIkanController::class, 'show']);
    Route::put('/jenis-ikan/{jenisIkan}', [JenisIkanController::class, 'update']);
    Route::delete('/jenis-ikan/{jenisIkan}', [JenisIkanController::class, 'destroy']);

    // Pegawai API
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show']);
    Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update']);
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy']);

    // Gaji Karyawan API
    Route::get('/gaji-karyawan', [GajiKaryawanController::class, 'index']);
    Route::post('/gaji-karyawan', [GajiKaryawanController::class, 'store']);
    Route::get('/gaji-karyawan/{gajiKaryawan}', [GajiKaryawanController::class, 'show']);
    Route::put('/gaji-karyawan/{gajiKaryawan}', [GajiKaryawanController::class, 'update']);
    Route::delete('/gaji-karyawan/{gajiKaryawan}', [GajiKaryawanController::class, 'destroy']);

    // Biaya Operasional API
    Route::get('/biaya-operasional', [BiayaOperasionalController::class, 'index']);
    Route::post('/biaya-operasional', [BiayaOperasionalController::class, 'store']);
    Route::get('/biaya-operasional/{biayaOperasional}', [BiayaOperasionalController::class, 'show']);
    Route::put('/biaya-operasional/{biayaOperasional}', [BiayaOperasionalController::class, 'update']);
    Route::delete('/biaya-operasional/{biayaOperasional}', [BiayaOperasionalController::class, 'destroy']);

    // Laporan Keuangan API
    Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index']);
    Route::post('/laporan-keuangan', [LaporanKeuanganController::class, 'store']);
    Route::get('/laporan-keuangan/{laporanKeuangan}', [LaporanKeuanganController::class, 'show']);
    Route::put('/laporan-keuangan/{laporanKeuangan}', [LaporanKeuanganController::class, 'update']);
    Route::delete('/laporan-keuangan/{laporanKeuangan}', [LaporanKeuanganController::class, 'destroy']);

    // Users API
    Route::get('/users', [RegisteredUserController::class, 'index']);
    Route::post('/users', [RegisteredUserController::class, 'store']);
    Route::get('/users/{users}', [RegisteredUserController::class, 'show']);
    Route::put('/users/{users}', [RegisteredUserController::class, 'update']);
    Route::delete('/users/{users}', [RegisteredUserController::class, 'destroy']);
});

require __DIR__.'/auth.php';
