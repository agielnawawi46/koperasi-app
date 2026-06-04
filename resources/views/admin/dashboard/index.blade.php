@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

{{-- Inisialisasi State Dashboard Menggunakan Alpine.js --}}
<div x-data="{ activeTab: 'simpanan' }" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= HEADER SECTION ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dashboard Admin</h1>
            <p class="text-slate-500 font-medium">
                {{ $organization?->name ?? 'Koperasi Karyawan Maju Jaya' }} • Periode {{ date('Y') }}
            </p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-2xl border border-slate-100 shadow-sm">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span class="text-xs font-bold text-slate-600">Sistem Operasional Aktif</span>
        </div>
    </div>

    {{-- ================= METRICS GRID (ROW 1) ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Card 1: Total Anggota --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-emerald-700 transition-colors">Total Anggota</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">{{ $totalAnggota ?? 325 }} <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">User</span></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-100/50 text-emerald-700 border border-emerald-200 uppercase tracking-widest">+12 Anggota Bulan Ini</div>
                </div>
            </div>
        </div>

        {{-- Card 2: Total Pinjaman Terhitung Bunga --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700 transition-colors">Total Pinjaman (+ Bunga)</p>
                    <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($totalPinjamanDenganBunga ?? 425000000, 0, ',', '.') }}</h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-100/50 text-amber-700 border border-amber-200 uppercase tracking-widest">Bunga: {{ $persentaseBunga ?? 'Flat 10%' }} • {{ $pinjamanAktif ?? 84 }} Berkas</div>
                </div>
            </div>
        </div>

        {{-- Card 3: Total Simpanan --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Total Simpanan</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-blue-600 tabular-nums">2.3 <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Miliar</span></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-blue-100/50 text-blue-700 border border-blue-200 uppercase tracking-widest">Rasio Likuiditas Aman</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= REVISI UTAMA: TABBED ANALYTICS CANVAS (ROW 2) ================= --}}
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-50 pb-4">
            <div>
                <h2 class="font-black text-slate-800 text-lg">Pusat Analisis Data</h2>
                <p class="text-sm text-slate-400 font-medium italic">Pilih tab di bawah untuk beralih visualisasi grafik</p>
            </div>
            
            {{-- Navigasi Tab Kontrol Grafik --}}
            <div class="flex items-center bg-slate-100/80 p-1.5 rounded-2xl w-fit">
                <button @click="activeTab = 'simpanan'" 
                        :class="activeTab === 'simpanan' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-xl text-xs font-black transition-all">
                    Simpanan Bulanan
                </button>
                <button @click="activeTab = 'pinjaman'" 
                        :class="activeTab === 'pinjaman' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-xl text-xs font-black transition-all">
                    Permintaan Pinjaman
                </button>
                <button @click="activeTab = 'tren'" 
                        :class="activeTab === 'tren' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-xl text-xs font-black transition-all">
                    Tren Pertumbuhan
                </button>
            </div>
        </div>

        {{-- Ruang Gambar Grafik (Hanya merender yang aktif) --}}
        <div class="h-[320px] relative">
            <div x-show="activeTab === 'simpanan'" x-transition:enter="transition ease-out duration-200" class="h-full w-full">
                <canvas id="simpananChart"></canvas>
            </div>
            <div x-show="activeTab === 'pinjaman'" x-transition:enter="transition ease-out duration-200" class="h-full w-full" x-cloak>
                <canvas id="pinjamanChart"></canvas>
            </div>
            <div x-show="activeTab === 'tren'" x-transition:enter="transition ease-out duration-200" class="h-full w-full" x-cloak>
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    {{-- ================= OPERATIONS AREA (ROW 3) ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        
        {{-- Tabel Pengajuan Menunggu (Lebih Lebar: 3 Kolom) --}}
        <div class="lg:col-span-3 bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
            <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight">Pengajuan Menunggu</h2>
                        <p class="text-sm text-slate-400 font-medium italic">Daftar berkas yang memerlukan persetujuan manual</p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                    {{ $pengajuanMenunggu ?? 7 }} Review
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nama</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($pendingLoans ?? [] as $loan)
                        <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                            <td class="px-8 py-6 font-black text-slate-800">{{ $loan->user->name }}</td>
                            <td class="px-8 py-6 font-black text-slate-800 tabular-nums">Rp {{ number_format($loan->amount) }}</td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-12 text-center font-bold text-slate-400 italic">Tidak ada pengajuan menunggu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-50 text-center">
                <a href="#" class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 hover:text-blue-800 transition-all">
                    Buka Semua Berkas Pengajuan &rarr;
                </a>
            </div>
        </div>

        {{-- List Log Aktivitas (Lebih Ringkas: 2 Kolom) --}}
        <div class="lg:col-span-2 bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100 relative overflow-hidden">
            <div class="flex items-center gap-5 mb-8">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Log Aktivitas</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Histori singkat sistem</p>
                </div>
            </div>
            
            <div class="space-y-5">
                @forelse ($recentLogs ?? [] as $log)
                <div class="flex gap-3 relative">
                    @if(!$loop->last)
                    <div class="absolute left-2.5 top-6 bottom-[-20px] w-[1.5px] bg-slate-100"></div>
                    @endif
                    <div class="w-5 h-5 rounded-full bg-{{ $loop->iteration % 3 === 0 ? 'amber' : ($loop->iteration % 3 === 1 ? 'emerald' : 'blue') }}-500 border-4 border-{{ $loop->iteration % 3 === 0 ? 'amber' : ($loop->iteration % 3 === 1 ? 'emerald' : 'blue') }}-50 shrink-0 z-10"></div>
                    <div class="text-sm">
                        <p class="font-black text-slate-800">{{ $log->user?->name ?? 'Sistem' }}</p>
                        <p class="text-slate-500 font-medium mt-0.5">{{ $log->description ?? $log->action }} • <span class="text-slate-400">{{ $log->created_at->diffForHumans() }}</span></p>
                    </div>
                </div>
                @empty
                <p class="text-slate-400 text-sm font-medium text-center py-4 italic">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>

    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection