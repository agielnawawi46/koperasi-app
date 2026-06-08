<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DataAnggotaController extends Controller
{
    public function index(): View
    {
        $anggota = User::role('anggota')
            ->with('roles')
            ->orderBy('name')
            ->get()
            ->map(function ($user) {
                return [
                    'inisial' => strtoupper(substr($user->name, 0, 2)),
                    'nama' => $user->name,
                    'id_anggota' => $user->member_code ?? 'KOP-'.str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
                    'status' => $user->status === 'active' ? 'Aktif' : 'Nonaktif',
                    'tanggal_bergabung' => $user->join_date?->format('d M Y') ?? '-',
                    'id' => $user->id,
                ];
            });

        return view('pengawas.dataanggota.index', compact('anggota'));
    }
}
