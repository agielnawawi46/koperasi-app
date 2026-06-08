@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')

<div class="px-8 py-8 space-y-8 animate-fade-in" x-data="{ metodeAngsuran: 'saldo_sukarela' }">

    {{-- ================= HEADER & GREETING ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dashboard Anggota</h1>
                <p class="text-slate-500 font-medium">Selamat datang kembali, berikut ringkasan saldo Anda hari ini.</p>
            </div>
        </div>
    </div>

    {{-- ================= SAVINGS BREAKDOWN CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Simpanan Pokok --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">Simpanan Pokok</p>
                    <div class="p-4 bg-slate-100 text-slate-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($pokokBalance) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-slate-100/50 text-slate-700 border border-slate-200 uppercase tracking-widest">
                    Rp {{ number_format($pokokAmount) }} · 1x Saat Daftar
                </div>
            </div>
        </div>

        {{-- Simpanan Wajib --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-emerald-700 transition-colors">Simpanan Wajib</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($wajibBalance) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-100/50 text-emerald-700 border border-emerald-200 uppercase tracking-widest">
                    Rp {{ number_format($wajibAmount) }} · Per Bulan
                </div>
            </div>
        </div>

        {{-- Simpanan Sukarela --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Simpanan Sukarela</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-blue-600 tabular-nums">Rp {{ number_format($sukarelaBalance) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-blue-100/50 text-blue-700 border border-blue-200 uppercase tracking-widest">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    Terverifikasi
                </div>
            </div>
        </div>
    </div>

    {{-- ================= LOAN & INSTALLMENT CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Total Pinjaman --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700 transition-colors">Total Pinjaman</p>
                    <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($totalPinjaman) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-100/50 text-amber-700 border border-amber-200 uppercase tracking-widest">
                    Sisa {{ $sisaAngsuran }}x angsuran
                </div>
            </div>
        </div>

        {{-- Cicilan Bulan Ini --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Cicilan Bulan Ini</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-blue-600 tabular-nums">Rp {{ number_format($tagihanBulanIni) }}</h2>
                <div class="mt-2 inline-flex items-center gap-1.5 px-4 py-1.5 bg-blue-50 text-blue-700 text-[10px] font-black rounded-xl border border-blue-100 uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                    Jatuh Tempo: {{ $pinjamanAktif?->installments?->where('status','pending')?->first()?->due_date?->format('d M') ?? '-' }}
                </div>
            </div>
        </div>
    </div>

    {{-- ================= PAYMENT & TRANSACTIONS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Payment Info --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 h-full flex flex-col justify-between relative overflow-hidden group">
                {{-- Background Decoration --}}
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-slate-50 rounded-full transition-transform group-hover:scale-110"></div>
                
                <div class="relative z-10">
                    <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Tagihan Aktif</h2>
                    <p class="text-sm text-slate-500 font-medium mb-6 leading-relaxed">Segera lakukan pembayaran sebelum tanggal jatuh tempo untuk menghindari denda.</p>
                    
                    <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 mb-6 flex items-center gap-4 group-hover:border-slate-200 transition-colors">
                        <div class="p-3 bg-white rounded-2xl text-slate-400 shadow-inner group-hover:text-green-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Tagihan</p>
                            <p class="text-2xl font-black text-slate-800">Rp {{ number_format($tagihanBulanIni) }}</p>
                        </div>
                    </div>
                </div>

                @if($pinjamanAktif && $tagihanBulanIni > 0)
                <button onclick="openBayarModal()" class="w-full py-5 bg-green-600 text-white font-black rounded-2xl shadow-xl shadow-green-100 hover:bg-green-700 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 relative z-10">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Bayar Sekarang
                </button>
                @endif
            </div>

        {{-- ================= RECENT TRANSACTIONS ================= --}}
        <div class="lg:col-span-2" x-data="{ filter: 'all', dropdown: null }">
            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
                <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Transaksi</h2>
                            <p class="text-sm text-slate-400 font-medium italic">Riwayat transaksi simpanan & pinjaman terbaru.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select x-model="filter" class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-600 focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="all">Semua Status</option>
                            <option value="paid">Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="p-6 space-y-3">
                    @forelse($riwayatTransaksi as $trx)
                    <div x-show="filter === 'all' || filter === '{{ $trx->status }}'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         @click="dropdown = (dropdown === {{ $loop->index }}) ? null : {{ $loop->index }}"
                         class="bg-white border border-slate-100 rounded-2xl overflow-hidden cursor-pointer hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">Angsuran ke-{{ $trx->installment_number }}</p>
                                    <p class="text-xs font-medium text-slate-400">{{ $trx->paid_date?->format('d M Y') ?? $trx->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-[9px] font-black rounded-lg border border-emerald-100">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Lunas
                                </span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-300" :class="{ 'rotate-180': dropdown === {{ $loop->index }} }" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                        <div x-show="dropdown === {{ $loop->index }}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="border-t border-slate-50 px-6 py-5 space-y-3 bg-slate-50/50">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Tanggal</span>
                                <span class="text-sm font-bold text-slate-800">{{ $trx->paid_date?->format('d M Y') ?? $trx->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Jenis</span>
                                <span class="text-sm font-bold text-slate-800">Cicilan Pinjaman (Angsuran ke-{{ $trx->installment_number }})</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-slate-100">
                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Nominal</span>
                                <span class="text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($trx->amount) }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 font-bold text-slate-400 italic">Belum ada transaksi.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    {{-- ================= Modal Bayar Angsuran ================= --}}
    <div id="modalBayarAngsuran" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -z-0"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Bayar Angsuran</h3>
                        <p class="text-[9px] text-green-600 font-black uppercase tracking-widest mt-1">Jatuh Tempo: {{ $jatuhTempo?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <button onclick="closeBayarModal()" class="text-slate-300 hover:text-rose-500 transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Tagihan Bulan Ini</span>
                        <span class="text-2xl font-black text-slate-800 tabular-nums">Rp {{ number_format($tagihanBulanIni) }}</span>
                    </div>
                </div>

                <form action="{{ route('anggota.angsuran.bayar') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="installment_id" value="{{ $pinjamanAktif?->installments?->where('status','pending')->first()?->id ?? '' }}">

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Pembayaran</label>
                        <select name="payment_method" x-model="metodeAngsuran" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-green-500 transition-all mt-2">
                            <option value="saldo_sukarela">Via Saldo Sukarela</option>
                            <option value="transfer_bank">Transfer Bank (Langsung Verifikasi)</option>
                            <option value="bayar_langsung">Bayar Langsung ke Pengurus</option>
                        </select>
                    </div>

                    <div x-show="metodeAngsuran === 'saldo_sukarela'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-emerald-50 p-5 rounded-2xl border border-emerald-100 space-y-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-[10px] font-black text-emerald-800 uppercase tracking-widest">Saldo Sukarela</p>
                            </div>
                            <p class="text-xs text-emerald-700 font-medium">Pembayaran otomatis dipotong dari saldo sukarela Anda. Proses instan tanpa verifikasi.</p>
                        </div>
                    </div>

                    <div x-show="metodeAngsuran === 'transfer_bank'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-blue-50 p-5 rounded-2xl border border-blue-100 space-y-3">
                            <p class="text-[10px] font-black text-blue-700 uppercase tracking-widest">Transfer ke Rekening Koperasi</p>
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
                                    <span class="font-bold text-green-700 text-base tracking-wider">{{ $bankAccountNumber ?? 'Belum diatur' }}</span>
                                </div>
                            </div>
                            <p class="text-[10px] text-blue-600 font-bold italic">*Transfer Bank akan langsung terverifikasi & otomatis tercatat.</p>
                        </div>
                    </div>

                    <div x-show="metodeAngsuran === 'bayar_langsung'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="bg-amber-50 p-5 rounded-2xl border border-amber-100 space-y-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="text-[10px] font-black text-amber-800 uppercase tracking-widest">Bayar Langsung</p>
                            </div>
                            <p class="text-xs text-amber-700 font-medium">Setelah membayar ke pengurus, mereka akan memverifikasi. Saldo akan tercatat setelah verifikasi.</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full px-10 py-4 bg-green-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-green-100 hover:bg-green-700 transition-all active:scale-95">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openBayarModal() {
    const modal = document.getElementById('modalBayarAngsuran');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeBayarModal() {
    const modal = document.getElementById('modalBayarAngsuran');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const modal = document.getElementById('modalBayarAngsuran');
    if (!modal.classList.contains('hidden') && event.target === modal) {
        closeBayarModal();
    }
});
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection