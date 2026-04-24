@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
{{-- Tambahkan x-data untuk kontrol popup --}}
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ openModal: false }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Sisa Hasil Usaha (SHU)</h1>
            <p class="text-slate-500 mt-1 font-medium">Transparansi pembagian keuntungan tahunan anggota</p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
            <div class="p-2 bg-indigo-50 rounded-lg">
                <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <span class="text-sm font-bold text-slate-600">Periode Buku 2025</span>
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {{-- Total SHU Diterima (Hero Card) --}}
    <div class="md:col-span-2 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
        {{-- Ornamen Latar --}}
        <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-indigo-100"></div>
        
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="space-y-6">
                <div class="flex items-center justify-between gap-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total SHU Tahun Ini</p>
                    <div class="p-3 bg-indigo-100 text-indigo-600 rounded-2xl transition-transform duration-500 group-hover:rotate-12">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-5xl font-black text-black tabular-nums tracking-tight">Rp 2.450.750</h2>
                    <p class="text-xs text-slate-500 font-medium max-w-sm mt-2 leading-relaxed">Dana akumulasi Jasa Modal dan Jasa Anggota yang telah disahkan melalui RAT.</p>
                </div>

                <div class="flex items-center gap-4">
                    <button @click="openModal = true" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 hover:-translate-y-1 active:scale-95">
                        Ambil / Tarik SHU
                    </button>
                    <div class="flex items-center gap-2 text-indigo-600 text-[10px] font-black bg-indigo-50 px-3 py-1 rounded-full uppercase w-fit">
                        <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span>
                        Status: Siap Diambil
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Breakdown Singkat (Komponen SHU) --}}
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
        {{-- Ornamen Latar --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
        
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Komponen SHU</p>
                <div class="p-3 bg-slate-100 text-slate-600 rounded-2xl transition-transform duration-500 group-hover:-rotate-12">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 003.055 11H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.495 20.954A8.995 8.995 0 0113 5v10l7 7a9.003 9.003 0 01-9.505-1.046z" />
                    </svg>
                </div>
            </div>
            
            <div class="space-y-5">
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider">
                        <span class="text-slate-400">Jasa Modal</span>
                        <span class="text-slate-800 bg-slate-50 px-2 py-0.5 rounded-lg">Rp 1.800.000</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-indigo-500 h-full rounded-full transition-all duration-1000 group-hover:bg-indigo-600" style="width: 70%"></div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider">
                        <span class="text-slate-400">Jasa Anggota</span>
                        <span class="text-slate-800 bg-slate-50 px-2 py-0.5 rounded-lg">Rp 650.750</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-sky-400 h-full rounded-full transition-all duration-1000 group-hover:bg-sky-500" style="width: 30%"></div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-50">
                <div class="flex items-center justify-center gap-2 text-slate-400 text-[9px] font-bold bg-slate-50 py-2 rounded-xl uppercase tracking-tighter transition-colors group-hover:bg-slate-100">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Disahkan: Mar 2026
                </div>
            </div>
        </div>
    </div>
</div>

        {{-- ================= Riwayat SHU Pertahun ================= --}}
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="font-bold text-slate-800 text-lg">Riwayat SHU Per Tahun</h2>
                <p class="text-xs text-slate-400 font-medium">Perbandingan perolehan SHU Anda 3 tahun terakhir</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <th class="pb-4">Tahun Buku</th>
                        <th class="pb-4">Jasa Modal</th>
                        <th class="pb-4">Jasa Anggota</th>
                        <th class="pb-4">Total Diterima</th>
                        <th class="pb-4 text-center">Metode Penyaluran</th>
                        <th class="pb-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="group hover:bg-slate-50/50 transition-all">
                        <td class="py-5 text-sm font-black text-slate-800">2025</td>
                        <td class="py-5 text-sm text-slate-600 font-medium">Rp 1.800.000</td>
                        <td class="py-5 text-sm text-slate-600 font-medium">Rp 650.750</td>
                        <td class="py-5 text-sm font-black text-indigo-600">Rp 2.450.750</td>
                        <td class="py-5 text-[10px] text-center font-bold text-slate-500 uppercase">Menunggu Instruksi</td>
                        <td class="py-5 text-center">
                            <span class="flex items-center justify-center gap-1 text-[9px] font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase w-fit mx-auto">
                                Belum Diambil
                            </span>
                        </td>
                    </tr>
                    <tr class="group hover:bg-slate-50/50 transition-all">
                        <td class="py-5 text-sm font-black text-slate-800">2024</td>
                        <td class="py-5 text-sm text-slate-600 font-medium">Rp 1.500.000</td>
                        <td class="py-5 text-sm text-slate-600 font-medium">Rp 420.000</td>
                        <td class="py-5 text-sm font-black text-slate-800">Rp 1.920.000</td>
                        <td class="py-5 text-[10px] text-center font-bold text-slate-500 uppercase">Simp. Sukarela</td>
                        <td class="py-5 text-center">
                            <span class="flex items-center justify-center gap-1 text-[9px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase w-fit mx-auto">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                Sudah Diterima
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= Popup Modal Ambil SHU ================= --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10 border border-slate-100 relative overflow-hidden"
             @click.away="openModal = false">
            
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Opsi Penarikan</h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="mb-8 p-6 bg-indigo-50 rounded-3xl border border-indigo-100 text-center">
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Dana SHU Tersedia</p>
                    <p class="text-3xl font-black text-indigo-600 tabular-nums">Rp 2.450.750</p>
                </div>

                <form action="#" class="space-y-6">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Pilih Metode Penyaluran</label>
                        <select class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500">
                            <option>Pindahkan ke Simpanan Sukarela</option>
                            <option>Cairkan via Transfer Bank</option>
                            <option>Ambil Tunai di Kantor</option>
                        </select>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl">
                        <p class="text-[10px] text-slate-500 font-medium leading-relaxed italic">
                            *Jika memilih Simpanan Sukarela, dana akan langsung menambah saldo aset Anda dan mulai menghasilkan bunga efektif di bulan berikutnya.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                        Konfirmasi Penarikan
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