@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Dashboard Admin</h1>
            <p class="text-slate-500 mt-1 font-medium">Selamat datang kembali, <span class="text-blue-600">{{ auth()->user()->name ?? 'Administrator' }}</span></p>
        </div>
    </div>

    {{-- ================= Info Banner Koperasi ================= --}}
    <div class="relative overflow-hidden bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 group">
        <div class="absolute top-0 right-0 w-48 h-48 bg-blue-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:bg-blue-100"></div>
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="flex items-center gap-6">
                <div class="p-4 bg-blue-600 rounded-[2rem] shadow-lg shadow-blue-200">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Entitas Koperasi</p>
                    <h3 class="font-black text-2xl text-slate-800 mt-1">{{ $namaKoperasi ?? 'Koperasi Karyawan Maju Jaya' }}</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-xs font-bold text-slate-500">Sistem Operasional</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-8 lg:pr-20">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Bunga</p>
                    <p class="font-black text-lg text-slate-700">{{ $metodeBunga ?? 'Flat Rate' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode</p>
                    <p class="font-black text-lg text-slate-700">2026</p>
                </div>
                <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 transition-all">
                    Konfigurasi
                </button>
            </div>
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {{-- Total Anggota --}}
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Anggota</p>
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-4xl font-black text-slate-800">{{ $totalAnggota ?? 325 }} <span class="text-sm font-bold text-slate-400">User</span></h2>
            <div class="flex items-center gap-2 text-emerald-600 text-[10px] font-black bg-emerald-50 px-3 py-1 rounded-full uppercase w-fit">
                +12 Anggota Baru
            </div>
        </div>
    </div>

    {{-- Pinjaman Aktif --}}
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Pinjaman Aktif</p>
                <div class="p-3 bg-amber-100 text-amber-700 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <h2 class="text-4xl font-black text-slate-800">{{ $pinjamanAktif ?? 84 }} <span class="text-sm font-bold text-slate-400">Berkas</span></h2>
            <div class="flex items-center gap-2 text-rose-600 text-[10px] font-black bg-rose-50 px-3 py-1 rounded-full uppercase italic w-fit">
                {{ $tunggakan ?? 3 }} Tunggakan
            </div>
        </div>
    </div>

    {{-- Total Simpanan --}}
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Simpanan</p>
                <div class="p-3 bg-blue-100 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-4xl font-black text-blue-600">2.3 <span class="text-sm font-bold text-slate-400">Miliar</span></h2>
            <div class="flex items-center gap-2 text-blue-600 text-[10px] font-black bg-blue-50 px-3 py-1 rounded-full uppercase w-fit">
                Likuiditas Aman
            </div>
        </div>
    </div>
</div>

    {{-- ================= Grafik Section ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Grafik Simpanan --}}
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="font-bold text-slate-800 text-lg">Simpanan Bulanan</h2>
                    <p class="text-xs text-slate-400 font-medium">Statistik volume masuk (Bar Chart)</p>
                </div>
                <select class="text-xs font-bold bg-slate-50 border-none rounded-xl focus:ring-0">
                    <option>Tahun 2025</option>
                </select>
            </div>
            <div class="h-[250px]">
                <canvas id="simpananChart"></canvas>
            </div>
        </div>

        {{-- Grafik Pinjaman --}}
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="font-bold text-slate-800 text-lg">Permintaan Pinjaman</h2>
                    <p class="text-xs text-slate-400 font-medium">Tren 6 bulan terakhir (Line Chart)</p>
                </div>
                <div class="flex gap-1">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span class="w-2 h-2 rounded-full bg-slate-200"></span>
                </div>
            </div>
            <div class="h-[250px]">
                <canvas id="pinjamanChart"></canvas>
            </div>
        </div>
    </div>

    {{-- ================= Tren Pertumbuhan ================= --}}
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <h2 class="font-bold text-slate-800 text-lg mb-8">Tren Pertumbuhan Simpanan vs Pinjaman</h2>
        <div class="h-[300px]">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    {{-- ================= Bottom Row ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        
        {{-- List Aktivitas --}}
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-slate-800 text-lg">Log Aktivitas</h2>
                <button class="p-2 hover:bg-slate-50 rounded-xl transition-colors text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                </button>
            </div>
            <div class="space-y-6">
                {{-- Item Aktivitas... (Tetap sama) --}}
                <div class="flex gap-4 relative">
                    <div class="absolute left-3 top-8 bottom-[-24px] w-[2px] bg-slate-100"></div>
                    <div class="w-6 h-6 rounded-full bg-emerald-500 border-4 border-emerald-50 shadow-sm shrink-0 z-10"></div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Budi Santoso</p>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium">Melakukan simpanan wajib • <span class="text-slate-400">2 menit lalu</span></p>
                    </div>
                </div>
                {{-- Item lainnya... --}}
            </div>
        </div>

        {{-- Tabel Pengajuan --}}
        <div class="lg:col-span-3 bg-white p-8 rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-slate-800 text-lg">Pengajuan Menunggu</h2>
                <span class="text-[10px] font-black bg-amber-100 text-amber-700 px-3 py-1 rounded-full uppercase tracking-tighter">
                    {{ $pengajuanMenunggu ?? 7 }} Perlu Review
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    {{-- Struktur Table... (Tetap sama) --}}
                </table>
            </div>
            <a href="#" class="block text-center text-xs font-bold text-blue-600 hover:text-blue-800 mt-6 pt-4 border-t border-slate-50">
                Buka Semua Pengajuan &rarr;
            </a>
        </div>

    </div>

</div>

@endsection
