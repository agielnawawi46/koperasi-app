@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8 animate-fade-in">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Monitoring Aktif</h1>
            <p class="text-slate-500 font-medium">Pantau aktivitas operasional dan transaksi harian.</p>
        </div>
        <div class="flex items-center gap-3 px-5 py-2.5 bg-emerald-50 rounded-2xl border border-emerald-100 shadow-sm">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <span class="text-[10px] font-black text-emerald-700 uppercase tracking-[0.2em]">Live</span>
        </div>
    </div>

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Transaksi Hari Ini</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">{{ $transaksiHariIni }}</h2>
                    <div class="mt-2 inline-flex items-center gap-2 text-blue-600 text-[10px] font-black bg-blue-100/50 px-3 py-1.5 rounded-xl border border-blue-200">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                        {{ $growthPersen >= 0 ? '+' : '' }}{{ $growthPersen }}% Dari Kemarin
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Pengajuan Pending</p>
                    <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">{{ $pengajuanPending }}</h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-100/50 text-amber-700 border border-amber-200 uppercase tracking-widest">
                        Perhatian
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Sistem</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-emerald-500 tracking-tight">Normal</h2>
                    <div class="mt-2 inline-flex items-center gap-2 text-emerald-600 text-[10px] font-black bg-emerald-100/50 px-3 py-1.5 rounded-xl border border-emerald-200 uppercase w-fit">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= ACTIVITY TABLE ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Aktivitas Terkini</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Log transaksi 24 jam terakhir.</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Waktu</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Anggota</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Aktivitas</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($aktivitas as $a)
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-6 text-sm font-bold text-slate-600 tabular-nums">{{ $a['waktu'] }} WIB</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300">{{ $a['inisial'] }}</div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $a['nama'] }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">{{ $a['jenis'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-600">{{ $a['aktivitas'] }}</td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                {{ $a['status'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection
