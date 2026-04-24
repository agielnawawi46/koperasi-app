@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= HEADER & EXPORT ACTIONS ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Laporan Keuangan</h1>
            <p class="text-slate-500 font-medium">Rekapitulasi arus kas dan kesehatan finansial **DanaKarya**.</p>
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

    {{-- ================= SUMMARY CARDS (Dashboard Style) ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        
        {{-- Total Pemasukan --}}
        <div class="group relative bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-green-700">Total Pemasukan</p>
                    <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 tabular-nums">Rp 42.5M</h3>
            </div>
        </div>

        {{-- Total Penyaluran --}}
        <div class="group relative bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700">Penyaluran</p>
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 tabular-nums">Rp 120M</h3>
            </div>
        </div>

        {{-- Volume Transaksi --}}
        <div class="group relative bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700">Total Data</p>
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 tabular-nums">1,254 <span class="text-[10px] text-slate-400 uppercase">Trx</span></h3>
            </div>
        </div>

        {{-- Laba Bersih --}}
        <div class="group relative bg-slate-900 p-6 rounded-[2.5rem] shadow-xl shadow-slate-200 overflow-hidden transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-bl-[60px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none duration-700"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Net Profit</p>
                    <div class="p-3 bg-white/10 text-white rounded-xl border border-white/20">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>
                <h3 class="text-xl font-black text-white tabular-nums">Rp 5.2M</h3>
            </div>
        </div>
    </div>

    {{-- ================= TABEL LAPORAN (Dashboard Style) ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        
        {{-- Custom Filter & Tabs --}}
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex bg-slate-100 p-1 rounded-[1.3rem] w-fit">
                <button onclick="switchTab('harian')" id="btn-harian" class="report-tab px-6 py-2.5 bg-white shadow-sm rounded-[1rem] text-[10px] font-black uppercase text-slate-800 transition-all tracking-widest">Harian</button>
                <button onclick="switchTab('bulanan')" id="btn-bulanan" class="report-tab px-6 py-2.5 text-[10px] font-black uppercase text-slate-400 hover:text-slate-600 transition-all tracking-widest">Bulanan</button>
                <button onclick="switchTab('tahunan')" id="btn-tahunan" class="report-tab px-6 py-2.5 text-[10px] font-black uppercase text-slate-400 hover:text-slate-600 transition-all tracking-widest">Tahunan</button>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Periode:</span>
                    <input type="date" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-600 outline-none focus:ring-2 focus:ring-slate-900 transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50 text-left">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 border-b border-slate-100">Tanggal & ID</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 border-b border-slate-100">Keterangan Transaksi</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 border-b border-slate-100">Kategori</th>
                        <th class="px-8 py-5 text-right text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 border-b border-slate-100">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    {{-- Row 1: Pemasukan --}}
                    <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800">23 Apr 2026</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">TRX-2026-001</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-700 tracking-tight italic">Setoran Pokok Anggota - Budi Santoso</p>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[9px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                Pemasukan
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <p class="text-sm font-black text-emerald-600 tabular-nums">+ Rp 1.250.000</p>
                        </td>
                    </tr>

                    {{-- Row 2: Penyaluran --}}
                    <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800">22 Apr 2026</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">TRX-2026-002</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-slate-700 tracking-tight italic">Pencairan Dana Pinjaman Pendidikan</p>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex items-center px-4 py-1.5 bg-blue-50 text-blue-700 text-[9px] font-black rounded-xl border border-blue-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                Penyaluran
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <p class="text-sm font-black text-red-600 tabular-nums">- Rp 15.000.000</p>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-slate-900">
                        <td colspan="3" class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Total Net Balance Periode Ini</td>
                        <td class="px-8 py-5 text-right">
                            <span class="text-sm font-black text-white tabular-nums">Rp 5.200.000</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    function switchTab(type) {
        const tabs = document.querySelectorAll('.report-tab');
        tabs.forEach(tab => {
            tab.classList.remove('bg-white', 'shadow-sm', 'text-slate-800');
            tab.classList.add('text-slate-400');
        });

        const activeTab = document.getElementById('btn-' + type);
        activeTab.classList.add('bg-white', 'shadow-sm', 'text-slate-800');
        activeTab.classList.remove('text-slate-400');
        
        console.log("Switching report data to:", type);
    }
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection