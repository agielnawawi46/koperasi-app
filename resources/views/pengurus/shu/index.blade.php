@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 space-y-8 animate-fade-in">

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-4 text-emerald-700 text-sm font-bold shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border border-red-200 rounded-2xl px-6 py-4 text-red-600 text-sm font-bold shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl px-6 py-4 text-red-600 text-sm font-bold shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Sisa Hasil Usaha (SHU)</h1>
                <p class="text-slate-500 font-medium italic">Kalkulasi dan distribusi SHU tahunan koperasi</p>
            </div>
        </div>
    </div>

    {{-- OVERVIEW CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Simpanan</p>
            <p class="text-2xl font-black text-slate-800 tabular-nums mt-2">Rp {{ number_format($allSavings) }}</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Bunga Dibayar (Tahun Ini)</p>
            <p class="text-2xl font-black text-slate-800 tabular-nums mt-2">Rp {{ number_format($allInterestPaid) }}</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Alokasi Jasa Simpanan</p>
            <p class="text-2xl font-black text-indigo-600 tabular-nums mt-2">{{ $organization?->shu_savings_allocation ?? 40 }}%</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Alokasi Jasa Pinjaman</p>
            <p class="text-2xl font-black text-amber-600 tabular-nums mt-2">{{ $organization?->shu_loan_allocation ?? 30 }}%</p>
        </div>
    </div>

    {{-- CALCULATE SHU FORM --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 bg-gradient-to-r from-white to-indigo-50/30">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800">Kalkulasi SHU Baru</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Input Pendapatan & Biaya Periode</p>
                </div>
            </div>
        </div>

        <form action="{{ route('pengurus.shu.calculate') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Tahun Buku</label>
                    <select name="year" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all appearance-none cursor-pointer">
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }} {{ in_array($y, $existingYears) ? 'disabled' : '' }}>
                                {{ $y }} {{ in_array($y, $existingYears) ? '(Sudah Ada)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @if(in_array(now()->year, $existingYears))
                        <p class="text-[9px] text-amber-600 font-bold italic mt-1">Tahun ini sudah memiliki SHU.</p>
                    @endif
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Total Pendapatan (Rp)</label>
                    <input type="number" name="total_income" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="0" min="0">
                    <p class="text-[9px] text-slate-400 font-medium italic mt-1">Bunga pinjaman + pendapatan operasional lainnya</p>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Total Biaya (Rp)</label>
                    <input type="number" name="total_expenses" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="0" min="0">
                    <p class="text-[9px] text-slate-400 font-medium italic mt-1">Biaya operasional & beban organisasi</p>
                </div>
            </div>

            {{-- Allocation Preview --}}
            <div class="bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100 space-y-3">
                <p class="text-[10px] font-black uppercase tracking-widest text-indigo-500">Alokasi Berjalan</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-2xl border border-indigo-100">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Jasa Simpanan</p>
                        <p class="text-lg font-black text-indigo-600">{{ $organization?->shu_savings_allocation ?? 40 }}%</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-indigo-100">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Jasa Pinjaman</p>
                        <p class="text-lg font-black text-amber-600">{{ $organization?->shu_loan_allocation ?? 30 }}%</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-indigo-100">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Dana Cadangan</p>
                        <p class="text-lg font-black text-emerald-600">{{ $organization?->shu_reserve_allocation ?? 20 }}%</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-indigo-100">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Dana Sosial</p>
                        <p class="text-lg font-black text-rose-600">{{ $organization?->shu_social_allocation ?? 10 }}%</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-indigo-700 transition-all active:scale-95">
                    Hitung & Simpan SHU
                </button>
            </div>
        </form>
    </div>

    {{-- SHU RECORDS TABLE --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800">Riwayat SHU</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $shuRecords->count() }} periode tercatat</p>
                </div>
            </div>
        </div>

        @if($shuRecords->isEmpty())
            <div class="p-16 text-center">
                <p class="font-bold text-slate-400 italic">Belum ada data SHU. Hitung SHU untuk memulai.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tahun</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Pendapatan</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Biaya</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total SHU</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Didistribusi</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Sisa</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Anggota</th>
                            <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($shuRecords as $s)
                            @php
                                $statusColors = [
                                    'open' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'distributed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'closed' => 'bg-slate-50 text-slate-600 border-slate-200',
                                ];
                                $statusLabels = [
                                    'open' => 'Open',
                                    'distributed' => 'Terdistribusi',
                                    'closed' => 'Ditutup',
                                ];
                            @endphp
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6 text-sm font-black text-slate-800">{{ $s->year }}</td>
                                <td class="px-8 py-6 text-sm font-bold text-slate-600 tabular-nums">Rp {{ number_format($s->total_income) }}</td>
                                <td class="px-8 py-6 text-sm font-bold text-rose-600 tabular-nums">Rp {{ number_format($s->total_expenses) }}</td>
                                <td class="px-8 py-6 text-sm font-black text-indigo-600 tabular-nums">Rp {{ number_format($s->total_amount) }}</td>
                                <td class="px-8 py-6 text-sm font-bold text-emerald-600 tabular-nums">Rp {{ number_format($s->distributed_amount) }}</td>
                                <td class="px-8 py-6 text-sm font-bold text-slate-500 tabular-nums">Rp {{ number_format($s->remaining_amount) }}</td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center gap-1.5 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 border {{ $statusColors[$s->status] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $s->status === 'open' ? 'bg-amber-500 animate-ping' : ($s->status === 'distributed' ? 'bg-emerald-500' : 'bg-slate-400') }}"></span>
                                        {{ $statusLabels[$s->status] ?? ucfirst($s->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center text-sm font-black text-slate-700">{{ $s->members_count }}</td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($s->status === 'open')
                                            <form action="{{ route('pengurus.shu.distribute', $s) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition-all active:scale-95">
                                                    Distribusi
                                                </button>
                                            </form>
                                            <form action="{{ route('pengurus.shu.close', $s) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-slate-300 text-slate-600 text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-400 transition-all active:scale-95">
                                                    Tutup
                                                </button>
                                            </form>
                                        @elseif($s->status === 'distributed')
                                            <form action="{{ route('pengurus.shu.close', $s) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-slate-800 text-white text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-900 transition-all active:scale-95">
                                                    Tutup Periode
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[9px] font-bold text-slate-400 italic">Selesai</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
</style>

@endsection
