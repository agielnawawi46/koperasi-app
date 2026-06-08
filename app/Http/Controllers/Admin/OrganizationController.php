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
            'bank_name' => $org->bank_name,
            'bank_account_name' => $org->bank_account_name,
            'bank_account_number' => $org->bank_account_number,
        ] : [
            'nama' => null, 'perusahaan' => null, 'email' => null,
            'alamat' => null, 'pokok' => null, 'wajib' => null,
            'bunga' => null, 'metode' => null, 'payment_method' => null,
            'tgl_tagihan' => null, 'bank_name' => null, 'bank_account_name' => null,
            'bank_account_number' => null,
        ];

        return view('admin.organisasi.index', compact('organisasi'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'perusahaan' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'alamat' => 'sometimes|nullable|string',
            'phone' => 'sometimes|nullable|string|max:20',
            'website' => 'sometimes|nullable|string|max:255',
            'pokok' => 'sometimes|required|numeric|min:0',
            'wajib' => 'sometimes|required|numeric|min:0',
            'bunga' => 'sometimes|required|numeric|min:0',
            'metode' => 'sometimes|required|string|max:100',
            'payment_method' => 'sometimes|required|string|max:100',
            'tgl_tagihan' => 'sometimes|required|integer|between:1,28',
            'bank_name' => 'sometimes|nullable|string|max:100',
            'bank_account_name' => 'sometimes|nullable|string|max:100',
            'bank_account_number' => 'sometimes|nullable|string|max:50',
        ]);

        $org = Organization::first();

        Organization::updateOrCreate(
            ['id' => 1],
            [
                'name' => $validated['nama'] ?? $org?->name,
                'company_name' => $validated['perusahaan'] ?? $org?->company_name,
                'email' => $validated['email'] ?? $org?->email,
                'address' => array_key_exists('alamat', $validated) ? $validated['alamat'] : $org?->address,
                'phone' => array_key_exists('phone', $validated) ? $validated['phone'] : $org?->phone,
                'website' => array_key_exists('website', $validated) ? $validated['website'] : $org?->website,
                'pokok_amount' => $validated['pokok'] ?? $org?->pokok_amount,
                'wajib_amount' => $validated['wajib'] ?? $org?->wajib_amount,
                'bunga_rate' => $validated['bunga'] ?? $org?->bunga_rate,
                'metode' => $validated['metode'] ?? $org?->metode,
                'payment_method' => $validated['payment_method'] ?? $org?->payment_method,
                'tgl_tagihan' => $validated['tgl_tagihan'] ?? $org?->tgl_tagihan,
                'bank_name' => array_key_exists('bank_name', $validated) ? $validated['bank_name'] : $org?->bank_name,
                'bank_account_name' => array_key_exists('bank_account_name', $validated) ? $validated['bank_account_name'] : $org?->bank_account_name,
                'bank_account_number' => array_key_exists('bank_account_number', $validated) ? $validated['bank_account_number'] : $org?->bank_account_number,
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
