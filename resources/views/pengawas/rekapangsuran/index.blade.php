@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in" x-data="{ filter: 'semua' }">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Rekapitulasi Angsuran</h1>
            <p class="text-slate-500 font-medium">Pemantauan kolektibilitas dan ketepatan waktu cicilan anggota.</p>
        </div>
    </div>

    {{-- Kartu Ringkasan (Stats) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div @click="filter = 'lancar'" class="cursor-pointer bg-white p-6 rounded-[2.5rem] border-2 transition-all" :class="filter === 'lancar' ? 'border-emerald-500 shadow-lg shadow-emerald-50' : 'border-transparent shadow-sm'">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Cicilan Lancar</p>
            <h3 class="text-3xl font-black text-emerald-600">128 <span class="text-sm text-slate-400 font-medium">Anggota</span></h3>
        </div>

        <div @click="filter = 'menunggak'" class="cursor-pointer bg-white p-6 rounded-[2.5rem] border-2 transition-all" :class="filter === 'menunggak' ? 'border-red-500 shadow-lg shadow-red-50' : 'border-transparent shadow-sm'">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tunggakan / Macet</p>
            <h3 class="text-3xl font-black text-red-600">5 <span class="text-sm text-slate-400 font-medium">Anggota</span></h3>
        </div>

        <div @click="filter = 'semua'" class="cursor-pointer bg-slate-900 p-6 rounded-[2.5rem] border-2 transition-all" :class="filter === 'semua' ? 'border-blue-500 shadow-xl' : 'border-transparent'">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Angsuran Aktif</p>
            <h3 class="text-3xl font-black text-white">133</h3>
        </div>
    </div>

    {{-- Daftar Anggota Berdasarkan Filter --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
            <h3 class="font-black text-slate-800 uppercase tracking-wider text-sm">
                Daftar Anggota: <span class="text-blue-600" x-text="filter.toUpperCase()"></span>
            </h3>
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                Menampilkan data berdasarkan kategori
            </div>
        </div>

        <table class="w-full text-left">
            <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">
                <tr>
                    <th class="px-8 py-5">Nama Anggota</th>
                    <th class="px-8 py-5">Angsuran Ke</th>
                    <th class="px-8 py-5">Sisa Outstanding</th>
                    <th class="px-8 py-5 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                {{-- Contoh Baris Lancar --}}
                <tr x-show="filter === 'semua' || filter === 'lancar'" class="group hover:bg-emerald-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-700 text-sm">Ahmad Subarjo</p>
                        <p class="text-[10px] text-slate-400 font-bold">#PJN-001</p>
                    </td>
                    <td class="px-8 py-6 text-sm font-bold text-slate-500">5 <span class="text-slate-300">/ 12</span></td>
                    <td class="px-8 py-6 font-black text-slate-800 text-sm">Rp 7.500.000</td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-emerald-100 text-emerald-600 rounded-xl text-[9px] font-black uppercase border border-emerald-200">Lancar</span>
                    </td>
                </tr>

                {{-- Contoh Baris Menunggak --}}
                <tr x-show="filter === 'semua' || filter === 'menunggak'" class="group hover:bg-red-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-700 text-sm">Budi Santoso</p>
                        <p class="text-[10px] text-slate-400 font-bold">#PJN-042</p>
                    </td>
                    <td class="px-8 py-6 text-sm font-bold text-slate-500">3 <span class="text-slate-300">/ 10</span></td>
                    <td class="px-8 py-6 font-black text-slate-800 text-sm">Rp 12.000.000</td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-red-100 text-red-600 rounded-xl text-[9px] font-black uppercase border border-red-200">Terlambat 5 Hari</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection