<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\View\View;

class AuditPinjamanController extends Controller
{
    public function index(): View
    {
        $outstanding = Loan::whereIn('status', ['approved', 'ready_for_disbursement', 'active'])->sum('amount');

        $stats = [
            ['name' => 'Plafon Cair', 'count' => Loan::whereIn('status', ['active', 'paid'])->count()],
            ['name' => 'Permohonan Baru', 'count' => Loan::where('status', 'pending')->count()],
            ['name' => 'Ditolak', 'count' => Loan::where('status', 'rejected')->count()],
            ['name' => 'Menunggu Pencairan', 'count' => Loan::whereIn('status', ['approved', 'ready_for_disbursement'])->count()],
        ];

        $auditPinjaman = Loan::with('user')
            ->latest()
            ->get()
            ->map(function ($loan) {
                return [
                    'peminjam' => $loan->user->name,
                    'no_berkas' => $loan->loan_number,
                    'tujuan' => $loan->purpose ?? '-',
                    'nominal' => $loan->amount,
                    'status_audit' => match ($loan->status) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'ready_for_disbursement' => 'Siap Cair',
                        'active' => 'Aktif',
                        'rejected' => 'Ditolak',
                        'paid' => 'Lunas',
                        default => $loan->status,
                    },
                ];
            });

        return view('pengawas.audpinjaman.index', compact(
            'outstanding', 'stats', 'auditPinjaman'
        ));
    }
}
