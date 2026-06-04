@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= Header & Filter ================= --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Laporan Konsolidasi</h1>
            <p class="text-slate-500 font-medium">Monitoring transaksi bulanan, tahunan, dan proyeksi SHU.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <select class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                @foreach($transaksiBulanan as $t)
                <option value="{{ $t['bulan'] }}">{{ $t['bulan'] }}</option>
                @endforeach
            </select>
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-xl shadow-slate-200 hover:bg-slate-900 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-700 group-hover:bg-red-500 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                Export PDF
            </button>
        </div>
    </div>

    {{-- ================= Ringkasan Financial (SHU) ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-blue-600 p-8 rounded-[3rem] text-white relative overflow-hidden shadow-2xl shadow-blue-200">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500 rounded-full opacity-50 blur-3xl"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200 mb-2">Kalkulasi SHU Berjalan (Tahun Buku {{ date('Y') }})</p>
                    <h2 class="text-5xl font-black italic tracking-tighter">Rp {{ number_format($shuBerjalan) }}</h2>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4 border-t border-blue-400/30 pt-6">
                    <div>
                        <p class="text-[10px] font-bold uppercase text-blue-200">Pendapatan Operasional</p>
                        <p class="text-xl font-black">Rp {{ number_format($pendapatanOperasional) }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase text-blue-200">Beban Organisasi</p>
                        <p class="text-xl font-black">Rp {{ number_format($bebanOrganisasi) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm flex flex-col justify-center text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Status Audit Laporan</p>
            <div class="inline-flex mx-auto p-5 bg-emerald-50 rounded-full mb-4">
                <svg class="w-10 h-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04" />
                </svg>
            </div>
            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter">{{ $statusAudit }}</h3>
            <p class="text-xs text-slate-400 font-medium">Data transaksi sesuai dengan arus kas bank.</p>
        </div>
    </div>

    {{-- ================= Tabel Transaksi Bulanan/Tahunan ================= --}}
<div x-data="{ tab: 'bulanan' }" class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">

    <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Rincian Transaksi <span x-text="tab == 'bulanan' ? 'Bulanan' : 'Tahunan'"></span></h2>
                <p class="text-sm text-slate-400 font-medium italic">Monitoring Arus Kas Masuk & Keluar</p>
            </div>
        </div>

        <div class="flex bg-white p-1 rounded-xl border border-slate-200">
            <button @click="tab = 'bulanan'" :class="tab == 'bulanan' ? 'bg-slate-900 text-white' : 'text-slate-400 hover:text-slate-800'" class="px-4 py-2 text-[10px] font-black uppercase rounded-lg transition-all duration-300">
                Bulanan
            </button>
            <button @click="tab = 'tahunan'" :class="tab == 'tahunan' ? 'bg-slate-900 text-white' : 'text-slate-400 hover:text-slate-800'" class="px-4 py-2 text-[10px] font-black uppercase rounded-lg transition-all duration-300">
                Tahunan
            </button>
        </div>
    </div>

    {{-- ================= Konten Tabel Bulanan ================= --}}
    <div x-show="tab == 'bulanan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4">
        <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Bulan</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total Transaksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transaksiBulanan as $t)
                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                    <td class="px-8 py-7 text-sm font-bold text-slate-500">{{ $t['bulan'] }}</td>
                    <td class="px-8 py-7 text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($t['total']) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada data transaksi bulanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    {{-- ================= Konten Tabel Tahunan ================= --}}
    <div x-show="tab == 'tahunan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4">
        <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tahun Buku</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total Pendapatan</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total SHU</th>
                    <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status Audit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transaksiTahunan as $t)
                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                    <td class="px-8 py-7 text-sm font-black text-slate-700">{{ $t['tahun'] }}</td>
                    <td class="px-8 py-7 text-sm font-bold text-slate-600 tabular-nums">Rp {{ number_format($t['total_pendapatan']) }}</td>
                    <td class="px-8 py-7 text-sm font-black text-blue-600 tabular-nums">Rp {{ number_format($t['total_shu']) }}</td>
                    <td class="px-8 py-7 text-center">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            {{ $t['status_audit'] }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada data tahunan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Rincian Transaksi Terkini</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Monitoring Arus Kas Masuk & Keluar</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tanggal Transaksi</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Kategori</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Deskripsi Aliran Dana</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transaksiTerkini as $t)
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-7 text-sm font-bold text-slate-500">{{ $t['tanggal'] }}</td>
                        <td class="px-8 py-7">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 {{ $t['kategori'] === 'SHU' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-amber-50 text-amber-700 border-amber-100' }} text-[10px] font-black rounded-xl border uppercase tracking-wide">
                                {{ $t['kategori'] }}
                            </span>
                        </td>
                        <td class="px-8 py-7">
                            <p class="text-sm font-black text-slate-700">{{ $t['deskripsi'] }}</p>
                        </td>
                        <td class="px-8 py-7 text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($t['nominal']) }}</td>
                        <td class="px-8 py-7 text-center">
                            @if($t['status'] === 'Terverifikasi')
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                Pending
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada transaksi terkini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer Tabel --}}
        <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
            <p class="text-xs font-bold text-slate-400">Menampilkan {{ $ditampilkan }} dari {{ $totalTransaksi }} transaksi</p>
            <div class="flex gap-2">
                <button class="p-2 bg-white border border-slate-200 rounded-lg hover:border-blue-500 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button class="p-2 bg-white border border-slate-200 rounded-lg hover:border-blue-500 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </button>
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