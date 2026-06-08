<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
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
                $statusSHU = match ($shuMember->status) {
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
                    'status' => match ($item->status) {
                        'distributed' => 'Dibagikan',
                        'taken' => 'Sudah Diambil',
                        default => 'Menunggu',
                    },
                ];
            });

        $tahunBuku = $shuTerbaru?->year ?? now()->year;

        $organization = Organization::first();

        return view('anggota.shu.index', compact(
            'tahunBuku', 'totalSHU', 'statusSHU', 'jasaModal', 'jasaAnggota',
            'jasaModalPercent', 'jasaAnggotaPercent', 'disahkanPada', 'riwayatSHU'
        ) + [
            'bankName' => $organization?->bank_name,
            'bankAccountName' => $organization?->bank_account_name,
            'bankAccountNumber' => $organization?->bank_account_number,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $shuTerbaru = Shu::where('status', 'distributed')->latest('year')->first();

        if (! $shuTerbaru) {
            return redirect()->route('anggota.shu')->with('error', 'Belum ada SHU yang tersedia untuk diambil.');
        }

        $shuMember = ShuMember::where('shu_id', $shuTerbaru->id)
            ->where('user_id', $user->id)
            ->first();

        if (! $shuMember || $shuMember->status !== 'distributed') {
            return redirect()->route('anggota.shu')->with('error', 'SHU tidak tersedia atau sudah diambil.');
        }

        $distributionMethod = $request->input('distribution_method', 'Tunai');

        $shuMember->update([
            'status' => 'taken',
            'distribution_method' => $distributionMethod,
            'taken_at' => now(),
        ]);

        if ($distributionMethod === 'Simpanan Sukarela') {
            $simpananSukarela = Saving::firstOrCreate(
                ['user_id' => $user->id, 'type' => 'sukarela'],
                ['balance' => 0]
            );

            $simpananSukarela->increment('balance', $shuMember->amount);

            SavingsTransaction::create([
                'saving_id' => $simpananSukarela->id,
                'user_id' => $user->id,
                'type' => 'setor',
                'amount' => $shuMember->amount,
                'transaction_date' => now(),
                'status' => 'approved',
                'description' => 'Transfer dari SHU Tahun '.($shuTerbaru->year ?? '-'),
            ]);

            return redirect()->route('anggota.shu')->with('success', 'SHU berhasil dipindahkan ke Simpanan Sukarela. Saldo langsung bertambah.');
        }

        return redirect()->route('anggota.shu')->with('success', 'SHU berhasil diambil. Metode: '.$distributionMethod);
    }
}
