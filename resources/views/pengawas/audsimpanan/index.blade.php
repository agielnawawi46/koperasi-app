@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Audit Simpanan</h1>
            <p class="text-slate-500 font-medium">Monitoring validitas total simpanan anggota dan kas masuk.</p>
        </div>
        <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-center gap-3 text-blue-700">
            <span class="text-xs font-black uppercase tracking-wider text-slate-400">Total Kas Simpanan:</span>
            <span class="font-black">Rp 2.450.000.000</span>
        </div>
    </div>

    {{-- Kategori Simpanan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach(['Simpanan Pokok', 'Simpanan Wajib', 'Simpanan Sukarela'] as $item)
        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:border-blue-500 transition-all">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $item }}</p>
            <h3 class="text-2xl font-black text-slate-800 mt-1">Rp 450.000.000</h3>
            <div class="mt-4 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                <span class="text-[10px] font-bold text-slate-400 uppercase">Terverifikasi Sistem</span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Tabel Riwayat Simpanan --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50">
            <h3 class="font-black text-slate-800 uppercase tracking-wider text-sm">Log Mutasi Simpanan Terakhir</h3>
        </div>
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">
                <tr>
                    <th class="px-8 py-4">Anggota</th>
                    <th class="px-8 py-4">Jenis</th>
                    <th class="px-8 py-4">Nominal</th>
                    <th class="px-8 py-4 text-center">Audit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 font-bold text-slate-700">Agiel Syah</td>
                    <td class="px-8 py-5 text-slate-500">Wajib</td>
                    <td class="px-8 py-5 font-black text-emerald-600">Rp 100.000</td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase tracking-tighter">Match</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection