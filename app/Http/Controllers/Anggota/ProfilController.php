<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $totalSimpanan = Saving::where('user_id', $user->id)->sum('balance');
        $totalPinjaman = Loan::where('user_id', $user->id)->whereIn('status', ['active', 'approved'])->sum('amount');
        $totalTransaksi = ActivityLog::where('user_id', $user->id)->count();

        return view('anggota.profil.index', compact(
            'totalSimpanan', 'totalPinjaman', 'totalTransaksi'
        ));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'nik' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:500'],
            'base_salary' => ['nullable', 'numeric', 'min:0'],
        ]);

        $user->update($validated);

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'update_profile',
            'description' => 'Memperbarui profil anggota',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('anggota.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('anggota.profil')->with('success', 'Kata sandi berhasil diubah.');
    }
}
