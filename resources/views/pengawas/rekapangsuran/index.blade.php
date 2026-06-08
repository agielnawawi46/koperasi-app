@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8 animate-fade-in" x-data="{ filter: 'semua' }">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Rekapitulasi Angsuran</h1>
            <p class="text-slate-500 font-medium">Pemantauan kolektibilitas dan ketepatan waktu cicilan anggota.</p>
        </div>
    </div>

    {{-- Kartu Ringkasan (Stats) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div @click="filter = 'lancar'" class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500 cursor-pointer" :class="filter === 'lancar' ? 'ring-2 ring-emerald-500' : ''">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-emerald-700 transition-colors">Cicilan Lancar</p>
                <h2 class="text-3xl font-black text-emerald-600 tabular-nums">{{ $lancarCount }} <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Anggota</span></h2>
            </div>
        </div>

        <div @click="filter = 'menunggak'" class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500 cursor-pointer" :class="filter === 'menunggak' ? 'ring-2 ring-red-500' : ''">
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-red-100"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-red-700 transition-colors">Tunggakan / Macet</p>
                <h2 class="text-3xl font-black text-red-600 tabular-nums">{{ $menunggakCount }} <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Anggota</span></h2>
            </div>
        </div>

        <div @click="filter = 'semua'" class="group relative bg-slate-900 p-8 rounded-[2.5rem] shadow-sm border border-slate-800 overflow-hidden hover:shadow-xl transition-all duration-500 cursor-pointer" :class="filter === 'semua' ? 'ring-2 ring-blue-500' : ''">
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-300 transition-colors">Total Angsuran Aktif</p>
                <h2 class="text-3xl font-black text-white tabular-nums">{{ $totalAktif }}</h2>
            </div>
        </div>
    </div>

    {{-- Daftar Anggota Berdasarkan Filter --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Daftar Anggota: <span class="text-blue-600" x-text="filter.toUpperCase()"></span></h2>
                    <p class="text-sm text-slate-400 font-medium italic">Menampilkan data berdasarkan kategori.</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nama Anggota</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Angsuran Ke</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Sisa Outstanding</th>
                    <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($daftarAngsuran as $angsuran)
                <tr x-show="filter === 'semua' || filter === '{{ $angsuran['status_label'] }}'" class="group transition-all duration-300" :class="filter === 'lancar' ? 'hover:bg-emerald-50/30' : (filter === 'menunggak' ? 'hover:bg-red-50/30' : 'hover:bg-blue-50/30')">
                    <td class="px-8 py-7">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300 shadow-sm">
                                {{ strtoupper(substr($angsuran['nama_anggota'], 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-700">{{ $angsuran['nama_anggota'] }}</p>
                                <p class="text-[10px] text-slate-400 font-bold">{{ $angsuran['no_pinjaman'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-7 text-sm font-bold text-slate-500">{{ $angsuran['angsuran_ke'] }}</td>
                    <td class="px-8 py-7 text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($angsuran['sisa_outstanding']) }}</td>
                    <td class="px-8 py-7 text-center">
                        @if($angsuran['status_label'] === 'lancar')
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            Lancar
                        </span>
                        @elseif($angsuran['status_label'] === 'menunggak')
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-red-50 text-red-700 text-[10px] font-black rounded-xl border border-red-100 uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                            Terlambat
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                            {{ $angsuran['status_label'] }}
                        </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada data angsuran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
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