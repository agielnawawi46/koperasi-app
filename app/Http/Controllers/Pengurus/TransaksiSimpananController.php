<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaksiSimpananController extends Controller
{
    public function index(): View
    {
        $totalPokok = Saving::where('type', 'pokok')->sum('balance');
        $totalWajib = Saving::where('type', 'wajib')->sum('balance');
        $totalSukarela = Saving::where('type', 'sukarela')->sum('balance');

        $transaksi = SavingsTransaction::with('saving.user')
            ->latest()
            ->take(50)
            ->get();

        $organization = Organization::first();

        return view('pengurus.transsimpanan.index', compact(
            'totalPokok', 'totalWajib', 'totalSukarela',
            'transaksi', 'organization'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:pokok,wajib,sukarela',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $saving = Saving::firstOrCreate(
            ['user_id' => $request->user_id, 'type' => $request->type],
            ['balance' => 0]
        );

        $saving->increment('balance', $request->amount);

        SavingsTransaction::create([
            'saving_id' => $saving->id,
            'user_id' => $request->user_id,
            'type' => 'credit',
            'amount' => $request->amount,
            'description' => $request->description ?? 'Setoran ' . $request->type,
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'savings_transaction',
            'description' => 'Setoran simpanan ' . $request->type . ' untuk ' . User::find($request->user_id)?->name,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('pengurus.transsimpanan')->with('success', 'Transaksi simpanan berhasil!');
    }
}
