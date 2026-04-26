@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= Header & Filter ================= --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Laporan Konsolidasi</h1>
            <p class="text-slate-500 font-medium">Monitoring transaksi bulanan, tahunan, dan proyeksi SHU.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <select class="px-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 focus:border-blue-500 outline-none shadow-sm">
                <option>Januari 2026</option>
                <option>Februari 2026</option>
                <option>Maret 2026</option>
            </select>
            <button class="group flex items-center gap-2 px-6 py-3.5 bg-slate-900 text-white font-black rounded-2xl shadow-xl shadow-slate-200 hover:bg-blue-600 transition-all active:scale-95">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="uppercase text-[10px] tracking-[0.1em]">Export PDF</span>
            </button>
        </div>
    </div>

    {{-- ================= Ringkasan Financial (SHU) ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-blue-600 p-8 rounded-[3rem] text-white relative overflow-hidden shadow-2xl shadow-blue-200">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500 rounded-full opacity-50 blur-3xl"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200 mb-2">Kalkulasi SHU Berjalan (Tahun Buku 2026)</p>
                    <h2 class="text-5xl font-black italic tracking-tighter">Rp 842.500.000</h2>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4 border-t border-blue-400/30 pt-6">
                    <div>
                        <p class="text-[10px] font-bold uppercase text-blue-200">Pendapatan Operasional</p>
                        <p class="text-xl font-black">Rp 1.2M</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase text-blue-200">Beban Organisasi</p>
                        <p class="text-xl font-black">Rp 357.5jt</p>
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
            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter">Terverifikasi</h3>
            <p class="text-xs text-slate-400 font-medium">Data transaksi sesuai dengan arus kas bank.</p>
        </div>
    </div>

    {{-- ================= Tabel Transaksi Bulanan/Tahunan ================= --}}
    {{-- Tambahkan x-data di pembungkus utama tabel --}}
<div x-data="{ tab: 'bulanan' }" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">

    <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/30">
        <div>
            <h3 class="font-black text-slate-800 uppercase tracking-wider text-sm">
                Rincian Transaksi <span x-text="tab == 'bulanan' ? 'Bulanan' : 'Tahunan'"></span>
            </h3>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Monitoring Arus Kas Masuk & Keluar</p>
        </div>

        {{-- Tombol Toggle dengan Logika Alpine.js --}}
        <div class="flex bg-white p-1 rounded-xl border border-slate-200">
            <button
                @click="tab = 'bulanan'"
                :class="tab == 'bulanan' ? 'bg-slate-900 text-white' : 'text-slate-400 hover:text-slate-800'"
                class="px-4 py-2 text-[10px] font-black uppercase rounded-lg transition-all duration-300">
                Bulanan
            </button>
            <button
                @click="tab = 'tahunan'"
                :class="tab == 'tahunan' ? 'bg-slate-900 text-white' : 'text-slate-400 hover:text-slate-800'"
                class="px-4 py-2 text-[10px] font-black uppercase rounded-lg transition-all duration-300">
                Tahunan
            </button>
        </div>
    </div>

    {{-- ================= Konten Tabel Bulanan ================= --}}
    <div x-show="tab == 'bulanan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4">
        <table class="w-full text-left border-collapse">
            {{-- ... isi tabel bulanan sama seperti kode sebelumnya ... --}}
            <tbody class="divide-y divide-slate-50">
                <tr class="group hover:bg-blue-50/30">
                    <td class="px-8 py-6 text-sm font-bold text-slate-500">Maret 2026</td>
                    <td class="px-8 py-6 font-black text-slate-800 text-sm">Rp 125.000.000</td>
                    {{-- dst --}}
                </tr>
            </tbody>
        </table>
    </div>

    {{-- ================= Konten Tabel Tahunan ================= --}}
    <div x-show="tab == 'tahunan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4">
        <table class="w-full text-left border-collapse">
            {{-- ... struktur sama, tapi data berisi rekap per tahun ... --}}
            <thead class="bg-slate-50/50 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">
                <tr>
                    <th class="px-8 py-5">Tahun Buku</th>
                    <th class="px-8 py-5">Total Pendapatan</th>
                    <th class="px-8 py-5">Total SHU</th>
                    <th class="px-8 py-5 text-center">Status Audit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <tr class="group hover:bg-blue-50/30">
                    <td class="px-8 py-6 text-sm font-black text-slate-700">2025</td>
                    <td class="px-8 py-6 font-bold text-slate-600 text-sm">Rp 14.200.000.000</td>
                    <td class="px-8 py-6 font-black text-blue-600 text-sm">Rp 1.200.000.000</td>
                    <td class="px-8 py-6 text-center">
                         <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-lg text-[10px] font-black uppercase">Finalized</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/30">
            <div>
                <h3 class="font-black text-slate-800 uppercase tracking-wider text-sm">Rincian Transaksi Terkini</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Monitoring Arus Kas Masuk & Keluar</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">
                    <tr>
                        <th class="px-8 py-5">Tanggal Transaksi</th>
                        <th class="px-8 py-5">Kategori</th>
                        <th class="px-8 py-5">Deskripsi Aliran Dana</th>
                        <th class="px-8 py-5">Nominal</th>
                        <th class="px-8 py-5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    {{-- Baris Transaksi --}}
                    <tr class="group hover:bg-blue-50/30 transition-colors">
                        <td class="px-8 py-6 text-sm font-bold text-slate-500">24 Mar 2026</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-[10px] font-black uppercase">Simpanan</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-black text-slate-700 text-sm">Setoran Pokok Anggota #DK-90</p>
                        </td>
                        <td class="px-8 py-6 font-black text-slate-800 text-sm">Rp 1.000.000</td>
                        <td class="px-8 py-6 text-center">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                        </td>
                    </tr>

                    {{-- Baris Transaksi --}}
                    <tr class="group hover:bg-blue-50/30 transition-colors">
                        <td class="px-8 py-6 text-sm font-bold text-slate-500">22 Mar 2026</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-lg text-[10px] font-black uppercase">Pinjaman</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-black text-slate-700 text-sm">Pencairan Modal Kerja #PJ-112</p>
                        </td>
                        <td class="px-8 py-6 font-black text-red-500 text-sm">(Rp 15.000.000)</td>
                        <td class="px-8 py-6 text-center">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Footer Tabel --}}
        <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
            <p class="text-xs font-bold text-slate-400">Menampilkan 10 dari 150 transaksi bulan ini</p>
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
    .animate-fade-in { animation: fade-in 0.5s ease-out forwards; }
</style>
@endsection