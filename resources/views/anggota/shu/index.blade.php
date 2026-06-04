@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
{{-- Tambahkan x-data untuk kontrol popup --}}
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in" x-data="{ openModal: false }">

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
                    <button @click="openModal = true" class="group flex items-center gap-2 px-5 py-3.5 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95">
                        Ambil / Tarik SHU
                    </button>
                    @elseif($statusSHU === 'Sudah Diambil')
                    <div class="flex items-center gap-2 px-5 py-3.5 bg-emerald-50 text-emerald-700 font-bold rounded-2xl border border-emerald-100">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                        Sudah Diambil
                    </div>
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

        {{-- ================= Riwayat SHU Pertahun ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat SHU Per Tahun</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Perbandingan perolehan SHU Anda 3 tahun terakhir</p>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Tahun Buku</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Jasa Modal</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Jasa Anggota</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Total Diterima</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Metode</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($riwayatSHU as $r)
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-7 text-sm font-black text-slate-800">{{ $r['tahun'] }}</td>
                        <td class="px-8 py-7 text-sm text-slate-600 font-medium tabular-nums">Rp {{ number_format($r['jasa_modal']) }}</td>
                        <td class="px-8 py-7 text-sm text-slate-600 font-medium tabular-nums">Rp {{ number_format($r['jasa_anggota']) }}</td>
                        <td class="px-8 py-7 text-sm font-black tabular-nums {{ $r['status'] === 'Dibagikan' ? 'text-indigo-600' : 'text-slate-800' }}">Rp {{ number_format($r['total_diterima']) }}</td>
                        <td class="px-8 py-7 text-center">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-50 text-slate-600 text-[10px] font-black rounded-xl border border-slate-100 uppercase tracking-wide">{{ $r['metode_penyaluran'] }}</span>
                        </td>
                        <td class="px-8 py-7 text-center">
                            @if($r['status'] === 'Dibagikan')
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-black rounded-xl border border-amber-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                Belum Diambil
                            </span>
                            @elseif($r['status'] === 'Sudah Diambil')
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                Sudah Diambil
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-50 text-slate-600 text-[10px] font-black rounded-xl border border-slate-100 uppercase tracking-wide">
                                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                Menunggu
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada riwayat SHU.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= Popup Modal Ambil SHU ================= --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
        
        <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10 border border-slate-100 relative overflow-hidden"
             @click.away="openModal = false">
            
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight">Opsi Penarikan</h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
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
                        <select name="distribution_method" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500">
                            <option value="Simpanan Sukarela">Pindahkan ke Simpanan Sukarela</option>
                            <option value="Transfer Bank">Cairkan via Transfer Bank</option>
                            <option value="Tunai">Ambil Tunai di Kantor</option>
                        </select>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl">
                        <p class="text-[10px] text-slate-500 font-medium leading-relaxed italic">
                            *Jika memilih Simpanan Sukarela, dana akan langsung menambah saldo aset Anda dan mulai menghasilkan bunga efektif di bulan berikutnya.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                        Konfirmasi Penarikan
                    </button>
                </form>
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