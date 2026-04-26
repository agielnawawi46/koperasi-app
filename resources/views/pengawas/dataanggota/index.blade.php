@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Data Anggota</h1>
        <p class="text-slate-500 font-medium">Daftar anggota aktif untuk tujuan pengawasan sistem.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
            <h3 class="font-black text-slate-800 uppercase tracking-wider text-sm">Direktori Anggota</h3>
            <div class="relative group">
                <input type="text" placeholder="Cari NIK atau Nama..." class="px-5 py-2.5 bg-white border border-slate-200 rounded-2xl text-sm focus:border-blue-500 outline-none transition-all w-64 shadow-sm">
            </div>
        </div>
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">
                <tr>
                    <th class="px-8 py-5">Identitas Anggota</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5">Tgl Bergabung</th>
                    <th class="px-8 py-5 text-right">Monitoring</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <tr class="group hover:bg-blue-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center font-black text-blue-600 uppercase">AS</div>
                            <div>
                                <p class="font-black text-slate-700 text-sm">Ahmad Subarjo</p>
                                <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase italic">#ID-00219</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-emerald-100 text-emerald-600 rounded-xl text-[10px] font-black border border-emerald-200 uppercase">Aktif</span>
                    </td>
                    <td class="px-8 py-6 text-sm font-bold text-slate-500">20 Maret 2026</td>
                    <td class="px-8 py-6 text-right">
                        <button class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-blue-600 hover:border-blue-500 transition-all">Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection