<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Saving;
use Illuminate\View\View;

class SimpananController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $organization = Organization::first();

        $simpananPokok = Saving::where('user_id', $user->id)->where('type', 'pokok')->first();
        $simpananWajib = Saving::where('user_id', $user->id)->where('type', 'wajib')->first();
        $simpananSukarela = Saving::where('user_id', $user->id)->where('type', 'sukarela')->first();

        return view('anggota.simpanan.index', [
            'namaKoperasi' => $organization?->name ?? 'Koperasi',
            'totalSaldo' => ($simpananPokok?->balance ?? 0) + ($simpananWajib?->balance ?? 0) + ($simpananSukarela?->balance ?? 0),
            'simpananPokok' => $simpananPokok?->balance ?? 0,
            'simpananWajib' => $simpananWajib?->balance ?? 0,
            'simpananSukarela' => $simpananSukarela?->balance ?? 0,
            'statusAnggota' => $user->status === 'active' ? 'Aktif' : 'Nonaktif',
            'memberCode' => $user->member_code ?? 'KOP-' . str_pad((string)$user->id, 4, '0', STR_PAD_LEFT),
            'joinDate' => $user->join_date?->format('F Y') ?? now()->format('F Y'),
            'bungaSukarela' => $organization?->bunga_rate ?? 0.5,
        ]);
    }
}
