@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 space-y-8 animate-fade-in"
     x-data="inpangsuranApp()">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Data Angsuran Anggota</h1>
                <span x-show="loading"
                      class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 text-[10px] font-black rounded-xl border border-blue-100">
                    <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2.5" d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    Memuat Data...
                </span>
            </div>
            <p class="text-slate-500 font-medium ml-1">Cari dan lihat data angsuran anggota secara lengkap.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        {{-- ================= KIRI: DATA ANGSURAN ================= --}}
        <div class="lg:col-span-7 space-y-8">
            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100">
                <div class="p-10 space-y-8">
                    <div class="flex items-center gap-4 border-b border-slate-50 pb-8">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-500"
                             :class="selectedLoanId ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-400'">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800" x-text="selectedLoanId ? 'Detail Angsuran' : 'Cari Data Pinjaman'"></h2>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1" x-text="selectedLoanId ? 'Informasi angsuran dan sisa pinjaman anggota' : 'Pilih anggota untuk melihat data angsuran'"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- Search Anggota --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Anggota / ID Pinjaman</label>
                            <div class="relative">
                                <div class="relative">
                                    <input type="text" x-model="searchQuery" @input="selectedLoanId = ''; loanData = null"
                                           placeholder="Cari anggota atau nomor pinjaman..."
                                           class="w-full bg-slate-50 border-2 border-transparent rounded-2xl pl-6 pr-12 py-4 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-0 transition-all">
                                    <svg class="absolute right-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>

                                <div x-show="searchQuery.length > 0 && !selectedLoanId"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="absolute z-50 mt-2 w-full bg-white rounded-2xl shadow-xl border border-slate-100 max-h-64 overflow-y-auto">
                                    <template x-for="loan in filteredLoans" :key="loan.id">
                                        <button type="button" @click="selectLoan(loan)"
                                                class="w-full flex items-center gap-4 px-6 py-4 text-left hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-black text-slate-800" x-text="loan.user.name"></p>
                                                <p class="text-[10px] font-bold text-slate-400 mt-0.5" x-text="loan.loan_number + ' · Rp ' + Number(loan.amount).toLocaleString('id-ID')"></p>
                                            </div>
                                            <div class="ml-auto shrink-0">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 text-[9px] font-black rounded-lg border border-blue-100">
                                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                                    <span x-text="loan.status === 'active' ? 'Aktif' : (loan.status === 'ready_for_disbursement' ? 'Siap Cair' : 'Disetujui')"></span>
                                                </span>
                                            </div>
                                        </button>
                                    </template>
                                    <div x-show="filteredLoans.length === 0"
                                         class="px-6 py-8 text-center text-sm font-bold text-slate-400 italic">
                                        Tidak ditemukan anggota dengan kata kunci "<span x-text="searchQuery"></span>"
                                    </div>
                                </div>
                            </div>

                            <div x-show="selectedLoanId && loanData"
                                 x-transition:enter="transition ease-out duration-300"
                                 class="flex items-center gap-3 px-4 py-3 bg-blue-50 rounded-2xl border border-blue-100 mt-3">
                                <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-black text-slate-800 truncate" x-text="loanData.nama"></p>
                                    <p class="text-[10px] font-bold text-slate-500" x-text="loanData.no_pinjaman + ' · Angsuran ke-' + loanData.angsuran_ke + ' dari ' + loanData.total_angsuran"></p>
                                </div>
                                <button type="button" @click="resetForm()" class="text-slate-400 hover:text-rose-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Ringkasan Info --}}
                        <template x-if="selectedLoanId && loanData">
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-slate-50 rounded-2xl p-5 space-y-1">
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Angsuran Ke-</p>
                                    <p class="text-lg font-black text-slate-800 tabular-nums" x-text="loanData.angsuran_ke || '-'"></p>
                                </div>
                                <div class="bg-slate-50 rounded-2xl p-5 space-y-1">
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Tagihan</p>
                                    <p class="text-lg font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(loanData.jumlah_setoran).toLocaleString('id-ID')"></p>
                                </div>
                                <div class="bg-slate-50 rounded-2xl p-5 space-y-1">
                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Progres</p>
                                    <p class="text-lg font-black text-slate-800 tabular-nums" x-text="loanData.terbayar + '/' + loanData.total_angsuran"></p>
                                </div>
                            </div>
                        </template>

                        {{-- Riwayat Pembayaran --}}
                        <template x-if="selectedLoanId && loanData">
                            <div class="md:col-span-2 space-y-3">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Riwayat Pembayaran</p>
                                <div class="bg-slate-50 rounded-2xl p-5 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Terakhir Bayar</p>
                                            <p class="text-sm font-bold text-slate-800" x-text="loanData.terakhir_bayar || 'Belum ada'"></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jatuh Tempo</p>
                                        <p class="text-sm font-bold text-slate-800" x-text="loanData.jatuh_tempo || '-'"></p>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
        </div>

        {{-- ================= KANAN: PREVIEW CARD ================= --}}
        <div class="lg:col-span-5">
            <template x-if="!selectedLoanId || !loanData">
                <div class="bg-white rounded-[3rem] p-12 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center space-y-6 min-h-[450px]">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center relative">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" /></svg>
                        <div class="absolute inset-0 border-4 border-blue-500/10 rounded-full animate-ping"></div>
                    </div>
                    <div class="max-w-[220px]">
                        <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest">Pilih Data</h4>
                        <p class="text-xs text-slate-400 mt-2 leading-relaxed">Cari anggota terlebih dahulu untuk melihat histori dan sisa pinjaman secara akurat.</p>
                    </div>
                </div>
            </template>

            <template x-if="selectedLoanId && loanData">
                <div class="space-y-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">

                    <div class="bg-blue-600 rounded-[3rem] p-10 text-white shadow-xl shadow-blue-100 relative overflow-hidden group">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
                        <div class="relative z-10 space-y-8">
                            <div class="flex justify-between items-start">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200">Informasi Pinjaman</p>
                                    <h3 class="text-xl font-bold" x-text="loanData.nama"></h3>
                                </div>
                                <div class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-xl text-[10px] font-black border border-white/20 uppercase tracking-widest" x-text="loanData.no_pinjaman"></div>
                            </div>
                            <div>
                                <p class="text-4xl font-black tabular-nums tracking-tight" x-text="'Rp ' + Number(loanData.sisa_pinjaman).toLocaleString('id-ID')"></p>
                                <p class="text-xs font-medium text-blue-100 mt-2 italic" x-text="'Sisa ' + loanData.sisa_angsuran + ' kali angsuran lagi'"></p>
                            </div>
                            <div class="grid grid-cols-2 gap-6 pt-4 border-t border-white/10">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-blue-200">Terakhir Bayar</p>
                                    <p class="text-sm font-bold uppercase tracking-tight" x-text="loanData.terakhir_bayar || '-'"></p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-widest text-blue-200">Jatuh Tempo</p>
                                    <p class="text-sm font-bold uppercase tracking-tight" x-text="loanData.jatuh_tempo || '-'"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 space-y-5">
                        <div class="flex items-center justify-between">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Ringkasan Transaksi</p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 text-[9px] font-black rounded-lg border border-blue-100">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                <span x-text="'Angsuran ke-' + loanData.angsuran_ke + ' dari ' + loanData.total_angsuran"></span>
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 rounded-2xl p-5">
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tagihan</p>
                                <p class="text-xl font-black text-slate-800 tabular-nums" x-text="'Rp ' + Number(loanData.jumlah_setoran).toLocaleString('id-ID')"></p>
                            </div>
                            <div class="bg-slate-50 rounded-2xl p-5">
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Progres</p>
                                <p class="text-xl font-black text-slate-800 tabular-nums" x-text="loanData.terbayar + '/' + loanData.total_angsuran"></p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-[10px] font-bold text-slate-400">
                                <span>Progres Pelunasan</span>
                                <span x-text="Math.round((loanData.terbayar / loanData.total_angsuran) * 100) + '%'"></span>
                            </div>
                            <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden p-0.5">
                                <div class="h-full bg-emerald-500 rounded-full transition-all duration-1000"
                                     :style="'width: ' + (loanData.terbayar / loanData.total_angsuran * 100) + '%'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>
</div>

{{-- ================= ALPINE.JS APP ================= --}}
<script>
function inpangsuranApp() {
    return {
        searchQuery: '',
        selectedLoanId: '',
        loanData: null,
        loading: false,
        loans: @json($loanList),

        get filteredLoans() {
            if (!this.searchQuery) return [];
            const q = this.searchQuery.toLowerCase();
            return this.loans.filter(l =>
                l.user.name.toLowerCase().includes(q) ||
                l.loan_number.toLowerCase().includes(q)
            ).slice(0, 10);
        },

        selectLoan(loan) {
            this.selectedLoanId = loan.id;
            this.searchQuery = loan.user.name + ' (' + loan.loan_number + ')';
            this.loadLoanData(loan.id);
        },

        async loadLoanData(loanId) {
            this.loading = true;
            try {
                const res = await fetch('/pengurus/inpangsuran/data/' + loanId);
                const data = await res.json();
                this.loanData = data;
            } catch (e) {
                alert('Gagal memuat data pinjaman');
            } finally {
                this.loading = false;
            }
        },

        resetForm() {
            this.selectedLoanId = '';
            this.loanData = null;
            this.searchQuery = '';
        },
    };
}
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection
