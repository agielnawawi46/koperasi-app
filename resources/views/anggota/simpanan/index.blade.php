@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8" x-data="{ metodeWajib: 'Transfer Bank' }">

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-800 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ $errors->first() }}
    </div>
    @endif

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Simpanan Saya</h1>
            <p class="text-slate-500 mt-1 font-medium">Pantau aset Anda di <span class="text-blue-600">{{ $namaKoperasi }}</span></p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-2 group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-48 h-48 bg-blue-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Total Akumulasi Saldo</p>
                        <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-5xl font-black text-slate-800 tracking-tighter tabular-nums">Rp {{ number_format($totalSaldo) }}</h2>
                </div>
                <div class="mt-8 flex items-center gap-4">
                    <button onclick="openSukarelaModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                        Tambah Simpanan Sukarela
                    </button>
                    @if($paymentMethod === 'Transfer Manual')
                    <button onclick="openWajibModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition-all active:scale-95">
                        Bayar Simpanan Wajib
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">Status Anggota</p>
                    <div class="p-4 bg-slate-100 text-slate-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">{{ $statusAnggota }}</h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-slate-100/50 text-slate-700 border border-slate-200 uppercase tracking-widest">
                        ID: {{ $memberCode }}
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-50">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terdaftar Sejak</p>
                    <p class="text-sm font-black text-slate-700">{{ $joinDate }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= Detail Saldo Cards ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Simpanan Pokok</span>
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-black text-slate-800 tabular-nums">Rp {{ number_format($pokok) }}</p>
            <p class="text-[10px] text-slate-400 font-bold mt-1">Setoran awal saat pendaftaran</p>
        </div>

        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Simpanan Wajib</span>
                <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-black text-slate-800 tabular-nums">Rp {{ number_format($wajib) }}</p>
            <p class="text-[10px] text-slate-400 font-bold mt-1">
                @if($paymentMethod === 'Potong Gaji')
                    Potong Gaji Otomatis - Tgl {{ $tglTagihan }}
                @else
                    Setoran Rp {{ number_format($wajibAmount) }}/bln - Jatuh tempo tgl {{ $tglTagihan }}
                @endif
            </p>
        </div>

        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Simpanan Sukarela</span>
                <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-black text-slate-800 tabular-nums">Rp {{ number_format($saldoSukarela) }}</p>
            <p class="text-[10px] text-slate-400 font-bold mt-1">Setoran sukarela / tabungan</p>
        </div>
    </div>

    {{-- ================= Riwayat Transaksi ================= --}}
    <div x-data="{ filter: 'all', expanded: null }" class="space-y-4 animate-slide-up">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Riwayat Transaksi</h2>
                <p class="text-sm text-slate-400 font-medium">{{ count($riwayat) }} transaksi tercatat</p>
            </div>
            <select x-model="filter" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-600 focus:ring-2 focus:ring-blue-500 transition-all">
                <option value="all">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </select>
        </div>

        @forelse($riwayat as $trx)
        @php
            $statusColor = match($trx->status) {
                'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                default   => 'bg-amber-50 text-amber-700 border-amber-200',
            };
            $statusLabel = match($trx->status) {
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak',
                default   => 'Pending',
            };
            $typeIcons = [
                'pokok'    => 'bg-emerald-50 text-emerald-600',
                'wajib'    => 'bg-amber-50 text-amber-600',
                'sukarela' => 'bg-purple-50 text-purple-600',
            ];
            $iconClass = $typeIcons[$trx->type] ?? 'bg-blue-50 text-blue-600';
        @endphp
        <div x-show="filter === 'all' || filter === '{{ $trx->status }}'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all duration-300"
             :class="expanded === {{ $trx->id }} ? 'shadow-lg ring-1 ring-slate-200' : 'hover:shadow-md'">
            <button type="button"
                @click="expanded = expanded === {{ $trx->id }} ? null : {{ $trx->id }}"
                class="w-full flex items-center justify-between p-6 text-left">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 {{ $iconClass }} rounded-2xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="font-black text-slate-800 capitalize truncate">{{ $trx->type }}</p>
                        <p class="text-[10px] font-bold text-slate-400 mt-0.5">{{ $trx->transaction_date?->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 shrink-0">
                    <div class="text-right hidden sm:block">
                        <p class="text-base font-black text-slate-800 tabular-nums">Rp {{ number_format($trx->amount) }}</p>
                        <span class="inline-flex items-center gap-1.5 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 border {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 shrink-0"
                         :class="expanded === {{ $trx->id }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>

            <div x-show="expanded === {{ $trx->id }}" x-cloak
                 x-transition:enter="transition-all duration-300 ease-out"
                 x-transition:enter-start="opacity-0 max-h-0 overflow-hidden"
                 x-transition:enter-end="opacity-100 max-h-96"
                 class="border-t border-slate-50">
                <div class="p-6 bg-slate-50/30 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tanggal</p>
                            <p class="text-sm font-black text-slate-800">{{ $trx->transaction_date?->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Nominal</p>
                            <p class="text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($trx->amount) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Metode</p>
                            <p class="text-sm font-black text-slate-700">{{ $trx->payment_method ? str_replace('_', ' ', ucfirst($trx->payment_method)) : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Status</p>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black border rounded-lg px-2 py-1 {{ $statusColor }}">{{ $statusLabel }}</span>
                        </div>
                    </div>
                    @if($trx->description)
                    <div class="pt-3 border-t border-slate-100">
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Keterangan</p>
                        <p class="text-sm font-medium text-slate-600">{{ $trx->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-16 text-center">
            <p class="font-bold text-slate-400 italic">Belum ada riwayat transaksi.</p>
        </div>
        @endforelse
    </div>

    {{-- ================= Modal Bayar Wajib ================= --}}
    <div id="modalBayarWajib" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">

            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-0"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Bayar Simpanan Wajib</h3>
                    <button onclick="closeWajibModal()" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 mb-6">
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-slate-600">Besaran Wajib</span>
                        <span class="font-black text-emerald-700">Rp {{ number_format($wajibAmount) }}/bulan</span>
                    </div>
                    <div class="flex justify-between items-center text-sm mt-2">
                        <span class="font-bold text-slate-600">Jatuh Tempo</span>
                        <span class="font-black text-slate-700">Tanggal {{ $tglTagihan }}</span>
                    </div>
                </div>

                <form action="{{ route('anggota.simpanan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="wajib">

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Pembayaran</label>
                        <select name="metode" x-model="metodeWajib" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="Transfer Bank">Transfer Bank (Langsung Terverifikasi)</option>
                            <option value="Bayar Langsung">Bayar Langsung ke Pengurus</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ $wajibAmount }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>

                    <div x-show="metodeWajib === 'Transfer Bank'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-blue-50 p-5 rounded-2xl border border-blue-100 space-y-3">
                            <p class="text-[10px] font-black text-blue-700 uppercase tracking-widest">Transfer ke Rekening</p>
                            <div class="bg-white rounded-xl px-4 py-3 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-slate-500 font-medium">Bank</span>
                                    <span class="font-bold text-slate-800">{{ $bankName ?? 'Belum diatur' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 font-medium">Atas Nama</span>
                                    <span class="font-bold text-slate-800">{{ $bankAccountName ?? 'Belum diatur' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 font-medium">No. Rekening</span>
                                    <span class="font-bold text-blue-700 text-base tracking-wider">{{ $bankAccountNumber ?? 'Belum diatur' }}</span>
                                </div>
                            </div>
                            <p class="text-[10px] text-emerald-600 font-bold italic">
                                *Transfer Bank akan langsung terverifikasi & saldo otomatis bertambah.
                            </p>
                        </div>
                    </div>

                    <div x-show="metodeWajib === 'Bayar Langsung'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-amber-50 p-5 rounded-2xl border border-amber-100 space-y-2">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="text-[10px] font-black text-amber-800 uppercase tracking-widest">Bayar Langsung ke Pengurus</p>
                            </div>
                            <p class="text-xs text-amber-700 font-medium leading-relaxed">
                                Setelah membayar ke pengurus, mereka akan memverifikasi transaksi Anda. Saldo akan bertambah setelah verifikasi.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="px-10 py-4 w-full bg-emerald-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-emerald-700 transition-all active:scale-95">
                        Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= Popup Modal Sukarela ================= --}}
    <div id="modalSukarela" x-data="{ metode: 'Transfer Bank (Manual)' }" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">

            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-0"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Tambah Simpanan Sukarela</h3>
                    <button onclick="closeSukarelaModal()" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('anggota.simpanan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="sukarela">

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Pembayaran</label>
                        <select name="metode" x-model="metode" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="Transfer Bank (Manual)">Transfer Bank (Manual)</option>
                            <option value="Potong Gaji (Bulan Depan)">Potong Gaji (Bulan Depan)</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nominal Simpanan (Rp)</label>
                        <input type="number" name="nominal" placeholder="Contoh: 500000" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all placeholder:text-slate-300">
                    </div>

                    <div x-show="metode === 'Transfer Bank (Manual)'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-blue-50 p-5 rounded-2xl border border-blue-100 space-y-3">
                            <p class="text-[10px] font-black text-blue-700 uppercase tracking-widest">Transfer ke Rekening</p>
                            <div class="bg-white rounded-xl px-4 py-3 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-slate-500 font-medium">Bank</span>
                                    <span class="font-bold text-slate-800">{{ $bankName ?? 'Belum diatur' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 font-medium">Atas Nama</span>
                                    <span class="font-bold text-slate-800">{{ $bankAccountName ?? 'Belum diatur' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 font-medium">No. Rekening</span>
                                    <span class="font-bold text-blue-700 text-base tracking-wider">{{ $bankAccountNumber ?? 'Belum diatur' }}</span>
                                </div>
                            </div>
                            <p class="text-[10px] text-blue-600 font-bold leading-relaxed italic">
                                *Lakukan transfer sesuai nominal & konfirmasi bukti bayar ke pengurus.
                            </p>
                        </div>
                    </div>

                    <div x-show="metode === 'Potong Gaji (Bulan Depan)'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-amber-50 p-5 rounded-2xl border border-amber-100 space-y-2">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-[10px] font-black text-amber-800 uppercase tracking-widest">Menunggu Konfirmasi Pengurus</p>
                            </div>
                            <p class="text-xs text-amber-700 font-medium leading-relaxed">
                                Setoran via potong gaji akan diverifikasi oleh pengurus terlebih dahulu.
                                Proses pemotongan gaji akan berlaku mulai bulan depan setelah disetujui.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="px-10 py-4 w-full bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-blue-600 transition-all active:scale-95">
                        Ajukan Setoran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openWajibModal() {
    const modal = document.getElementById('modalBayarWajib');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeWajibModal() {
    const modal = document.getElementById('modalBayarWajib');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
function openSukarelaModal() {
    const modal = document.getElementById('modalSukarela');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeSukarelaModal() {
    const modal = document.getElementById('modalSukarela');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const mw = document.getElementById('modalBayarWajib');
    if (!mw.classList.contains('hidden') && event.target === mw) closeWajibModal();
    const ms = document.getElementById('modalSukarela');
    if (!ms.classList.contains('hidden') && event.target === ms) closeSukarelaModal();
});
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection