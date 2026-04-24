@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ openModal: false }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pinjaman Saya</h1>
            <p class="text-slate-500 mt-1 font-medium">Informasi sisa angsuran dan riwayat pinjaman Anda</p>
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {{-- Sisa Pinjaman (Hero Card - md:col-span-2) --}}
    <div class="md:col-span-2 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
        {{-- Ornamen Latar --}}
        <div class="absolute top-0 right-0 w-48 h-48 bg-rose-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-rose-100"></div>
        
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="space-y-6">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Sisa Hutang Pokok</p>
                    <div class="p-3 bg-rose-100 text-rose-600 rounded-2xl transition-transform duration-500 group-hover:rotate-12">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-5xl font-black text-slate-800 tracking-tight">Rp 4.200.000</h2>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="items-center gap-2 text-rose-600 text-xs font-bold bg-rose-50 p-2 rounded-xl inline-flex">
                            <span class="w-2 h-2 bg-rose-500 rounded-full animate-ping"></span>
                            Sisa 8 Angsuran
                        </div>
                        <span class="text-[10px] font-black text-rose-500 uppercase">65% Terbayar</span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-rose-500 h-full rounded-full transition-all duration-1000" style="width: 65%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button @click="openModal = true" class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-100 hover:-translate-y-1 active:scale-95">
                    Ajukan Pinjaman Baru
                </button>
            </div>
        </div>
    </div>

    {{-- Info Angsuran Berikutnya --}}
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
        {{-- Ornamen Latar --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
        
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Angsuran Bulan Ini</p>
                <div class="p-3 bg-amber-100 text-amber-600 rounded-2xl transition-transform duration-500 group-hover:-rotate-12">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Rp 525.000</h2>
                <div class="mt-2 items-center gap-2 text-rose-600 text-xs font-bold bg-rose-50 p-2 rounded-xl inline-flex uppercase">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    25 Mei 2026
                </div>
            </div>

            <div class="pt-4 border-t border-slate-50 space-y-3">
                <div class="flex justify-between items-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <span>Pokok</span>
                    <span class="text-slate-700">Rp 500.000</span>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <span>Jasa (0.5%)</span>
                    <span class="text-emerald-600">Rp 25.000</span>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- ================= Riwayat Pinjaman ================= --}}
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden group">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-slate-800 text-lg uppercase tracking-tight">Riwayat Pinjaman</h2>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Daftar pinjaman yang pernah diajukan</p>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <th class="pb-4 pl-2">No. Berkas</th>
                        <th class="pb-4">Tanggal Pinjam</th>
                        <th class="pb-4">Total Pinjaman</th>
                        <th class="pb-4">Tenor</th>
                        <th class="pb-4 text-center">Status</th>
                        <th class="pb-4 text-right pr-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="group/row hover:bg-slate-50/80 transition-all duration-300">
                        <td class="py-5 pl-2 text-sm font-black text-slate-800 tracking-tighter">#PJM-8821</td>
                        <td class="py-5 text-sm text-slate-500 font-bold">15 Jan 2026</td>
                        <td class="py-5 text-sm font-black text-slate-800">Rp 6.000.000</td>
                        <td class="py-5 text-sm text-slate-500 font-bold">12 Bulan</td>
                        <td class="py-5 text-center">
                            <span class="text-[9px] font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase border border-amber-100">Berjalan</span>
                        </td>
                        <td class="py-5 text-right pr-2">
                            <button class="text-blue-600 font-black text-[10px] uppercase hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl transition-all duration-300">Detail</button>
                        </td>
                    </tr>
                    <tr class="group/row hover:bg-slate-50/80 transition-all duration-300">
                        <td class="py-5 pl-2 text-sm font-black text-slate-800 tracking-tighter">#PJM-7204</td>
                        <td class="py-5 text-sm text-slate-500 font-bold">10 Feb 2025</td>
                        <td class="py-5 text-sm font-black text-slate-800">Rp 3.000.000</td>
                        <td class="py-5 text-sm text-slate-500 font-bold">10 Bulan</td>
                        <td class="py-5 text-center">
                            <span class="text-[9px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase border border-emerald-100">Lunas</span>
                        </td>
                        <td class="py-5 text-right pr-2">
                            <button class="text-blue-600 font-black text-[10px] uppercase hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl transition-all duration-300">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= Popup Ajukan Pinjaman (Modal) ================= --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl p-10 border border-slate-100 relative overflow-hidden"
             @click.away="openModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-10"
             x-transition:enter-end="scale-100 translate-y-0">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-0"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Form Pengajuan</h3>
                        <p class="text-[10px] text-blue-600 font-black uppercase tracking-widest mt-1">Pinjaman Dana Karya Baru</p>
                    </div>
                    <button @click="openModal = false" class="text-slate-300 hover:text-rose-500 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="#" class="space-y-6">
                    <div class="grid grid-cols-2 gap-5">
                        <div class="col-span-2 group">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block group-focus-within:text-blue-600 transition-colors">Besar Pinjaman (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-black text-slate-400">Rp</span>
                                <input type="number" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-4 text-sm font-black text-slate-800 focus:ring-2 focus:ring-blue-500 placeholder:text-slate-300 transition-all" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Tenor (Bulan)</label>
                            <select class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-black text-slate-700 focus:ring-2 focus:ring-blue-500">
                                <option>6 Bulan</option>
                                <option>12 Bulan</option>
                                <option>24 Bulan</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Keperluan</label>
                            <select class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-black text-slate-700 focus:ring-2 focus:ring-blue-500">
                                <option>Pendidikan</option>
                                <option>Kesehatan</option>
                                <option>Renovasi</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="bg-blue-50/50 p-6 rounded-3xl border border-blue-100 flex items-center gap-4">
                        <div class="p-3 bg-white rounded-2xl text-blue-600 shadow-sm">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-baseline gap-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Estimasi:</span>
                                <span class="text-sm font-black text-slate-800 uppercase tracking-tighter">Rp 450.000 / bln</span>
                            </div>
                            <p class="text-[9px] text-blue-500 font-bold uppercase italic leading-tight">*Sudah termasuk jasa koperasi 0.5% flat.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 hover:-translate-y-1">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection