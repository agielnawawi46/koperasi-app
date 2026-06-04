<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    public function index(): View
    {
        $org = Organization::first();

        $organisasi = $org ? [
            'nama' => $org->name,
            'perusahaan' => $org->company_name,
            'email' => $org->email,
            'alamat' => $org->address,
            'pokok' => $org->pokok_amount,
            'wajib' => $org->wajib_amount,
            'bunga' => $org->bunga_rate,
            'metode' => $org->metode,
            'payment_method' => $org->payment_method,
            'tgl_tagihan' => $org->tgl_tagihan,
        ] : [
            'nama' => null, 'perusahaan' => null, 'email' => null,
            'alamat' => null, 'pokok' => null, 'wajib' => null,
            'bunga' => null, 'metode' => null, 'payment_method' => null,
            'tgl_tagihan' => null,
        ];

        return view('admin.organisasi.index', compact('organisasi'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'nullable|string',
            'pokok' => 'required|numeric|min:0',
            'wajib' => 'required|numeric|min:0',
            'bunga' => 'required|numeric|min:0',
            'metode' => 'required|string|max:100',
            'payment_method' => 'required|string|max:100',
            'tgl_tagihan' => 'required|integer|between:1,28',
        ]);

        Organization::updateOrCreate(
            ['id' => 1],
            [
                'name' => $validated['nama'],
                'company_name' => $validated['perusahaan'],
                'email' => $validated['email'],
                'address' => $validated['alamat'],
                'pokok_amount' => $validated['pokok'],
                'wajib_amount' => $validated['wajib'],
                'bunga_rate' => $validated['bunga'],
                'metode' => $validated['metode'],
                'payment_method' => $validated['payment_method'],
                'tgl_tagihan' => $validated['tgl_tagihan'],
            ]
        );

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'update_organization',
            'description' => 'Memperbarui aturan dan prosedur organisasi',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Aturan organisasi berhasil diperbarui!');
    }
}
