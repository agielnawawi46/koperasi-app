@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

{{-- Container utama harus 'relative' untuk posisi Floating Filter --}}
<div class="relative px-8 py-8 space-y-8 animate-fade-in">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Kelola Pinjaman</h1>
            </div>
            <p class="text-slate-500 font-medium ml-1">Review, persetujuan, dan monitoring pencairan dana anggota.</p>
        </div>
        
        <div class="flex items-center gap-3">
            {{-- Tombol Filter --}}
            <button onclick="toggleFilter()" class="group flex items-center gap-2 px-5 py-3.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl shadow-sm hover:border-blue-500 hover:text-blue-600 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-50 group-hover:bg-blue-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                </div>
                Filter Data
            </button>
            
            {{-- Tombol Input Manual --}}
            <button onclick="openModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                <div class="p-1.5 bg-blue-500 group-hover:bg-blue-400 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </div>
                Input Pinjaman Manual
            </button>
        </div>
    </div>

    {{-- ================= FLOATING FILTER PANEL ================= --}}
    <div id="filterPanel" class="absolute right-8 top-24 z-50 w-80 bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/50 p-8 transform transition-all duration-300 opacity-0 pointer-events-none translate-y-4">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-800">Filter Pencarian</h4>
                <button onclick="toggleFilter()" class="text-slate-400 hover:text-red-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-2">
                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Status Pinjaman</label>
                    <select class="w-full bg-slate-100/50 border-none rounded-xl px-4 py-3 text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending">Waiting Review</option>
                        <option value="approved">Disetujui</option>
                        <option value="ready_for_disbursement">Siap Cair</option>
                        <option value="active">Active</option>
                    </select>
            </div>

            <div class="space-y-2">
                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Periode</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="date" class="bg-slate-100/50 border-none rounded-xl px-3 py-3 text-[10px] font-bold text-slate-700 focus:ring-2 focus:ring-blue-500">
                    <input type="date" class="bg-slate-100/50 border-none rounded-xl px-3 py-3 text-[10px] font-bold text-slate-700 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <button class="flex-1 py-3 bg-slate-100 text-slate-600 text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-200 transition-all">Reset</button>
                <button class="flex-1 py-3 bg-blue-600 text-white text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all">Terapkan</button>
            </div>
        </div>
    </div>

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Card 1 --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Total Outstanding</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($totalOutstanding) }}</h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-blue-100/50 text-blue-700 border border-blue-200 uppercase tracking-widest">Pinjaman Berjalan</div>
                </div>
            </div>
        </div>
        {{-- Card 2 --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700 transition-colors">Perlu Review</p>
                    <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">{{ $perluReview }} <span class="text-sm text-slate-400 font-bold uppercase tracking-widest">Berkas</span></h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-100/50 text-amber-700 border border-amber-200 uppercase tracking-widest">Segera Proses</div>
                </div>
            </div>
        </div>
        {{-- Card 3 --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-emerald-700 transition-colors">Estimasi Cicilan</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($estimasiCicilan) }}</h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-100/50 text-emerald-700 border border-emerald-200 uppercase tracking-widest">Periode {{ now()->translatedFormat('F') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= Session Messages ================= --}}
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

    {{-- ================= RIWAYAT ACCORDION ================= --}}
    <div x-data="{ expanded: null }" class="space-y-4 animate-slide-up mt-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Daftar Pengajuan & Pinjaman</h2>
                <p class="text-sm text-slate-400 font-medium">{{ count($pinjaman) }} data pinjaman tercatat</p>
            </div>
        </div>

        @forelse($pinjaman as $p)
        @php
            $statusColors = [
                'pending'               => 'bg-amber-50 text-amber-700 border-amber-200',
                'approved'              => 'bg-blue-50 text-blue-700 border-blue-200',
                'ready_for_disbursement' => 'bg-purple-50 text-purple-700 border-purple-200',
                'active'                => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'rejected'              => 'bg-rose-50 text-rose-700 border-rose-200',
                'paid'                  => 'bg-slate-50 text-slate-700 border-slate-200',
            ];
            $statusLabels = [
                'pending'               => 'Waiting Review',
                'approved'              => 'Disetujui',
                'ready_for_disbursement' => 'Siap Cair',
                'active'                => 'Aktif',
                'rejected'              => 'Ditolak',
                'paid'                  => 'Lunas',
            ];
        @endphp
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all duration-300"
             :class="expanded === {{ $p->id }} ? 'shadow-lg ring-1 ring-slate-200' : 'hover:shadow-md'">
            <button type="button"
                @click="expanded = expanded === {{ $p->id }} ? null : {{ $p->id }}"
                class="w-full flex items-center justify-between p-6 text-left">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 shrink-0">
                        {{ strtoupper(substr($p->user->name ?? '?', 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="font-black text-slate-800 truncate">{{ $p->user->name ?? 'Unknown' }}</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-0.5">{{ $p->loan_number }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-5 shrink-0">
                    <div class="text-right">
                        <p class="text-base font-black text-slate-800 tabular-nums">Rp {{ number_format($p->amount) }}</p>
                        <span class="inline-flex items-center gap-1.5 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 {{ $statusColors[$p->status] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $p->status === 'pending' ? 'bg-amber-500 animate-ping' : ($p->status === 'ready_for_disbursement' ? 'bg-purple-500 animate-pulse' : ($p->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400')) }}"></span>
                            {{ $statusLabels[$p->status] ?? ucfirst($p->status) }}
                        </span>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 shrink-0"
                         :class="expanded === {{ $p->id }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>

            <div x-show="expanded === {{ $p->id }}" x-cloak
                 x-transition:enter="transition-all duration-300 ease-out"
                 x-transition:enter-start="opacity-0 max-h-0 overflow-hidden"
                 x-transition:enter-end="opacity-100 max-h-96"
                 class="border-t border-slate-50">
                <div class="p-6 bg-slate-50/30 space-y-5">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Nominal Pinjaman</p>
                            <p class="text-sm font-black text-slate-800">Rp {{ number_format($p->amount) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tenor</p>
                            <p class="text-sm font-black text-slate-700">{{ $p->tenure_months }} Bulan</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Bunga</p>
                            <p class="text-sm font-black text-slate-700">{{ $p->interest_rate }}%</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tanggal Pengajuan</p>
                            <p class="text-sm font-black text-slate-700">{{ $p->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="md:col-span-4">
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tujuan</p>
                            <p class="text-sm font-black text-slate-700">{{ $p->purpose ?? '-' }}</p>
                        </div>
                    </div>

                    @if($p->status === 'pending')
                    <div class="flex gap-3 pt-2 border-t border-slate-100">
                        <form action="{{ route('pengurus.kelpinjaman.approve', $p) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-emerald-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 active:scale-95">
                                Setujui
                            </button>
                        </form>
                        <form action="{{ route('pengurus.kelpinjaman.reject', $p) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-rose-500 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-rose-600 transition-all shadow-lg shadow-rose-200 active:scale-95">
                                Tolak
                            </button>
                        </form>
                    </div>
                    @elseif($p->status === 'approved')
                    <div class="flex gap-3 pt-2 border-t border-slate-100">
                        <form action="{{ route('pengurus.kelpinjaman.ready', $p) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-purple-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-purple-700 transition-all shadow-lg shadow-purple-200 active:scale-95">
                                Tandai Siap Cair
                            </button>
                        </form>
                        <form action="{{ route('pengurus.kelpinjaman.cairkan', $p) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 active:scale-95">
                                Cairkan Dana
                            </button>
                        </form>
                    </div>
                    @elseif($p->status === 'ready_for_disbursement')
                    <div class="flex gap-3 pt-2 border-t border-slate-100">
                        <form action="{{ route('pengurus.kelpinjaman.cairkan', $p) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-8 py-3 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 active:scale-95">
                                Cairkan Dana
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-16 text-center">
            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <p class="font-bold text-slate-400 italic">Tidak ada data pinjaman.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ================= MODAL INPUT MANUAL ================= --}}
<div id="modalInputPinjaman" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md transition-all duration-300 hidden">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl border border-white/20 overflow-hidden transform transition-all duration-500 scale-95 translate-y-8">
        {{-- Header Modal --}}
        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-white to-blue-50/30">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Input Pinjaman Manual</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Otoritas Pengurus</p>
                </div>
            </div>
            <button onclick="closeModal()" class="p-2 hover:bg-red-50 hover:text-red-500 text-slate-400 rounded-xl transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Form Body --}}
        <form action="{{ route('pengurus.kelpinjaman.store') }}" method="POST" class="p-10 space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Anggota</label>
                    <select name="user_id" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                        @foreach(\App\Models\User::role('anggota')->get() as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->email }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nominal (Rp)</label>
                    <input type="number" name="amount" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tenor (Bulan)</label>
                    <select name="tenure_months" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                        @for($i = 3; $i <= 60; $i+=3)
                        <option value="{{ $i }}" {{ $i == 12 ? 'selected' : '' }}>{{ $i }} Bulan</option>
                        @endfor
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Bunga (%)</label>
                    <input type="number" name="interest_rate" step="0.1" value="{{ \App\Models\Organization::first()?->bunga_rate ?? 0.8 }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tujuan Pinjaman</label>
                    <input type="text" name="purpose" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Misal: Dana Darurat, Modal Usaha, dll">
                </div>
            </div>
            <div class="flex items-center justify-end gap-4 pt-4">
                <button type="button" onclick="closeModal()" class="px-8 py-4 text-slate-500 font-black text-[10px] uppercase tracking-[0.2em] hover:text-slate-700 transition-colors">Batal</button>
                <button type="submit" class="px-10 py-4 bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-blue-600 transition-all active:scale-95">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= LOGIC SCRIPT ================= --}}
<script>
    // Logic untuk Floating Filter
    function toggleFilter() {
        const panel = document.getElementById('filterPanel');
        const isHidden = panel.classList.contains('opacity-0');
        
        if (isHidden) {
            panel.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
            panel.classList.add('opacity-100', 'translate-y-0');
        } else {
            panel.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
            panel.classList.remove('opacity-100', 'translate-y-0');
        }
    }

    // Logic untuk Modal Input Manual
    function openModal() {
        const modal = document.getElementById('modalInputPinjaman');
        const content = modal.querySelector('div');
        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            content.classList.remove('scale-95', 'translate-y-8');
            content.classList.add('scale-100', 'translate-y-0');
        });
    }

    function closeModal() {
        const modal = document.getElementById('modalInputPinjaman');
        const content = modal.querySelector('div');
        content.classList.remove('scale-100', 'translate-y-0');
        content.classList.add('scale-95', 'translate-y-8');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    // Menutup elemen jika klik di luar (Optional UX)
    window.onclick = function(event) {
        const modal = document.getElementById('modalInputPinjaman');
        const filter = document.getElementById('filterPanel');
        if (event.target == modal) closeModal();
    }
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection