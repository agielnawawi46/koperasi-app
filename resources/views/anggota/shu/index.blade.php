@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
{{-- Tambahkan x-data untuk kontrol popup --}}
<div class="px-8 py-8 space-y-8 animate-fade-in" x-data="{ metode: 'Simpanan Sukarela' }">

    {{-- ================= Header Section ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Sisa Hasil Usaha (SHU)</h1>
            <p class="text-slate-500 mt-1 font-medium">Transparansi pembagian keuntungan tahunan anggota</p>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
            <div class="p-2 bg-indigo-50 rounded-lg">
                <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <span class="text-sm font-bold text-slate-600">Periode Buku {{ $tahunBuku }}</span>
        </div>
    </div>

    {{-- ================= Statistik Grid ================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    {{-- Total SHU Diterima (Hero Card) --}}
    <div class="md:col-span-2 group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
        <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-50 rounded-bl-[120px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-indigo-100"></div>
        
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-indigo-700 transition-colors">Total SHU Tahun Ini</p>
                    <div class="p-4 bg-indigo-100 text-indigo-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-5xl font-black text-black tabular-nums tracking-tight">Rp {{ number_format($totalSHU) }}</h2>
                    <p class="text-xs text-slate-500 font-medium max-w-sm mt-2 leading-relaxed">Dana akumulasi Jasa Modal dan Jasa Anggota yang telah disahkan melalui RAT.</p>
                </div>

                <div class="flex items-center gap-4">
                    @if($statusSHU === 'Siap Diambil')
                    <button onclick="openSHUModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95">
                        Tarik Saldo
                    </button>
                    @else
                    <button @click="alert('SHU belum tersedia untuk tahun ini.')" class="group flex items-center gap-2 px-5 py-3.5 bg-slate-300 text-white font-bold rounded-2xl cursor-not-allowed">
                        Tarik Saldo
                    </button>
                    @endif
                    <div class="inline-flex items-center gap-1.5 px-4 py-1.5 {{ $statusSHU === 'Siap Diambil' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : ($statusSHU === 'Sudah Diambil' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-slate-50 text-slate-700 border-slate-100') }} text-[10px] font-black rounded-xl border uppercase tracking-wide">
                        <span class="w-1.5 h-1.5 {{ $statusSHU === 'Siap Diambil' ? 'bg-indigo-500 animate-pulse' : ($statusSHU === 'Sudah Diambil' ? 'bg-emerald-500' : 'bg-slate-400') }} rounded-full"></span>
                        Status: {{ $statusSHU }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Breakdown Singkat (Komponen SHU) --}}
    <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
        
        <div class="relative z-10 space-y-6">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">Komponen SHU</p>
                <div class="p-4 bg-slate-100 text-slate-600 rounded-2xl shadow-sm">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 003.055 11H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.495 20.954A8.995 8.995 0 0113 5v10l7 7a9.003 9.003 0 01-9.505-1.046z" />
                    </svg>
                </div>
            </div>
            
            <div class="space-y-5">
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider">
                        <span class="text-slate-400">Jasa Modal</span>
                        <span class="text-slate-800 bg-slate-50 px-2 py-0.5 rounded-lg">Rp {{ number_format($jasaModal) }}</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-indigo-500 h-full rounded-full transition-all duration-1000 group-hover:bg-indigo-600" style="width: {{ $jasaModalPercent }}%"></div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-wider">
                        <span class="text-slate-400">Jasa Anggota</span>
                        <span class="text-slate-800 bg-slate-50 px-2 py-0.5 rounded-lg">Rp {{ number_format($jasaAnggota) }}</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden p-0.5">
                        <div class="bg-sky-400 h-full rounded-full transition-all duration-1000 group-hover:bg-sky-500" style="width: {{ $jasaAnggotaPercent }}%"></div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-50">
                <div class="flex items-center justify-center gap-2 text-slate-400 text-[10px] font-black bg-slate-100/50 py-2 rounded-xl uppercase tracking-wider">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Disahkan: {{ $disahkanPada ?? '-' }}
                </div>
            </div>
        </div>
    </div>
</div>

        {{-- ================= Riwayat SHU Per Tahun ================= --}}
    <div x-data="{ expanded: null }" class="space-y-4 animate-slide-up">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Riwayat SHU Per Tahun</h2>
                <p class="text-sm text-slate-400 font-medium">{{ count($riwayatSHU) }} tahun tercatat</p>
            </div>
        </div>

        @forelse($riwayatSHU as $r)
        @php
            $statusColor = match($r['status']) {
                'Sudah Diambil' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'Dibagikan'     => 'bg-amber-50 text-amber-700 border-amber-200',
                default         => 'bg-slate-50 text-slate-600 border-slate-200',
            };
            $statusLabel = match($r['status']) {
                'Sudah Diambil' => 'Sudah Diambil',
                'Dibagikan'     => 'Belum Diambil',
                default         => 'Menunggu',
            };
            $dotColor = match($r['status']) {
                'Sudah Diambil' => 'bg-emerald-500',
                'Dibagikan'     => 'bg-amber-500',
                default         => 'bg-slate-400',
            };
        @endphp
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all duration-300"
             :class="expanded === {{ $loop->index }} ? 'shadow-lg ring-1 ring-slate-200' : 'hover:shadow-md'">
            <button type="button"
                @click="expanded = expanded === {{ $loop->index }} ? null : {{ $loop->index }}"
                class="w-full flex items-center justify-between p-6 text-left">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-sm shrink-0">{{ $r['tahun'] }}</div>
                    <div class="min-w-0">
                        <p class="font-black text-slate-800">SHU {{ $r['tahun'] }}</p>
                        <p class="text-[10px] font-bold text-slate-400 mt-0.5 tabular-nums">Rp {{ number_format($r['total_diterima']) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center gap-1.5 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 border {{ $statusColor }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                        {{ $statusLabel }}
                    </span>
                    <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 shrink-0"
                         :class="expanded === {{ $loop->index }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>

            <div x-show="expanded === {{ $loop->index }}" x-cloak
                 x-transition:enter="transition-all duration-300 ease-out"
                 x-transition:enter-start="opacity-0 max-h-0 overflow-hidden"
                 x-transition:enter-end="opacity-100 max-h-96"
                 class="border-t border-slate-50">
                <div class="p-6 bg-slate-50/30 space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Jasa Modal</p>
                            <p class="text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($r['jasa_modal']) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Jasa Anggota</p>
                            <p class="text-sm font-black text-slate-800 tabular-nums">Rp {{ number_format($r['jasa_anggota']) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Metode</p>
                            <p class="text-sm font-black text-slate-700">{{ $r['metode_penyaluran'] }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Status</p>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black border rounded-lg px-2 py-1 {{ $statusColor }}">{{ $r['status'] }}</span>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex justify-between items-center">
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Total Diterima</span>
                        <span class="text-base font-black text-indigo-600 tabular-nums">Rp {{ number_format($r['total_diterima']) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-16 text-center">
            <p class="font-bold text-slate-400 italic">Belum ada riwayat SHU.</p>
        </div>
        @endforelse
    </div>

    {{-- ================= Popup Modal Ambil SHU ================= --}}
    <div id="modalSHU" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10 border border-slate-100 relative overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">
            
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Opsi Penarikan</h3>
                    <button onclick="closeSHUModal()" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="mb-8 p-6 bg-indigo-50 rounded-3xl border border-indigo-100 text-center">
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Dana SHU Tersedia</p>
                    <p class="text-3xl font-black text-indigo-600 tabular-nums">Rp {{ number_format($totalSHU) }}</p>
                </div>

                <form action="{{ route('anggota.shu.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Pilih Metode Penyaluran</label>
                        <select name="distribution_method" x-model="metode" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500">
                            <option value="Simpanan Sukarela">Pindahkan ke Simpanan Sukarela</option>
                            <option value="Transfer Bank">Cairkan via Transfer Bank</option>
                            <option value="Tunai">Ambil Tunai di Kantor</option>
                        </select>
                    </div>

                    <div x-show="metode === 'Simpanan Sukarela'" class="bg-emerald-50 border border-emerald-100 p-4 rounded-2xl">
                        <p class="text-[10px] text-emerald-700 font-medium leading-relaxed">
                            Dana akan langsung masuk ke Simpanan Sukarela Anda tanpa perlu verifikasi pengurus dan mulai menghasilkan bunga efektif di bulan berikutnya.
                        </p>
                    </div>

                    <div x-show="metode === 'Transfer Bank'" class="bg-indigo-50 border border-indigo-100 p-4 rounded-2xl space-y-2">
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-2">Rekening Koperasi</p>
                        <p class="text-sm font-bold text-slate-700">{{ $bankName ?? 'Belum diatur' }}</p>
                        <p class="text-sm font-bold text-slate-700">{{ $bankAccountNumber ?? '-' }}</p>
                        <p class="text-sm font-bold text-slate-700">a.n. {{ $bankAccountName ?? '-' }}</p>
                        <div class="mt-2 pt-2 border-t border-indigo-200">
                            <p class="text-[10px] text-indigo-500 font-medium italic">
                                *Setelah transfer, konfirmasikan bukti transfer ke pengurus.
                            </p>
                        </div>
                    </div>

                    <div x-show="metode === 'Tunai'">
                        <div class="bg-amber-50 border border-amber-100 p-4 rounded-2xl">
                            <p class="text-[10px] text-amber-700 font-medium leading-relaxed">
                                Silakan datang langsung ke kantor koperasi dengan membawa kartu anggota untuk mengambil SHU secara tunai.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                        Konfirmasi Penarikan
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
function openSHUModal() {
    const modal = document.getElementById('modalSHU');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeSHUModal() {
    const modal = document.getElementById('modalSHU');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const modal = document.getElementById('modalSHU');
    if (!modal.classList.contains('hidden') && event.target === modal) {
        closeSHUModal();
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