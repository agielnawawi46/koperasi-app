@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Audit Pinjaman</h1>
            <p class="text-slate-500 font-medium">Monitoring penyaluran dana dan status persetujuan pinjaman.</p>
        </div>
        <div class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
            Outstanding: Rp {{ number_format($outstanding) }}
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($stats as $stat)
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">{{ $stat['name'] }}</p>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums mt-2">{{ $stat['count'] }} <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Transaksi</span></h2>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Tabel Monitoring Pinjaman --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Daftar Audit Penyaluran Dana</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Monitoring seluruh pengajuan pinjaman anggota.</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Peminjam</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tujuan Pinjaman</th>
                    <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal Plafon</th>
                    <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status Audit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($auditPinjaman as $item)
                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                    <td class="px-8 py-7">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300 shadow-sm">
                                {{ strtoupper(substr($item['peminjam'], 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-700">{{ $item['peminjam'] }}</p>
                                <p class="text-[10px] text-slate-400 font-bold">{{ $item['no_berkas'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-7 text-sm text-slate-500 italic">{{ $item['tujuan'] }}</td>
                    <td class="px-8 py-7 text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($item['nominal']) }}</td>
                    <td class="px-8 py-7 text-center">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                            {{ $item['status_audit'] }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada data audit pinjaman.</td>
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