@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 space-y-8 animate-fade-in"
     x-data="lapharianApp()"
     x-init="fetchData()">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Operasional Koperasi</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola dan pantau seluruh kegiatan operasional <strong>DanaKarya</strong>.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-2.5 shadow-sm">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <input type="date" x-model="selectedDate" @change="fetchData()"
                       class="text-xs font-bold text-slate-600 outline-none bg-transparent">
            </div>
        </div>
    </div>

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        {{-- Total Pemasukan --}}
        <div class="group relative bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-green-700">Pemasukan</p>
                    <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(summary.pemasukan).toLocaleString('id-ID')">Rp 0</h3>
            </div>
        </div>

        {{-- Penyaluran --}}
        <div class="group relative bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700">Penyaluran</p>
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(summary.penyaluran).toLocaleString('id-ID')">Rp 0</h3>
            </div>
        </div>

        {{-- Total Transaksi --}}
        <div class="group relative bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700">Total Transaksi</p>
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 tabular-nums" x-text="Number(summary.total_transaksi).toLocaleString('id-ID') + ' Trx'">0 Trx</h3>
            </div>
        </div>

        {{-- Net Profit --}}
        <div class="group relative bg-slate-900 p-6 rounded-[2.5rem] shadow-xl shadow-slate-200 overflow-hidden transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Net Profit</p>
                    <div class="p-3 bg-white/10 text-white rounded-xl border border-white/20">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-white tabular-nums" x-text="'Rp ' + Number(summary.net_profit).toLocaleString('id-ID')">Rp 0</h3>
            </div>
        </div>
    </div>

    {{-- ================= EXTRA STATS ROW ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-100 rounded-2xl px-6 py-4 flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Total Anggota</p>
                <p class="text-lg font-black text-slate-800 tabular-nums" x-text="Number(summary.total_anggota).toLocaleString('id-ID') + ' orang'">0</p>
            </div>
        </div>
        <div class="bg-white border border-slate-100 rounded-2xl px-6 py-4 flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Total Simpanan</p>
                <p class="text-lg font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(summary.total_simpanan).toLocaleString('id-ID')">Rp 0</p>
            </div>
        </div>
        <div class="bg-white border border-slate-100 rounded-2xl px-6 py-4 flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Piutang Beredar</p>
                <p class="text-lg font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(summary.total_outstanding).toLocaleString('id-ID')">Rp 0</p>
            </div>
        </div>
    </div>

    {{-- ================= TAB SECTIONS ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 animate-slide-up">
        {{-- Tab Bar --}}
        <div class="p-6 border-b border-slate-50 flex flex-wrap items-center gap-2 bg-gradient-to-r from-white to-slate-50/30">
            <template x-for="(tab, index) in tabs" :key="index">
                <button @click="activeTab = index"
                        class="relative px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300"
                        :class="activeTab === index ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-400 hover:text-slate-600 hover:bg-slate-50'">
                    <span x-text="tab.label"></span>
                    <span x-show="tab.count > 0"
                          class="ml-1.5 inline-flex items-center justify-center w-5 h-5 text-[8px] font-black rounded-full"
                          :class="activeTab === index ? 'bg-white/20 text-white' : 'bg-rose-100 text-rose-600'"
                          x-text="tab.count"></span>
                </button>
            </template>
        </div>

        {{-- Tab Content Loading State --}}
        <div x-show="loading" class="flex items-center justify-center py-20">
            <svg class="w-8 h-8 text-blue-600 animate-spin" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2.5" d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
        </div>

        {{-- ==================== TAB 0: SIMPANAN ==================== --}}
        <div x-show="!loading && activeTab === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Transaksi Simpanan</h3>
                        <p class="text-xs font-medium text-slate-400" x-text="simpanan.total_pending + ' transaksi menunggu verifikasi'"></p>
                    </div>
                    <a href="/pengurus/transsimpanan" class="flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest">
                        Kelola Semua
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <template x-if="simpanan.pending.length === 0">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Semua transaksi sudah terverifikasi</p>
                    </div>
                </template>

                <template x-if="simpanan.pending.length > 0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50/50 text-left">
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-l-2xl">Anggota</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Jenis</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Metode</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-r-2xl">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="item in simpanan.pending" :key="item.id">
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/30 transition-all">
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800" x-text="item.anggota"></p>
                                            <p class="text-[10px] text-slate-400 font-bold" x-text="item.tanggal"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="inline-flex px-3 py-1 bg-indigo-50 text-indigo-700 text-[9px] font-black rounded-lg border border-indigo-100 uppercase" x-text="item.jenis"></span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(item.nominal).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-xs font-bold text-slate-500 capitalize" x-text="item.metode.replace(/_/g, ' ')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <a href="/pengurus/transsimpanan"
                                               class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-50 text-blue-700 text-[9px] font-black rounded-xl border border-blue-100 hover:bg-blue-100 transition-all uppercase tracking-wider">
                                                Verifikasi
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>
        </div>

        {{-- ==================== TAB 1: PINJAMAN ==================== --}}
        <div x-show="!loading && activeTab === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Pengajuan Pinjaman</h3>
                        <p class="text-xs font-medium text-slate-400" x-text="pinjaman.total_pending + ' pengajuan perlu direview'"></p>
                    </div>
                    <a href="/pengurus/kelpinjaman" class="flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest">
                        Kelola Semua
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <template x-if="pinjaman.pending.length === 0">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Tidak ada pengajuan pinjaman yang pending</p>
                    </div>
                </template>

                <template x-if="pinjaman.pending.length > 0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50/50 text-left">
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-l-2xl">No. Pinjaman</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Anggota</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Jumlah</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Tenor</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-r-2xl">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="item in pinjaman.pending" :key="item.id">
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/30 transition-all">
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800" x-text="item.no_pinjaman"></p>
                                            <p class="text-[10px] text-slate-400 font-bold" x-text="item.tanggal"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-bold text-slate-700" x-text="item.anggota"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(item.jumlah).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="text-xs font-bold text-slate-500" x-text="item.tenor"></span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <a href="/pengurus/kelpinjaman"
                                               class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-50 text-blue-700 text-[9px] font-black rounded-xl border border-blue-100 hover:bg-blue-100 transition-all uppercase tracking-wider">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>
        </div>

        {{-- ==================== TAB 2: ANGSURAN ==================== --}}
        <div x-show="!loading && activeTab === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Angsuran Hari Ini</h3>
                        <p class="text-xs font-medium text-slate-400" x-text="angsuran.total_hari_ini + ' pembayaran angsuran hari ini'"></p>
                    </div>
                    <a href="/pengurus/inpangsuran" class="flex items-center gap-2 px-4 py-2.5 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest">
                        Lihat Semua
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <template x-if="angsuran.hari_ini.length === 0">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Belum ada pembayaran angsuran hari ini</p>
                    </div>
                </template>

                <template x-if="angsuran.hari_ini.length > 0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50/50 text-left">
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-l-2xl">Anggota</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">No. Pinjaman</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Angsuran Ke-</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Metode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="item in angsuran.hari_ini" :key="item.id">
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/30 transition-all">
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800" x-text="item.anggota"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-bold text-slate-700" x-text="item.no_pinjaman"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="inline-flex px-3 py-1 bg-blue-50 text-blue-700 text-[9px] font-black rounded-lg" x-text="'Angs. ' + item.angsuran_ke"></span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(item.nominal).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-xs font-bold text-slate-500 capitalize" x-text="item.metode.replace(/_/g, ' ')"></p>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>
        </div>

        {{-- ==================== TAB 3: PAYROLL ==================== --}}
        <div x-show="!loading && activeTab === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Penggajian Bulan Ini</h3>
                        <p class="text-xs font-medium text-slate-400">
                            <span x-text="payroll.counts.pending + ' pending'"></span>
                            &middot;
                            <span x-text="payroll.counts.processed + ' diproses'"></span>
                            &middot;
                            <span x-text="payroll.counts.paid + ' dibayar'"></span>
                        </p>
                    </div>
                    <a href="/pengurus/lapharian" @click.prevent="activeTab=0" class="flex items-center gap-2 px-4 py-2.5 bg-slate-100 text-slate-500 text-[10px] font-black rounded-xl hover:bg-slate-200 transition-all uppercase tracking-widest">
                        Kembali
                    </a>
                </div>

                <template x-if="payroll.data.length === 0">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Belum ada data payroll bulan ini</p>
                    </div>
                </template>

                <template x-if="payroll.data.length > 0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50/50 text-left">
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-l-2xl">Anggota</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Gaji Pokok</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Tunjangan</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Potongan</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">Bersih</th>
                                    <th class="px-5 py-4 text-[9px] font-black uppercase tracking-[0.15em] text-slate-400 rounded-r-2xl">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="item in payroll.data" :key="item.id">
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/30 transition-all">
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800" x-text="item.anggota"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-bold text-slate-700 tabular-nums" x-text="'Rp ' + Number(item.gaji_pokok).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-bold text-emerald-600 tabular-nums" x-text="'Rp ' + Number(item.tunjangan).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-bold text-rose-600 tabular-nums" x-text="'Rp ' + Number(item.potongan).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="text-sm font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(item.gaji_bersih).toLocaleString('id-ID')"></p>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="inline-flex px-3 py-1 text-[9px] font-black rounded-lg uppercase tracking-wider"
                                                  :class="{
                                                      'bg-amber-50 text-amber-700 border border-amber-100': item.status === 'pending',
                                                      'bg-blue-50 text-blue-700 border border-blue-100': item.status === 'processed',
                                                      'bg-emerald-50 text-emerald-700 border border-emerald-100': item.status === 'paid'
                                                  }"
                                                  x-text="item.status"></span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
            </div>
        </div>

        {{-- ==================== TAB 4: SHU ==================== --}}
        <div x-show="!loading && activeTab === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">SHU Tahun Ini</h3>
                        <p class="text-xs font-medium text-slate-400">Sisa Hasil Usaha periode berjalan</p>
                    </div>
                    <span class="flex items-center gap-2 px-4 py-2.5 bg-slate-100 text-slate-500 text-[10px] font-black rounded-xl uppercase tracking-widest">
                        Monitoring
                    </span>
                </div>

                <template x-if="shu.length === 0">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Belum ada data SHU untuk tahun ini</p>
                    </div>
                </template>

                <template x-if="shu.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <template x-for="item in shu" :key="item.id">
                            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border border-slate-100 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-lg font-black text-slate-800" x-text="'SHU ' + item.tahun"></p>
                                            <p class="text-[10px] font-black uppercase tracking-widest"
                                               :class="{
                                                   'text-emerald-600': item.status === 'distributed',
                                                   'text-amber-600': item.status === 'open',
                                                   'text-slate-400': item.status === 'closed'
                                               }"
                                               x-text="item.status === 'distributed' ? 'Sudah Didistribusikan' : item.status === 'open' ? 'Masih Dibuka' : 'Ditutup'"></p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-50 text-purple-700 text-[9px] font-black rounded-xl border border-purple-100">
                                        <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                                        <span x-text="item.anggota + ' anggota'"></span>
                                    </span>
                                </div>
                                <div class="grid grid-cols-3 gap-4 pt-2 border-t border-slate-100">
                                    <div>
                                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Total</p>
                                        <p class="text-sm font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(item.total).toLocaleString('id-ID')"></p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Terdistribusi</p>
                                        <p class="text-sm font-black text-emerald-600 tabular-nums" x-text="'Rp ' + Number(item.terdistribusi).toLocaleString('id-ID')"></p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Sisa</p>
                                        <p class="text-sm font-black text-amber-600 tabular-nums" x-text="'Rp ' + Number(item.sisa).toLocaleString('id-ID')"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
function lapharianApp() {
    return {
        loading: true,
        selectedDate: '{{ $tanggal->format("Y-m-d") }}',
        activeTab: 0,
        summary: {
            pemasukan: 0,
            penyaluran: 0,
            total_transaksi: 0,
            net_profit: 0,
            total_anggota: 0,
            total_simpanan: 0,
            total_outstanding: 0,
        },
        simpanan: { pending: [], total_pending: 0 },
        pinjaman: { pending: [], total_pending: 0 },
        angsuran: { hari_ini: [], total_hari_ini: 0 },
        payroll: { data: [], counts: { pending: 0, processed: 0, paid: 0 } },
        shu: [],
        tabs: [
            { label: 'Simpanan', count: 0 },
            { label: 'Pinjaman', count: 0 },
            { label: 'Angsuran', count: 0 },
            { label: 'Payroll', count: 0 },
            { label: 'SHU', count: 0 },
        ],

        async fetchData() {
            this.loading = true;
            try {
                const res = await fetch('/pengurus/lapharian/data?date=' + this.selectedDate, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const json = await res.json();

                this.summary = json.summary;
                this.simpanan = json.simpanan;
                this.pinjaman = json.pinjaman;
                this.angsuran = json.angsuran;
                this.payroll = json.payroll;
                this.shu = json.shu;

                this.tabs = [
                    { label: 'Simpanan', count: json.simpanan.total_pending },
                    { label: 'Pinjaman', count: json.pinjaman.total_pending },
                    { label: 'Angsuran', count: 0 },
                    { label: 'Payroll', count: json.payroll.counts.pending },
                    { label: 'SHU', count: 0 },
                ];
            } catch (e) {
                console.error('Gagal memuat data:', e);
            } finally {
                this.loading = false;
            }
        },
    };
}
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection
