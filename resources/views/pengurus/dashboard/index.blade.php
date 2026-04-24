@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= HEADER & GREETING ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Dashboard Pengurus</h1>
            <p class="text-slate-500 font-medium">Selamat datang kembali, pantau kesehatan finansial **DanaKarya** hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            {{-- Tombol Excel --}}
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl shadow-sm hover:border-green-500 hover:text-green-600 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-50 group-hover:bg-green-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                Export Excel
            </button>
            
            {{-- Tombol PDF --}}
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-xl shadow-slate-200 hover:bg-slate-900 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-700 group-hover:bg-red-500 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                </div>
                Cetak PDF
            </button>
        </div>
    </div>

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Total Simpanan --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-green-700 transition-colors">Simpanan Bulan Ini</p>
                    <div class="p-4 bg-green-100 text-green-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp 500.000.000</h2>
                    <div class="mt-2 inline-flex items-center gap-2 text-green-600 text-[10px] font-black bg-green-100/50 px-3 py-1.5 rounded-xl border border-green-200">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        +12% TREND POSITIF
                    </div>
                </div>
            </div>
        </div>

        {{-- Pengajuan Pinjaman --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700 transition-colors">Pengajuan Pending</p>
                    <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">25 <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Berkas</span></h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-100/50 text-amber-700 border border-amber-200 uppercase tracking-widest">
                        Perlu Tindakan
                    </div>
                </div>
            </div>
        </div>

        {{-- Cicilan Aktif --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Pinjaman Aktif</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">120 <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Anggota</span></h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-blue-100/50 text-blue-700 border border-blue-200 uppercase tracking-widest">
                        Rp 1.2M Outstanding
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABEL PENGAJUAN TERBARU ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Antrian Pengajuan</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Kelola persetujuan pinjaman anggota secara cepat.</p>
                </div>
            </div>
            <a href="#" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-slate-50 transition-all shadow-sm">
                Lihat Semua
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Data Anggota</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal Pengajuan</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tenor</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status Kontrak</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    {{-- Row 1: Menunggu --}}
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300 shadow-sm">
                                    BS
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">Budi Santoso</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">IT Department</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800 tabular-nums">Rp 5.000.000</p>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5 italic">Dana Darurat</p>
                        </td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-600 tracking-tight">12 <span class="text-[10px] text-slate-400 uppercase">Bulan</span></td>
                        <td class="px-8 py-6">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                Menunggu Review
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <button title="Lihat Berkas" class="p-3 text-blue-600 bg-blue-50 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm active:scale-90">
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                                <button title="Setujui" class="p-3 text-green-600 bg-green-50 rounded-xl hover:bg-green-600 hover:text-white transition-all shadow-sm active:scale-90">
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    {{-- Row 2: Selesai --}}
                    <tr class="group hover:bg-slate-50 transition-all duration-300 opacity-70">
                        <td class="px-8 py-6 text-slate-400 italic font-medium text-xs" colspan="4">
                            Siti Aminah • Rp 3.000.000 • 6 Bulan • <span class="text-green-600 font-bold uppercase ml-2">Sudah Diproses</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="px-4 py-1.5 bg-slate-100 text-slate-400 text-[10px] font-black rounded-xl uppercase tracking-widest border border-slate-200">
                                ARCHIVED
                            </div>
                        </td>
                    </tr>
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