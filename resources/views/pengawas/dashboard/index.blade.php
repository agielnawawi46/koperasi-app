@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8 animate-fade-in">

    {{-- ================= Header ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dashboard Pengawas</h1>
            <p class="text-slate-500 font-medium">Gambaran umum dan pemantauan sistem operasional DanaKarya.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl shadow-sm hover:border-blue-500 hover:text-blue-600 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-50 group-hover:bg-blue-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                </div>
                Refresh Data
            </button>
        </div>
    </div>

    {{-- ================= Ringkasan Grid ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total Transaksi --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">Total Transaksi Selesai</p>
                    <div class="p-4 bg-slate-100 text-slate-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-slate-800 tabular-nums tracking-tight">{{ number_format($totalTransaksiSelesai) }}</h2>
                    <div class="mt-2 items-center gap-2 text-slate-500 text-[10px] font-black bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200 inline-flex uppercase">
                        Data Tersinkronisasi
                    </div>
                </div>
            </div>
        </div>

        {{-- Laporan Bulanan --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Laporan Bulanan Aktif</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-slate-800 tabular-nums tracking-tight">{{ $laporanBulananAktif }}</h2>
                    <div class="mt-2 items-center gap-2 text-blue-600 text-[10px] font-black bg-blue-100/50 px-3 py-1.5 rounded-xl border border-blue-200 inline-flex uppercase">
                        Siklus Tahunan
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Sistem --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-emerald-700 transition-colors">Status Sistem</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-emerald-500 tracking-tight">{{ $sistemStatus }}</h2>
                    <div class="mt-2 flex items-center gap-2 text-emerald-600 text-[10px] font-black bg-emerald-100/50 px-3 py-1.5 rounded-xl border border-emerald-200 uppercase w-fit">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Aman Terkendali
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        {{-- ================= Monitoring Checklist ================= --}}
        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden relative">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Monitoring Sistem</h2>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Status Operasional Harian</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center p-5 bg-slate-50 border border-slate-100 rounded-2xl group hover:border-emerald-200 hover:bg-white transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="font-bold text-slate-700 text-sm">Transaksi berjalan normal</span>
                    </div>
                    <span class="text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">OK</span>
                </div>

                <div class="flex justify-between items-center p-5 bg-slate-50 border border-slate-100 rounded-2xl group hover:border-emerald-200 hover:bg-white transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="font-bold text-slate-700 text-sm">Tidak ada anomali pinjaman</span>
                    </div>
                    <span class="text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">OK</span>
                </div>

                <div class="flex justify-between items-center p-5 bg-slate-50 border border-slate-100 rounded-2xl group hover:border-emerald-200 hover:bg-white transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="font-bold text-slate-700 text-sm">Validasi saldo sistem aktif</span>
                    </div>
                    <span class="text-[10px] font-black uppercase text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg">OK</span>
                </div>
            </div>
        </div>

        {{-- ================= Akses Cepat ================= --}}
        <div class="bg-slate-900 p-8 rounded-[3rem] shadow-xl shadow-slate-200/50 relative overflow-hidden text-white flex flex-col justify-between">
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-slate-800 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 mb-8">
                <h2 class="text-xl font-black tracking-tight">Akses Laporan Cepat</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Buka modul laporan krusial</p>
            </div>

            <div class="grid grid-cols-1 gap-4 relative z-10">
                <a href="#" class="group flex items-center justify-between p-5 bg-slate-800/80 hover:bg-blue-600 rounded-2xl backdrop-blur-sm transition-all border border-slate-700 hover:border-blue-500">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-slate-700 text-white rounded-lg group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <span class="font-black text-sm uppercase tracking-wider">Laporan Transaksi</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-white transition-colors group-hover:translate-x-1 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="#" class="group flex items-center justify-between p-5 bg-slate-800/80 hover:bg-emerald-600 rounded-2xl backdrop-blur-sm transition-all border border-slate-700 hover:border-emerald-500">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-slate-700 text-white rounded-lg group-hover:bg-white/20 transition-colors">
                             <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="font-black text-sm uppercase tracking-wider">Laporan Simpanan</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-white transition-colors group-hover:translate-x-1 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="#" class="group flex items-center justify-between p-5 bg-slate-800/80 hover:bg-amber-600 rounded-2xl backdrop-blur-sm transition-all border border-slate-700 hover:border-amber-500">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-slate-700 text-white rounded-lg group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        </div>
                        <span class="font-black text-sm uppercase tracking-wider">Laporan Pinjaman</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-500 group-hover:text-white transition-colors group-hover:translate-x-1 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
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
