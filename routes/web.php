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

Route::prefix('pengawas')->group(function () {
    Route::get('/dashboard', fn()=>view('pengawas.dashboard.index'))->name('pengawas.dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', fn()=>view('admin.dashboard.index'))->name('admin.dashboard');

    // Rute Organisasi
    Route::get('/organisasi', fn()=>view('admin.organisasi.index'))->name('organisasi.index');

    // TAMBAHKAN INI: Agar form pendaftaran & update bisa berfungsi
    Route::post('/organisasi', function() {
        // Logika simpan data sementara (Anda nanti perlu memindahkan ini ke Controller)
        return back()->with('success', 'Organisasi berhasil didaftarkan!');
    })->name('organisasi.store');

    Route::put('/organisasi', function() {
        // Logika update data sementara
        return back()->with('success', 'Profil berhasil diperbarui!');
    })->name('organisasi.update');

    // Rute lainnya (tambahkan name agar mudah dipanggil di sidebar)
    Route::get('/pengguna', fn()=>view('admin.pengguna.index'))->name('admin.pengguna');
    Route::get('/penggajian', fn()=>view('admin.penggajian.index'))->name('admin.penggajian');
    Route::get('/monitoring', fn()=>view('admin.monitoring.index'))->name('admin.monitoring');
    Route::get('/pengaturan', fn()=>view('admin.pengaturan.index'))->name('admin.pengaturan');
});

Route::prefix('anggota')->group(function () {
    Route::get('/dashboard', fn()=>view('anggota.dashboard.index'))->name('anggota.dashboard');
    Route::get('/simpanan', fn()=>view('anggota.simpanan.index'))->name('anggota.simpanan');
    Route::get('/pinjaman', fn()=>view('anggota.pinjaman.index'))->name('anggota.pinjaman');
    Route::get('/angsuran', fn()=>view('anggota.angsuran.index'))->name('anggota.angsuran');
    Route::get('/shu', fn()=>view('anggota.shu.index'))->name('anggota.shu');
    Route::get('/profil', fn()=>view('anggota.profil.index'))->name('anggota.profil');
});

Route::prefix('pengurus')->group(function () {
    Route::get('/dashboard', fn()=>view('pengurus.dashboard.index'))->name('pengurus.dashboard');
    Route::get('/transsimpanan', fn()=>view('pengurus.transsimpanan.index'))->name('pengurus.transsimpanan');
    Route::get('/kelpinjaman', fn()=>view('pengurus.kelpinjaman.index'))->name('pengurus.kelpinjaman');
    Route::get('/inpangsuran', fn()=>view('pengurus.inpangsuran.index'))->name('pengurus.inpangsuran');
    Route::get('/lapharian', fn()=>view('pengurus.lapharian.index'))->name('pengurus.lapharian');
    Route::get('/monitoring', fn()=>view('pengurus.monitoring.index'))->name('pengurus.monitoring');
});

Route::prefix('pengawas')->group(function () {
    Route::get('/dashboard', fn()=>view('pengawas.dashboard.index'))->name('pengawas.dashboard');
    Route::get('/audpinjaman', fn()=>view('pengawas.audpinjaman.index'))->name('pengawas.audpinjaman');
    Route::get('/audsimpanan', fn()=>view('pengawas.audsimpanan.index'))->name('pengawas.audsimpanan');
    Route::get('/dataangsuran', fn()=>view('pengawas.dataangsuran.index'))->name('pengawas.dataangsuran');
    Route::get('/rekapangsuran', fn()=>view('pengawas.rekapangsuran.index'))->name('pengawas.rekapangsuran');
    Route::get('/laporanshu', fn()=>view('pengawas.laporannshu.index'))->name('pengawas.laporannshu');
});
require __DIR__.'/auth.php';
