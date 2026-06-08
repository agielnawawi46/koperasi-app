@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 space-y-8" x-data="{ dropdown: null }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Pinjaman Saya</h1>
            <p class="text-slate-500 mt-1 font-medium">Informasi sisa angsuran dan riwayat pinjaman Anda</p>
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {{-- Sisa Pinjaman (Hero Card - md:col-span-2) --}}
    <div class="md:col-span-2 group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
        <div class="absolute top-0 right-0 w-48 h-48 bg-rose-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-rose-100"></div>
        
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-rose-700 transition-colors">Sisa Hutang Pokok</p>
                    <div class="p-4 bg-rose-100 text-rose-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-5xl font-black text-slate-800 tracking-tight tabular-nums">Rp {{ number_format($sisaHutang) }}</h2>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-rose-100/50 text-rose-700 border border-rose-200 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-pulse"></span>
                            Sisa {{ $sisaAngsuran }} Angsuran
                        </div>
                        <span class="text-[10px] font-black text-rose-500 uppercase">{{ $progressPercent }}% Terbayar</span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-rose-500 h-full rounded-full transition-all duration-1000" style="width: {{ $progressPercent }}%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button onclick="openPinjamanModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-xl shadow-slate-200 hover:bg-slate-900 transition-all active:scale-95">
                    Ajukan Pinjaman Baru
                </button>
            </div>
        </div>
    </div>

    {{-- Info Angsuran Berikutnya --}}
    <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-100"></div>
        
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-amber-700 transition-colors">Angsuran Bulan Ini</p>
                <div class="p-4 bg-amber-100 text-amber-600 rounded-2xl shadow-sm">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($angsuranBulanIni) }}</h2>
                <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-rose-100/50 text-rose-700 border border-rose-200 uppercase tracking-widest">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ $jatuhTempo?->format('d M Y') ?? '-' }}
                </div>
            </div>

                @if($pinjamanAktif)
                <div class="pt-4 border-t border-slate-50 space-y-3">
                <div class="flex justify-between items-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <span>Pokok</span>
                    <span class="text-slate-700">Rp {{ number_format($pokok) }}</span>
                </div>
                <div class="flex justify-between items-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <span>Jasa ({{ $pinjamanAktif->interest_rate }}%)</span>
                    <span class="text-emerald-600">Rp {{ number_format($jasa) }}</span>
                </div>
                </div>
                @endif
        </div>
    </div>
</div>
    {{-- ================= Riwayat Pinjaman ================= --}}
    <div x-data="{ expanded: null }" class="space-y-4 animate-slide-up">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Riwayat Pinjaman</h2>
                <p class="text-sm text-slate-400 font-medium">{{ count($riwayatPinjaman) }} pinjaman tercatat</p>
            </div>
        </div>

        @forelse($riwayatPinjaman as $p)
        @php
            $statusColor = match($p->status) {
                'paid'     => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                'active'   => 'bg-blue-50 text-blue-700 border-blue-200',
                'approved' => 'bg-amber-50 text-amber-700 border-amber-200',
                'pending'  => 'bg-amber-50 text-amber-700 border-amber-200',
                default    => 'bg-slate-50 text-slate-600 border-slate-200',
            };
        @endphp
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all duration-300"
             :class="expanded === {{ $p->id }} ? 'shadow-lg ring-1 ring-slate-200' : 'hover:shadow-md'">
            <button type="button"
                @click="expanded = expanded === {{ $p->id }} ? null : {{ $p->id }}"
                class="w-full flex items-center justify-between p-6 text-left">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-black text-xs shrink-0">{{ $p->loan_number }}</div>
                    <div class="min-w-0">
                        <p class="font-black text-slate-800 tabular-nums">Rp {{ number_format($p->amount) }}</p>
                        <p class="text-[10px] font-bold text-slate-400 mt-0.5">{{ $p->created_at->format('d M Y') }} &middot; {{ $p->tenure_months }} Bulan</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center gap-1.5 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 border {{ $statusColor }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $p->status === 'pending' || $p->status === 'approved' || $p->status === 'active' ? 'bg-amber-500 animate-ping' : ($p->status === 'paid' ? 'bg-emerald-500' : 'bg-slate-400') }}"></span>
                        {{ ucfirst($p->status) }}
                    </span>
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
                <div class="p-6 bg-slate-50/30 space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">No. Berkas</p>
                            <p class="text-sm font-black text-slate-800">{{ $p->loan_number }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tanggal Pinjam</p>
                            <p class="text-sm font-black text-slate-800">{{ $p->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tenor</p>
                            <p class="text-sm font-black text-slate-800">{{ $p->tenure_months }} Bulan</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Pinjaman</p>
                            <p class="text-sm font-black text-indigo-600 tabular-nums">Rp {{ number_format($p->amount) }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-slate-100">
                        <a href="{{ route('anggota.angsuran') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-blue-600 transition-all shadow-lg active:scale-95">
                            Detail Angsuran
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-16 text-center">
            <p class="font-bold text-slate-400 italic">Belum ada pinjaman.</p>
        </div>
        @endforelse
    </div>

    {{-- ================= Popup Ajukan Pinjaman (Modal) ================= --}}
    <div id="modalPinjaman" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl p-10 border border-slate-100 relative overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-0"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Form Pengajuan</h3>
                        <p class="text-[10px] text-blue-600 font-black uppercase tracking-widest mt-1">Pinjaman Dana Karya Baru</p>
                    </div>
                    <button onclick="closePinjamanModal()" class="text-slate-300 hover:text-rose-500 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('anggota.pinjaman.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-5">
                        <div class="col-span-2 group">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block group-focus-within:text-blue-600 transition-colors">Besar Pinjaman (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-black text-slate-400">Rp</span>
                                <input type="number" name="amount" class="w-full bg-slate-50 border-none rounded-2xl pl-12 pr-4 py-4 text-sm font-black text-slate-800 focus:ring-2 focus:ring-blue-500 placeholder:text-slate-300 transition-all" placeholder="0" required>
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Tenor (Bulan)</label>
                            <select name="tenure_months" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-black text-slate-700 focus:ring-2 focus:ring-blue-500">
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                                <option value="24">24 Bulan</option>
                            </select>
                        </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Keperluan</label>
                        <input type="text" name="purpose" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-black text-slate-700 focus:ring-2 focus:ring-blue-500" placeholder="e.g. Pendidikan" required>
                    </div>
                    <div class="col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Metode Pembayaran</label>
                        <select name="payment_method" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-black text-slate-700 focus:ring-2 focus:ring-blue-500">
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="bayar_langsung">Bayar Langsung ke Pengurus</option>
                        </select>
                    </div>
                </div>

                    <div class="bg-blue-50/50 p-6 rounded-3xl border border-blue-100 flex items-center gap-4">
                        <div class="p-3 bg-white rounded-2xl text-blue-600 shadow-sm">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-baseline gap-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Estimasi:</span>
                                <span class="text-sm font-black text-slate-800 uppercase tracking-tighter">Rp {{ number_format($estimasiBulanan) }} / bln</span>
                            </div>
                            <p class="text-[9px] text-blue-500 font-bold uppercase italic leading-tight">*Sudah termasuk jasa koperasi.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 hover:-translate-y-1">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openPinjamanModal() {
    const modal = document.getElementById('modalPinjaman');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closePinjamanModal() {
    const modal = document.getElementById('modalPinjaman');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const modal = document.getElementById('modalPinjaman');
    if (!modal.classList.contains('hidden') && event.target === modal) {
        closePinjamanModal();
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