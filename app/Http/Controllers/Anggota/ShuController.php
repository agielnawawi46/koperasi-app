<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Shu;
use App\Models\ShuMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShuController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $shuTerbaru = Shu::where('status', 'distributed')->latest('year')->first();

        $totalSHU = 0;
        $jasaModal = 0;
        $jasaAnggota = 0;
        $statusSHU = 'Belum Tersedia';
        $disahkanPada = null;

        if ($shuTerbaru) {
            $shuMember = ShuMember::where('shu_id', $shuTerbaru->id)
                ->where('user_id', $user->id)
                ->first();

            if ($shuMember) {
                $totalSHU = $shuMember->amount;
                $jasaModal = $shuMember->modal_amount;
                $jasaAnggota = $shuMember->member_amount;
                $statusSHU = match($shuMember->status) {
                    'distributed' => 'Siap Diambil',
                    'taken' => 'Sudah Diambil',
                    default => 'Menunggu',
                };
                $disahkanPada = $shuTerbaru->created_at->format('M Y');
            }
        }

        $totalKeseluruhan = $totalSHU > 0 ? $totalSHU : 0;
        $jasaModalPercent = $totalKeseluruhan > 0 ? round(($jasaModal / $totalKeseluruhan) * 100) : 0;
        $jasaAnggotaPercent = $totalKeseluruhan > 0 ? round(($jasaAnggota / $totalKeseluruhan) * 100) : 0;

        $riwayatSHU = ShuMember::with('shu')
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get()
            ->map(function ($item) {
                return [
                    'tahun' => $item->shu?->year ?? '-',
                    'jasa_modal' => $item->modal_amount,
                    'jasa_anggota' => $item->member_amount,
                    'total_diterima' => $item->amount,
                    'metode_penyaluran' => $item->distribution_method ?? 'Tunai',
                    'status' => match($item->status) {
                        'distributed' => 'Dibagikan',
                        'taken' => 'Sudah Diambil',
                        default => 'Menunggu',
                    },
                ];
            });

        $tahunBuku = $shuTerbaru?->year ?? now()->year;

        return view('anggota.shu.index', compact(
            'tahunBuku', 'totalSHU', 'statusSHU', 'jasaModal', 'jasaAnggota',
            'jasaModalPercent', 'jasaAnggotaPercent', 'disahkanPada', 'riwayatSHU'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $shuTerbaru = Shu::where('status', 'distributed')->latest('year')->first();

        if (!$shuTerbaru) {
            return redirect()->route('anggota.shu')->with('error', 'Belum ada SHU yang tersedia untuk diambil.');
        }

        $shuMember = ShuMember::where('shu_id', $shuTerbaru->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$shuMember || $shuMember->status !== 'distributed') {
            return redirect()->route('anggota.shu')->with('error', 'SHU tidak tersedia atau sudah diambil.');
        }

        $distributionMethod = $request->input('distribution_method', 'Tunai');
        $shuMember->update([
            'status' => 'taken',
            'distribution_method' => $distributionMethod,
            'taken_at' => now(),
        ]);

        return redirect()->route('anggota.shu')->with('success', 'SHU berhasil diambil. Metode: ' . $distributionMethod);
    }
}
