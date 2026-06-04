@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

{{-- Container utama harus 'relative' untuk posisi Floating Filter --}}
<div class="relative px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

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

    {{-- ================= LOAN TABLE ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up mt-8">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/50">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-600 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-blue-100 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Daftar Pengajuan & Pinjaman</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Manajemen transaksi pinjaman anggota.</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Peminjam</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Informasi Pinjaman</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                        <th class="px-8 py-5 text-right text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($pinjaman as $p)
                    <tr class="group hover:bg-amber-50/30 transition-all duration-300">
                        <td class="px-8 py-7">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:bg-amber-100 group-hover:text-amber-700 transition-all">{{ strtoupper(substr($p->user->name ?? '?', 0, 2)) }}</div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $p->user->name ?? 'Unknown' }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ $p->loan_number }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-7">
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-slate-700 tracking-tight">Rp {{ number_format($p->amount) }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ $p->tenure_months }} Bln | Bunga {{ $p->interest_rate }}%</span>
                            </div>
                        </td>
                        <td class="px-8 py-7 text-center">
                            @php
                                $statusColors = ['pending' => 'bg-amber-50 text-amber-600 border-amber-200/50', 'approved' => 'bg-blue-50 text-blue-600 border-blue-200/50', 'active' => 'bg-emerald-50 text-emerald-600 border-emerald-200/50', 'rejected' => 'bg-red-50 text-red-600 border-red-200/50', 'paid' => 'bg-slate-50 text-slate-600 border-slate-200/50'];
                                $statusLabels = ['pending' => 'Waiting', 'approved' => 'Disetujui', 'active' => 'Aktif', 'rejected' => 'Ditolak', 'paid' => 'Lunas'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 {{ $statusColors[$p->status] ?? 'bg-slate-50 text-slate-600' }} text-[10px] font-black rounded-xl border uppercase tracking-widest">
                                <span class="w-1.5 h-1.5 {{ $p->status === 'pending' ? 'bg-amber-500 animate-ping' : ($p->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400') }} rounded-full"></span>
                                {{ $statusLabels[$p->status] ?? ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-7 text-right">
                            @if($p->status === 'pending')
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('pengurus.kelpinjaman.approve', $p) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>
                                <form action="{{ route('pengurus.kelpinjaman.reject', $p) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                            </div>
                            @elseif($p->status === 'approved')
                            <form action="{{ route('pengurus.kelpinjaman.cairkan', $p) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2.5 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm text-[9px] font-black uppercase tracking-widest px-3">
                                    Cairkan
                                </button>
                            </form>
                            @else
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $p->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center font-bold text-slate-400 italic">Tidak ada data pinjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ================= MODAL INPUT MANUAL ================= --}}
<div id="modalInputPinjaman" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md transition-opacity duration-300 opacity-0 pointer-events-none">
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
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    }

    function closeModal() {
        const modal = document.getElementById('modalInputPinjaman');
        const content = modal.querySelector('div');
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0', 'pointer-events-none');
        content.classList.remove('scale-100', 'translate-y-0');
        content.classList.add('scale-95', 'translate-y-8');
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