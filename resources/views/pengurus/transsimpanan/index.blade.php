@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Log Simpanan Otomatis</h1>
            </div>
            <p class="text-slate-500 font-medium ml-1">Data simpanan masuk secara sistematis (Pokok, Wajib, Sukarela).</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl shadow-sm hover:border-green-500 hover:text-green-600 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-50 group-hover:bg-green-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                Export Excel
            </button>
            
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-xl shadow-slate-200 hover:bg-slate-900 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-700 group-hover:bg-red-500 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                </div>
                Cetak PDF
            </button>
        </div>
    </div>

    {{-- ================= RINGKASAN CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @php
            $stats = [
                ['label' => 'Total Pokok', 'val' => number_format($totalPokok), 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'blue'],
                ['label' => 'Total Wajib', 'val' => number_format($totalWajib), 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'indigo'],
                ['label' => 'Total Sukarela', 'val' => number_format($totalSukarela), 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'purple'],
                ['label' => 'Periode Aktif', 'val' => strtoupper(now()->translatedFormat('F Y')), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'emerald'],
            ];
        @endphp
        
        @foreach($stats as $stat)
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $stat['color'] }}-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-{{ $stat['color'] }}-700 transition-colors uppercase">{{ $stat['label'] }}</p>
                    <div class="p-4 bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">
                        @if($stat['label'] != 'Periode Aktif') <span class="text-sm font-bold text-slate-400 uppercase mr-1">Rp</span> @endif
                        {{ $stat['val'] }}
                    </h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-{{ $stat['color'] }}-100/50 text-{{ $stat['color'] }}-700 border border-{{ $stat['color'] }}-200 uppercase tracking-widest">
                        @if($stat['label'] == 'Periode Aktif') Terjadwal Otomatis @else Terakumulasi @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ================= LOG TABLE ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up mt-8">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/50">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Auto-Generation</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Diproses otomatis sistem setiap tanggal 25.</p>
                </div>
            </div>

            {{-- Custom Tab Filter --}}
            <div class="flex bg-slate-100/80 p-1.5 rounded-[1.2rem] backdrop-blur-sm border border-slate-200/50">
                <button class="px-6 py-2.5 bg-white shadow-sm rounded-xl text-[10px] font-black uppercase text-blue-600 transition-all tracking-widest">Semua</button>
                <button class="px-6 py-2.5 text-[10px] font-black uppercase text-slate-400 hover:text-slate-600 transition-colors tracking-widest ml-1">Wajib</button>
                <button class="px-6 py-2.5 text-[10px] font-black uppercase text-slate-400 hover:text-slate-600 transition-colors tracking-widest ml-1">Sukarela</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Transaction ID</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Anggota</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Rincian Simpanan</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total Nominal</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status Audit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transaksi as $t)
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-7">
                            <div class="flex flex-col">
                                <span class="text-xs font-mono font-black text-blue-600 tracking-tighter">#{{ $t->reference ?? 'TRX-'.$t->id }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $t->created_at->format('d M, H:i') }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-7">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:scale-110 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300">{{ strtoupper(substr($t->user->name ?? '?', 0, 2)) }}</div>
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800 tracking-tight">{{ $t->user->name ?? 'Unknown' }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ $t->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-7">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1.5 bg-blue-50 text-blue-700 text-[9px] font-black rounded-xl border border-blue-100/50 uppercase tracking-wide group-hover:bg-blue-100 transition-colors">{{ ucfirst($t->type) }}: Rp {{ number_format($t->amount) }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-7">
                            <div class="flex flex-col">
                                <p class="text-base font-black tabular-nums text-green-600 group-hover:scale-105 transition-transform origin-left">+ Rp {{ number_format($t->amount) }}</p>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $t->description ?? 'Auto-Debet' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-7 text-center">
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 text-[10px] font-black rounded-2xl border border-green-200 shadow-sm uppercase">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Verified
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada transaksi simpanan.</td>
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