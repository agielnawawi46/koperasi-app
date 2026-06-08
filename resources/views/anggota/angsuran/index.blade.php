@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8" x-data="{ metodeAngsuran: 'saldo_sukarela' }">

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
                <button onclick="openBayarModal()" class="w-full mt-4 flex items-center justify-between px-6 py-4 bg-slate-900 text-white font-black tracking-tight rounded-2xl hover:bg-blue-600 transition-all shadow-xl active:scale-[0.98]">
                    <span class="text-sm uppercase tracking-wider">Bayar Angsuran</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
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

    {{-- ================= Jadwal & Riwayat Angsuran ================= --}}
    <div x-data="{ expanded: null }" class="space-y-4 animate-slide-up">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Jadwal & Riwayat Angsuran</h2>
                <p class="text-sm text-slate-400 font-medium">{{ count($jadwalAngsuran) }} angsuran &middot; Pinjaman: {{ $pinjamanAktifId ?? '-' }}</p>
            </div>
        </div>

        @forelse($jadwalAngsuran as $ang)
        @php
            $statusColor = $ang->status === 'paid'
                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                : ($loop->first ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-slate-50 text-slate-400 border-slate-200');
            $statusLabel = $ang->status === 'paid'
                ? 'Lunas'
                : ($loop->first ? 'Menunggu' : 'Belum Tersedia');
            $numColor = $ang->status === 'paid'
                ? 'bg-emerald-50 text-emerald-600'
                : ($loop->first ? 'bg-blue-50 text-blue-600 ring-2 ring-blue-200' : 'bg-slate-100 text-slate-400');
        @endphp
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all duration-300 {{ $ang->status === 'paid' ? 'opacity-60' : '' }}"
             :class="expanded === {{ $ang->id }} ? 'shadow-lg ring-1 ring-slate-200' : 'hover:shadow-md'">
            <button type="button"
                @click="expanded = expanded === {{ $ang->id }} ? null : {{ $ang->id }}"
                class="w-full flex items-center justify-between p-6 text-left">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 {{ $numColor }} rounded-2xl flex items-center justify-center font-black text-sm shrink-0">{{ $ang->installment_number }}</div>
                    <div class="min-w-0">
                        <p class="font-black {{ $ang->status === 'paid' ? 'text-slate-500' : ($loop->first ? 'text-blue-600' : 'text-slate-800') }}">Angsuran ke-{{ $ang->installment_number }}</p>
                        <p class="text-[10px] font-bold {{ $ang->status === 'paid' ? 'text-slate-400' : ($loop->first ? 'text-blue-500' : 'text-slate-400') }} mt-0.5">{{ $ang->due_date?->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 shrink-0">
                    <div class="text-right hidden sm:block">
                        <p class="text-base font-black text-slate-800 tabular-nums">Rp {{ number_format($ang->amount) }}</p>
                        <span class="inline-flex items-center gap-1.5 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 border {{ $statusColor }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $ang->status === 'paid' ? 'bg-emerald-500' : ($loop->first ? 'bg-amber-500 animate-ping' : 'bg-slate-400') }}"></span>
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 shrink-0"
                         :class="expanded === {{ $ang->id }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>

            <div x-show="expanded === {{ $ang->id }}" x-cloak
                 x-transition:enter="transition-all duration-300 ease-out"
                 x-transition:enter-start="opacity-0 max-h-0 overflow-hidden"
                 x-transition:enter-end="opacity-100 max-h-96"
                 class="border-t border-slate-50">
                <div class="p-6 bg-slate-50/30 space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tanggal Tagihan</p>
                            <p class="text-sm font-black text-slate-800">{{ $ang->due_date?->translatedFormat('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Pokok</p>
                            <p class="text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($ang->principal) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Jasa</p>
                            <p class="text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($ang->interest) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Tagihan</p>
                            <p class="text-sm font-black text-indigo-600 tabular-nums">Rp {{ number_format($ang->amount) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-16 text-center">
            <p class="font-bold text-slate-400 italic">Tidak ada jadwal angsuran.</p>
        </div>
        @endforelse
    </div>

    {{-- ================= Modal Bayar Angsuran ================= --}}
    <div id="modalBayarAngsuran" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 border border-slate-100 relative overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-0"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Bayar Angsuran</h3>
                        <p class="text-[9px] text-blue-600 font-black uppercase tracking-widest mt-1">Jatuh Tempo: {{ $jatuhTempo?->format('d M Y') ?? '-' }}</p>
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
                    <input type="hidden" name="installment_id" value="{{ $jadwalAngsuran->where('status','pending')->first()?->id ?? '' }}">

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Pembayaran</label>
                        <select name="payment_method" x-model="metodeAngsuran" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all mt-2">
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
                                    <span class="font-bold text-blue-700 text-base tracking-wider">{{ $bankAccountNumber ?? 'Belum diatur' }}</span>
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

                    <button type="submit" class="w-full px-10 py-4 bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-blue-600 transition-all active:scale-95">
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