@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Audit Pinjaman</h1>
            <p class="text-slate-500 font-medium">Monitoring penyaluran dana dan status persetujuan pinjaman.</p>
        </div>
        <div class="p-4 bg-amber-50 border border-amber-100 rounded-2xl flex items-center gap-3 text-amber-700">
            <span class="text-xs font-black uppercase tracking-wider text-slate-400">Outstanding Pinjaman:</span>
            <span class="font-black text-slate-800">Rp 850.000.000</span>
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach(['Plafon Cair', 'Permohonan Baru', 'Ditolak', 'Menunggu Persetujuan'] as $stat)
        <div class="bg-white p-6 rounded-3xl border border-slate-100">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ $stat }}</p>
            <p class="text-xl font-black text-slate-800">24 Transaksi</p>
        </div>
        @endforeach
    </div>

    {{-- Tabel Monitoring Pinjaman --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
            <h3 class="font-black text-slate-800 uppercase tracking-wider text-sm">Daftar Audit Penyaluran Dana</h3>
        </div>
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">
                <tr>
                    <th class="px-8 py-5">Peminjam</th>
                    <th class="px-8 py-5">Tujuan Pinjaman</th>
                    <th class="px-8 py-5">Nominal Plafon</th>
                    <th class="px-8 py-5 text-center">Status Audit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <tr class="group hover:bg-amber-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-700">Budi Santoso</p>
                        <p class="text-[10px] text-slate-400 font-bold">#PJN-2026-001</p>
                    </td>
                    <td class="px-8 py-6 text-slate-500 italic">Modal Usaha Mikro</td>
                    <td class="px-8 py-6 font-black text-slate-800">Rp 15.000.000</td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-amber-100 text-amber-600 rounded-xl text-[9px] font-black uppercase border border-amber-200">Pending Approval</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection