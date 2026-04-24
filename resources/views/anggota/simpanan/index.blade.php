@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ openModal: false }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Simpanan Saya</h1>
            <p class="text-slate-500 mt-1 font-medium">Pantau aset Anda di <span class="text-blue-600">{{ $namaKoperasi ?? 'Koperasi Maju Jaya' }}</span></p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Total Akumulasi (Hero Card) --}}
        <div class="md:col-span-2 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-48 h-48 bg-blue-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Akumulasi Saldo</p>
                        {{-- Ikon Baru --}}
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-2xl transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-5xl font-black text-slate-800 tracking-tighter">Rp 12.450.000</h2>
                </div>
                <div class="mt-8 flex items-center gap-4">
                    <button @click="openModal = true" class="bg-blue-600 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 hover:scale-105 active:scale-95">
                        Tambah Simpanan Sukarela
                    </button>
                    <div class="flex items-center gap-2 text-emerald-600 text-[10px] font-black bg-emerald-50 px-3 py-1 rounded-full uppercase w-fit">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        Aset Bertumbuh
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Status Keanggotaan --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-transform duration-500 group-hover:scale-110"></div>
            <div class="relative z-10 space-y-6">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Status Anggota</p>
                <div class="flex items-center gap-4">
                    <div class="p-4 bg-slate-900 rounded-[1.5rem] shadow-lg transition-transform duration-500 group-hover:-rotate-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-black text-slate-800 uppercase tracking-tight">Anggota Aktif</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">ID: KOP-2026-042</p>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-50">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Terdaftar Sejak</p>
                    <p class="text-sm font-black text-slate-700">Januari 2024</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= Breakdown Simpanan Section ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Simpanan Pokok --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-lg transition-all duration-500">
             <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Simpanan Pokok</p>
                    <div class="p-3 bg-slate-100 text-slate-600 rounded-2xl transition-all duration-300 group-hover:bg-slate-900 group-hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tighter">Rp 1.000.000</h2>
                <div class="flex items-center gap-2 text-slate-500 text-[10px] font-black bg-slate-50 px-3 py-1 rounded-full uppercase w-fit">
                    Terbayar Penuh
                </div>
            </div>
        </div>

        {{-- Simpanan Wajib --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-lg transition-all duration-500">
             <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Simpanan Wajib</p>
                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl transition-transform duration-500 group-hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tighter">Rp 6.450.000</h2>
                <div class="flex items-center gap-2 text-emerald-600 text-[10px] font-black bg-emerald-50 px-3 py-1 rounded-full uppercase w-fit">
                    Lancar (Mei 2026)
                </div>
            </div>
        </div>

        {{-- Simpanan Sukarela --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-lg transition-all duration-500">
             <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Simpanan Sukarela</p>
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-2xl transition-transform duration-500 group-hover:rotate-12">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-blue-600 tracking-tighter">Rp 5.000.000</h2>
                <div class="flex items-center gap-2 text-blue-600 text-[10px] font-black bg-blue-50 px-3 py-1 rounded-full uppercase w-fit">
                    Bunga 0.5% / bln
                </div>
            </div>
        </div>
    </div>

    {{-- ================= Popup Modal (Alpine.js) ================= --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden"
             @click.away="openModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="scale-95 opacity-0"
             x-transition:enter-end="scale-100 opacity-100">
            
            {{-- Dekorasi Modal --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-0 transition-transform duration-700 group-hover:scale-110"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Tambah Simpanan</h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="#" class="space-y-6">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Metode Pembayaran</label>
                        <select class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500">
                            <option>Transfer Bank (Manual)</option>
                            <option>Potong Gaji (Bulan Depan)</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Nominal Simpanan (Rp)</label>
                        <input type="number" placeholder="Contoh: 500000" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 placeholder:text-slate-300">
                    </div>

                    <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                        <p class="text-[10px] text-blue-600 font-bold leading-relaxed italic uppercase tracking-tighter">
                            *Setoran sukarela akan diproses oleh admin dalam waktu maksimal 1x24 jam kerja setelah konfirmasi.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 hover:-translate-y-1">
                        Ajukan Setoran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection