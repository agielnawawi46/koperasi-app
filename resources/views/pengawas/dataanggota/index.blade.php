@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8 animate-fade-in">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Data Anggota</h1>
        <p class="text-slate-500 font-medium">Daftar anggota aktif untuk tujuan pengawasan sistem.</p>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Direktori Anggota</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Data anggota aktif koperasi DanaKarya.</p>
                </div>
            </div>
            <div class="relative group">
                <input type="text" placeholder="Cari NIK atau Nama..." class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
            </div>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Identitas Anggota</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tgl Bergabung</th>
                    <th class="px-8 py-5 text-right text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Monitoring</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($anggota as $a)
                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                    <td class="px-8 py-7">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300 shadow-sm">
                                {{ $a['inisial'] }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-700">{{ $a['nama'] }}</p>
                                <p class="text-[10px] text-slate-400 font-bold tracking-widest">{{ $a['id_anggota'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-7">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 {{ $a['status'] === 'Aktif' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-red-50 text-red-700 border-red-100' }} text-[10px] font-black rounded-xl border uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 {{ $a['status'] === 'Aktif' ? 'bg-emerald-500' : 'bg-red-500' }} rounded-full"></span>
                            {{ $a['status'] }}
                        </span>
                    </td>
                    <td class="px-8 py-7 text-sm font-bold text-slate-500">{{ $a['tanggal_bergabung'] }}</td>
                    <td class="px-8 py-7 text-right">
                        <button class="px-6 py-3 bg-white border border-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-slate-50 transition-all shadow-sm">Detail</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Tidak ada data anggota.</td>
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