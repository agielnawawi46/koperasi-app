@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')

<div x-data="{ openModal: false, selectedMonth: 'Januari 2026' }" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= HEADER & GREETING ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dashboard Anggota</h1>
                <p class="text-slate-500 font-medium">Selamat datang kembali, berikut ringkasan saldo Anda hari ini.</p>
            </div>
        </div>
    </div>

    {{-- ================= SUMMARY CARDS (WITH ICONS) ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Total Simpanan --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-green-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-green-700 transition-colors">Total Simpanan</p>
                    <div class="p-4 bg-green-100 text-green-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($totalSimpanan) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-green-100/50 text-green-700 border border-green-200 uppercase tracking-widest">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    Saldo Tersimpan
                </div>
            </div>
        </div>

        {{-- Total Pinjaman --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700 transition-colors">Total Pinjaman</p>
                    <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
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
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- ================= PAYMENT INFO (LEFT SIDE) ================= --}}
        <div class="lg:col-span-1">
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
                <form action="{{ route('anggota.angsuran.bayar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="installment_id" value="{{ $pinjamanAktif->installments->where('status','pending')->first()?->id ?? '' }}">
                    <button type="submit" class="w-full py-5 bg-green-600 text-white font-black rounded-2xl shadow-xl shadow-green-100 hover:bg-green-700 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 relative z-10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Bayar Sekarang
                    </button>
                </form>
                @endif
            </div>
        </div>

        {{-- ================= RECENT TRANSACTIONS (RIGHT SIDE) ================= --}}
        <div class="lg:col-span-2">
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
                    <a href="#" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-slate-50 transition-all shadow-sm">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tanggal</th>
                                <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Jenis Transaksi</th>
                                <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Nominal</th>
                                <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($riwayatTransaksi as $trx)
                            <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                                <td class="px-8 py-7 text-sm font-bold text-slate-600">{{ $trx->paid_date?->format('d M Y') ?? $trx->created_at->format('d M Y') }}</td>
                                <td class="px-8 py-7">
                                    <div class="flex items-center gap-3">
                                        <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl shadow-sm">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <span class="text-sm font-bold text-slate-800">Cicilan Pinjaman (Angsuran ke-{{ $trx->installment_number }})</span>
                                    </div>
                                </td>
                                <td class="px-8 py-7 text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($trx->amount) }}</td>
                                <td class="px-8 py-7">
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        Lunas
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- ================= Popup Konfirmasi Pembayaran ================= --}}
<div x-show="openModal" 
     class="fixed inset-0 z-[999] flex items-center justify-center p-4"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak>
    
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openModal = false"></div>
    
    {{-- Modal Content --}}
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative z-10 overflow-hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         @click.away="openModal = false">
        
        {{-- Ornamen Latar Belakang --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0"></div>
        
        <div class="relative z-10 text-center">
            <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-inner transition-transform duration-500 hover:rotate-12">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            
            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Konfirmasi Bayar</h3>
            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                Anda akan melakukan pembayaran angsuran untuk bulan <br>
                <span class="font-bold text-slate-800" x-text="selectedMonth"></span>
            </p>

            <div class="my-8 p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total yang harus dibayar</p>
                <p class="text-3xl font-black text-blue-600 tabular-nums tracking-tight">Rp 525.000</p>
            </div>

            <div class="flex flex-col gap-3">
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 hover:-translate-y-1 active:scale-95">
                        Bayar via Saldo Sukarela
                    </button>
                </form>
                <button type="button" @click="openModal = false" class="w-full bg-slate-100 text-slate-500 py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">
                    Batalkan
                </button>
            </div>
            
            <p class="mt-6 text-[10px] text-slate-400 font-bold italic uppercase tracking-tighter">
                *Pastikan saldo simpanan sukarela Anda mencukupi.
            </p>
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