@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ openModal: false, selectedMonth: '' }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Data Angsuran</h1>
            <p class="text-slate-500 mt-1 font-medium">Manajemen pembayaran dan jadwal angsuran pinjaman aktif</p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
            <div class="p-2 bg-emerald-50 rounded-lg">
                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <span class="text-sm font-bold text-slate-600">Sistem Autodebet Aktif</span>
        </div>
    </div>

    {{-- ================= Info Cards ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Tagihan Bulan Ini --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Tagihan {{ now()->format('F Y') }}</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($tagihanBulanIni) }}</h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-rose-100/50 text-rose-700 border border-rose-200 uppercase tracking-widest">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Jatuh Tempo: {{ $jatuhTempo?->format('d M') ?? '-' }}
                    </div>
                </div>
                @if($pinjamanAktif)
                <form action="{{ route('anggota.angsuran.bayar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="installment_id" value="{{ $jadwalAngsuran->where('status','pending')->first()?->id ?? '' }}">
                    <button type="submit" class="w-full px-10 py-4 bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-blue-600 transition-all active:scale-95">
                        Bayar Sekarang
                    </button>
                </form>
                @endif
            </div>
        </div>

        {{-- Progres Angsuran --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-emerald-700 transition-colors">Progres Tenor</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-end gap-2">
                    <h2 class="text-4xl font-black text-slate-800 tabular-nums">{{ $progresBulan }}<span class="text-lg text-slate-400">/{{ $totalBulan }}</span></h2>
                    <p class="text-[10px] font-bold text-slate-400 pb-1.5 uppercase">Bulan</p>
                </div>
                <div class="space-y-3">
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-emerald-500 h-full rounded-full transition-all duration-1000" style="width: {{ $progressPercent }}%"></div>
                    </div>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-100/50 text-emerald-700 border border-emerald-200 uppercase tracking-widest">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        {{ $sisaBulan }} Bulan Tersisa
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Terbayar --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">Total Terbayar</p>
                    <div class="p-4 bg-slate-100 text-slate-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($totalTerbayar) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-slate-100/50 text-slate-700 border border-slate-200 uppercase tracking-widest">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Termasuk Jasa/Bunga
                </div>
            </div>
        </div>
    </div>

    {{-- ================= Jadwal Angsuran Table ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Jadwal & Riwayat Angsuran</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Pinjaman Aktif: {{ $pinjamanAktifId ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Bulan Ke</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tanggal Tagihan</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Pokok</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Jasa</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total Tagihan</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($jadwalAngsuran as $ang)
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300 {{ $ang->status === 'paid' ? 'opacity-60' : ($ang->status === 'pending' && $loop->first ? 'bg-blue-50/30' : '') }}">
                        <td class="px-8 py-7 text-sm font-bold {{ $ang->status === 'paid' ? 'text-slate-500' : ($loop->first ? 'text-blue-600' : 'text-slate-400') }}">{{ $ang->installment_number }}</td>
                        <td class="px-8 py-7 text-sm {{ $ang->status === 'paid' ? 'text-slate-500' : ($loop->first ? 'text-slate-800 font-bold' : 'text-slate-400') }}">{{ $ang->due_date?->translatedFormat('d F Y') }}</td>
                        <td class="px-8 py-7 text-sm font-medium {{ $ang->status === 'paid' ? 'text-slate-500' : 'text-slate-700' }}">Rp {{ number_format($ang->principal) }}</td>
                        <td class="px-8 py-7 text-sm font-medium {{ $ang->status === 'paid' ? 'text-slate-500' : 'text-slate-700' }}">Rp {{ number_format($ang->interest) }}</td>
                        <td class="px-8 py-7 text-sm font-black {{ $ang->status === 'paid' ? 'text-slate-500' : 'text-slate-800' }} tabular-nums">Rp {{ number_format($ang->amount) }}</td>
                        <td class="px-8 py-7 text-center">
                            @if($ang->status === 'paid')
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Lunas
                            </span>
                            @elseif($loop->first)
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                Menunggu
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-50 text-slate-400 text-[10px] font-black rounded-xl border border-slate-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                Belum Tersedia
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center font-bold text-slate-400 italic">Tidak ada jadwal angsuran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= Popup Konfirmasi Pembayaran ================= --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition x-cloak>
        
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden"
             @click.away="openModal = false">
            
            <div class="relative z-10 text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                
                <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Konfirmasi Bayar</h3>
                <p class="text-sm text-slate-500 mt-2">Anda akan melakukan pembayaran angsuran untuk bulan <span class="font-bold text-slate-800" x-text="selectedMonth"></span></p>

                <div class="my-8 p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total yang harus dibayar</p>
                    <p class="text-3xl font-black text-blue-600 tabular-nums">Rp {{ number_format($tagihanBulanIni) }}</p>
                </div>

                <div class="flex flex-col gap-3">
                    @if($pinjamanAktif)
                    <form action="{{ route('anggota.angsuran.bayar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="installment_id" value="{{ $jadwalAngsuran->where('status','pending')->first()?->id ?? '' }}">
                        <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-xl shadow-blue-100">
                            Bayar via Saldo Sukarela
                        </button>
                    </form>
                    @endif
                    <button type="button" @click="openModal = false" class="w-full bg-slate-100 text-slate-500 py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Batalkan
                    </button>
                </div>
                
                <p class="mt-6 text-[10px] text-slate-400 font-medium italic">
                    *Pastikan saldo simpanan sukarela Anda mencukupi.
                </p>
            </div>
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