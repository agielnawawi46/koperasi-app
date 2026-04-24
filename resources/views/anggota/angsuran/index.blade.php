@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ openModal: false, selectedMonth: '' }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Data Angsuran</h1>
            <p class="text-slate-500 mt-1 font-medium">Manajemen pembayaran dan jadwal angsuran pinjaman aktif</p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
            <div class="p-2 bg-emerald-50 rounded-lg">
                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <span class="text-sm font-bold text-slate-600">Sistem Autodebet Aktif</span>
        </div>
    </div>

    {{-- ================= Info Cards ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Tagihan Bulan Ini --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Tagihan Mei 2026</p>
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-2xl transition-transform duration-500 group-hover:rotate-12">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp 525.000</h2>
                    <div class="mt-2 items-center gap-2 text-rose-600 text-[10px] font-black bg-rose-50 px-3 py-1 rounded-full inline-flex uppercase">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Jatuh Tempo: 25 Mei
                    </div>
                </div>
                <button @click="openModal = true; selectedMonth = 'Mei 2026'" class="w-full bg-slate-900 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-100 hover:-translate-y-1">
                    Bayar Sekarang
                </button>
            </div>
        </div>

        {{-- Progres Angsuran --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Progres Tenor</p>
                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl transition-transform duration-500 group-hover:-rotate-12">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-end gap-2">
                    <h2 class="text-4xl font-black text-slate-800">04<span class="text-lg text-slate-400">/12</span></h2>
                    <p class="text-[10px] font-bold text-slate-400 pb-1.5 uppercase">Bulan</p>
                </div>
                <div class="space-y-3">
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-emerald-500 h-full rounded-full transition-all duration-1000" style="width: 33%"></div>
                    </div>
                    <div class="items-center gap-2 text-emerald-600 text-xs font-bold bg-emerald-50 p-2 rounded-xl inline-flex">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        8 Bulan Tersisa
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Terbayar --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Terbayar</p>
                    <div class="p-3 bg-slate-100 text-slate-600 rounded-2xl transition-transform duration-500 group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp 2.100.000</h2>
                <div class="items-center gap-2 text-slate-500 text-[10px] font-black bg-slate-50 px-3 py-2 rounded-xl inline-flex uppercase tracking-tight">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Termasuk Jasa/Bunga
                </div>
            </div>
        </div>
    </div>

    {{-- ================= Jadwal Angsuran Table ================= --}}
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="font-bold text-slate-800 text-lg">Jadwal & Riwayat Angsuran</h2>
                <p class="text-xs text-slate-400 font-medium">Pinjaman Aktif: #PJM-8821</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <th class="pb-4">Bulan Ke</th>
                        <th class="pb-4">Tanggal Tagihan</th>
                        <th class="pb-4">Pokok</th>
                        <th class="pb-4">Jasa</th>
                        <th class="pb-4">Total Tagihan</th>
                        <th class="pb-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    {{-- Paid Row --}}
                    @for ($i = 1; $i <= 3; $i++)
                    <tr class="group opacity-60">
                        <td class="py-5 text-sm font-bold text-slate-500">{{ $i }}</td>
                        <td class="py-5 text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse("2026-0$i-25")->translatedFormat('d F Y') }}</td>
                        <td class="py-5 text-sm font-medium text-slate-500">Rp 500.000</td>
                        <td class="py-5 text-sm font-medium text-slate-500">Rp 25.000</td>
                        <td class="py-5 text-sm font-black text-slate-500">Rp 525.000</td>
                        <td class="py-5 text-center">
                            <div class="flex items-center justify-center gap-1.5 text-emerald-600 text-[9px] font-black bg-emerald-50 px-3 py-1 rounded-full uppercase w-fit mx-auto">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                Lunas
                            </div>
                        </td>
                    </tr>
                    @endfor

                    {{-- Current/Upcoming Row --}}
                    <tr class="group bg-blue-50/30">
                        <td class="py-5 text-sm font-bold text-blue-600">4</td>
                        <td class="py-5 text-sm text-slate-800 font-bold">25 Mei 2026</td>
                        <td class="py-5 text-sm font-medium text-slate-700">Rp 500.000</td>
                        <td class="py-5 text-sm font-medium text-slate-700">Rp 25.000</td>
                        <td class="py-5 text-sm font-black text-slate-800">Rp 525.000</td>
                        <td class="py-5 text-center">
                            <span class="text-[9px] font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase">Menunggu</span>
                        </td>
                    </tr>

                    {{-- Future Rows --}}
                    <tr class="group">
                        <td class="py-5 text-sm font-bold text-slate-400">5</td>
                        <td class="py-5 text-sm text-slate-400 font-medium">25 Juni 2026</td>
                        <td class="py-5 text-sm font-medium text-slate-400">Rp 500.000</td>
                        <td class="py-5 text-sm font-medium text-slate-400">Rp 25.000</td>
                        <td class="py-5 text-sm font-black text-slate-400">Rp 525.000</td>
                        <td class="py-5 text-center">
                            <span class="text-[9px] font-black text-slate-300 bg-slate-50 px-3 py-1 rounded-full uppercase">Belum Tersedia</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= Popup Konfirmasi Pembayaran ================= --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition x-cloak>
        
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden"
             @click.away="openModal = false">
            
            <div class="relative z-10 text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                
                <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Konfirmasi Bayar</h3>
                <p class="text-sm text-slate-500 mt-2">Anda akan melakukan pembayaran angsuran untuk bulan <span class="font-bold text-slate-800" x-text="selectedMonth"></span></p>

                <div class="my-8 p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total yang harus dibayar</p>
                    <p class="text-3xl font-black text-blue-600 tabular-nums">Rp 525.000</p>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-xl shadow-blue-100">
                        Bayar via Saldo Sukarela
                    </button>
                    <button type="button" @click="openModal = false" class="w-full bg-slate-100 text-slate-500 py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Batalkan
                    </button>
                </div>
                
                <p class="mt-6 text-[10px] text-slate-400 font-medium italic">
                    *Pastikan saldo simpanan sukarela Anda mencukupi.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection