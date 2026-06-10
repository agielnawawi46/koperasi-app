<?php

use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Anggota\AngsuranController;
use App\Http\Controllers\Anggota\PinjamanController;
use App\Http\Controllers\Anggota\ProfilController;
use App\Http\Controllers\Anggota\ShuController as AnggotaShuController;
use App\Http\Controllers\Anggota\SimpananController;
use App\Http\Controllers\Pengawas\AuditPinjamanController;
use App\Http\Controllers\Pengawas\AuditSimpananController;
use App\Http\Controllers\Pengawas\DataAnggotaController;
use App\Http\Controllers\Pengawas\LaporanShuController;
use App\Http\Controllers\Pengawas\RekapAngsuranController;
use App\Http\Controllers\Pengurus\InputAngsuranController;
use App\Http\Controllers\Pengurus\KelolaPinjamanController;
use App\Http\Controllers\Pengurus\LaporanHarianController;
use App\Http\Controllers\Pengurus\ShuController as PengurusShuController;
use App\Http\Controllers\Pengurus\TransaksiSimpananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    try {
        if ($user->hasRole('super_admin')) {
            return redirect()->route('super-admin.dashboard');
        }
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->hasRole('anggota')) {
            return redirect()->route('anggota.dashboard');
        }
        if ($user->hasRole('pengurus')) {
            return redirect()->route('pengurus.dashboard');
        }
        if ($user->hasRole('pengawas')) {
            return redirect()->route('pengawas.dashboard');
        }
    } catch (RoleDoesNotExist $e) {
        return redirect()->route('login');
    }

    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// GROUP SUPER ADMIN
// ==========================================
Route::prefix('super-admin')->as('super-admin.')->middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/store-admin', [DashboardController::class, 'storeAdmin'])->name('store-admin');
    Route::delete('/dashboard/user/{user}', [DashboardController::class, 'destroy'])->name('destroy-user');
});

// ==========================================
// GROUP ADMIN (DIPERBAIKI & DIINTEGRASIKAN)
// ==========================================
Route::prefix('admin')->as('admin.')->middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Rute Organisasi / Aturan Perusahaan
    Route::get('/organisasi', [OrganizationController::class, 'index'])->name('organisasi.index');
    Route::post('/organisasi', [OrganizationController::class, 'store'])->name('organisasi.store');
    Route::put('/organisasi', [OrganizationController::class, 'store'])->name('organisasi.update');

    // Rute Manajemen Pengguna (CRUD)
    Route::get('/pengguna', [UserManagementController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/data', [UserManagementController::class, 'getData'])->name('pengguna.data');
    Route::post('/pengguna', [UserManagementController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{user}', [UserManagementController::class, 'update'])->name('pengguna.update');
    Route::patch('/pengguna/{user}/status', [UserManagementController::class, 'toggleStatus'])->name('pengguna.status');
    Route::delete('/pengguna/{user}', [UserManagementController::class, 'destroy'])->name('pengguna.destroy');

    // Rute Penggajian
    Route::get('/penggajian', [PayrollController::class, 'index'])->name('penggajian');
    Route::post('/payroll/store', [PayrollController::class, 'store'])->name('payroll.store');

    // Rute Monitoring
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');

    // Rute Pengaturan Akun
    Route::get('/pengaturan', [SettingsController::class, 'index'])->name('pengaturan');
    Route::put('/pengaturan/profile', [SettingsController::class, 'updateProfile'])->name('pengaturan.profile');
    Route::put('/pengaturan/password', [SettingsController::class, 'updatePassword'])->name('pengaturan.password');
    Route::get('/profil', [SettingsController::class, 'index'])->name('profil');
    Route::put('/profil', [SettingsController::class, 'updateProfile'])->name('profil.update');
    Route::put('/profil/password', [SettingsController::class, 'updatePassword'])->name('profil.password');
});

// ==========================================
// GROUP ANGGOTA
// ==========================================
Route::prefix('anggota')->as('anggota.')->middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Anggota\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanan');
    Route::post('/simpanan', [SimpananController::class, 'store'])->name('simpanan.store');
    Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('pinjaman');
    Route::post('/pinjaman', [PinjamanController::class, 'store'])->name('pinjaman.store');
    Route::get('/angsuran', [AngsuranController::class, 'index'])->name('angsuran');
    Route::post('/angsuran/bayar', [AngsuranController::class, 'bayar'])->name('angsuran.bayar');
    Route::get('/shu', [AnggotaShuController::class, 'index'])->name('shu');
    Route::post('/shu', [AnggotaShuController::class, 'store'])->name('shu.store');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});

// ==========================================
// GROUP PENGURUS
// ==========================================
Route::prefix('pengurus')->as('pengurus.')->middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Pengurus\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transsimpanan', [TransaksiSimpananController::class, 'index'])->name('transsimpanan');
    Route::post('/transsimpanan', [TransaksiSimpananController::class, 'store'])->name('transsimpanan.store');
    Route::post('/transsimpanan/{transaction}/approve', [TransaksiSimpananController::class, 'approve'])->name('transsimpanan.approve');
    Route::post('/transsimpanan/{transaction}/reject', [TransaksiSimpananController::class, 'reject'])->name('transsimpanan.reject');
    Route::get('/kelpinjaman', [KelolaPinjamanController::class, 'index'])->name('kelpinjaman');
    Route::post('/kelpinjaman', [KelolaPinjamanController::class, 'store'])->name('kelpinjaman.store');
    Route::post('/kelpinjaman/{loan}/approve', [KelolaPinjamanController::class, 'approve'])->name('kelpinjaman.approve');
    Route::post('/kelpinjaman/{loan}/reject', [KelolaPinjamanController::class, 'reject'])->name('kelpinjaman.reject');
    Route::post('/kelpinjaman/{loan}/ready', [KelolaPinjamanController::class, 'readyForDisbursement'])->name('kelpinjaman.ready');
    Route::post('/kelpinjaman/{loan}/cairkan', [KelolaPinjamanController::class, 'cairkan'])->name('kelpinjaman.cairkan');
    Route::get('/inpangsuran', [InputAngsuranController::class, 'index'])->name('inpangsuran');
    Route::get('/inpangsuran/data/{loan}', [InputAngsuranController::class, 'getDataPinjaman'])->name('inpangsuran.data');
    Route::post('/inpangsuran', [InputAngsuranController::class, 'store'])->name('inpangsuran.store');
    Route::get('/lapharian', [LaporanHarianController::class, 'index'])->name('lapharian');
    Route::get('/lapharian/data', [LaporanHarianController::class, 'getData'])->name('lapharian.data');
    Route::get('/monitoring', [App\Http\Controllers\Pengurus\MonitoringController::class, 'index'])->name('monitoring');
    Route::get('/shu', [PengurusShuController::class, 'index'])->name('shu');
    Route::post('/shu/calculate', [PengurusShuController::class, 'calculate'])->name('shu.calculate');
    Route::post('/shu/{shu}/distribute', [PengurusShuController::class, 'distribute'])->name('shu.distribute');
    Route::post('/shu/{shu}/close', [PengurusShuController::class, 'close'])->name('shu.close');
    Route::get('/profil', [App\Http\Controllers\Pengurus\ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [App\Http\Controllers\Pengurus\ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [App\Http\Controllers\Pengurus\ProfilController::class, 'updatePassword'])->name('profil.password');
});

// ==========================================
// GROUP PENGAWAS
// ==========================================
Route::prefix('pengawas')->as('pengawas.')->middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Pengawas\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/audpinjaman', [AuditPinjamanController::class, 'index'])->name('audpinjaman');
    Route::get('/audsimpanan', [AuditSimpananController::class, 'index'])->name('audsimpanan');
    Route::get('/dataanggota', [DataAnggotaController::class, 'index'])->name('dataanggota');
    Route::get('/rekapangsuran', [RekapAngsuranController::class, 'index'])->name('rekapangsuran');
    Route::get('/laporannshu', [LaporanShuController::class, 'index'])->name('laporannshu');
    Route::get('/profil', [App\Http\Controllers\Pengawas\ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [App\Http\Controllers\Pengawas\ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [App\Http\Controllers\Pengawas\ProfilController::class, 'updatePassword'])->name('profil.password');
});

require __DIR__.'/auth.php';
