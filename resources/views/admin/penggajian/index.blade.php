@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="payrollManager()" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-10">

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-100 font-black animate-fade-in flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Penggajian Karyawan</h1>
            <p class="text-slate-500 font-medium">Sistem otomatisasi gaji pokok dan potongan simpanan koperasi.</p>
        </div>

        <button @click="openModal()"
            class="group flex items-center gap-2 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
            </svg>
            Proses Gaji Baru
        </button>
    </div>

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Total Pengeluaran Gaji --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-slate-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-700 transition-colors">Total Pengeluaran Gaji</p>
                    <div class="p-4 bg-slate-100 text-slate-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">Rp {{ number_format($totalPengeluaran) }}</h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-slate-100/50 text-slate-700 border border-slate-200 uppercase tracking-widest">Total Keseluruhan</div>
                </div>
            </div>
        </div>

        {{-- Total Potongan Simpanan --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-rose-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-400/70 group-hover:text-rose-700 transition-colors">Total Potongan Dialokasikan</p>
                    <div class="p-4 bg-rose-100 text-rose-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-rose-600 tabular-nums">Rp {{ number_format($totalPotongan) }}</h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-rose-100/50 text-rose-700 border border-rose-200 uppercase tracking-widest">Auto-Sync Organisasi</div>
                </div>
            </div>
        </div>

        {{-- Periode Dinamis Terpilih --}}
        <div class="group relative bg-gradient-to-br from-blue-600 to-indigo-700 p-8 rounded-[2.5rem] shadow-xl shadow-blue-100 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[80px] -z-0"></div>
            <div class="relative z-10 space-y-6 text-white">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-100/80">Arsip Periode Terpilih</p>
                    <div class="p-4 bg-white/20 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black tracking-tight" x-text="namaBulan[filterBulan] + ' ' + filterTahun"></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-white/10 text-white border border-white/20 uppercase tracking-widest"
                         x-text="filterBulan === '05' && filterTahun === '2026' ? 'Status: Bulan Berjalan' : 'Status: Data Arsip'"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABLE DATA ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
        <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white to-slate-50/30">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-900 rounded-[1.3rem] flex items-center justify-center text-white shadow-xl shadow-slate-200 rotate-3 group hover:rotate-0 transition-transform duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Penggajian</h2>
                    <p class="text-sm text-slate-400 font-medium italic">Data penggajian berdasarkan filter periode dan posisi.</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                    <select x-model="globalFilterPosisi" class="bg-transparent font-bold text-slate-700 outline-none text-xs cursor-pointer py-0.5">
                        <option value="ALL">Semua Jabatan</option>
                        <option value="Staff">Staff Operasional</option>
                        <option value="Manajer">Manajer</option>
                    </select>
                </div>
                <div class="flex items-center bg-white px-3 py-2 rounded-xl border border-slate-200 shadow-sm gap-1">
                    <select x-model="filterBulan" class="bg-transparent font-bold text-slate-700 outline-none text-xs cursor-pointer py-0.5">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <span class="text-slate-300">|</span>
                    <select x-model="filterTahun" class="bg-transparent font-bold text-slate-700 outline-none text-xs cursor-pointer py-0.5">
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Karyawan</th>
                        <th class="px-8 py-5 text-right text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Gaji Pokok</th>
                        <th class="px-8 py-5 text-right text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Simpanan Wajib</th>
                        <th class="px-8 py-5 text-right text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Gaji Bersih</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Status</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($payrolls ?? [] as $payroll)
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300"
                        data-bulan="{{ str_pad((string)$payroll->period_month, 2, '0', STR_PAD_LEFT) }}"
                        data-tahun="{{ $payroll->period_year }}"
                        data-posisi="{{ $payroll->user->roles->first()?->name ?? 'Staff' }}"
                        x-show="matchPeriode($el)">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-300 shadow-sm">
                                    {{ strtoupper(substr($payroll->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $payroll->user->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $payroll->user->roles->first()?->name ?? 'Karyawan' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right font-bold text-slate-700 tabular-nums">Rp {{ number_format($payroll->base_salary) }}</td>
                        <td class="px-8 py-6 text-right font-bold text-rose-500">
                            - Rp {{ number_format($payroll->wajib_deduction) }}
                        </td>
                        <td class="px-8 py-6 text-right font-black text-emerald-600 tabular-nums">Rp {{ number_format($payroll->net_salary) }}</td>
                        <td class="px-8 py-6 text-center">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 text-[10px] font-black rounded-xl border uppercase tracking-wide
                                {{ $payroll->status === 'paid' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : ($payroll->status === 'processed' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-amber-50 text-amber-700 border-amber-100') }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $payroll->status === 'paid' ? 'bg-emerald-500' : ($payroll->status === 'processed' ? 'bg-blue-500' : 'bg-amber-500') }}"></span>
                                {{ ucfirst($payroll->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <button title="Cetak Slip Gaji" class="p-3 text-slate-600 bg-slate-50 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada data penggajian. Proses gaji baru untuk melihat data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= MODAL KALKULASI GAJI ================= --}}
    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-slate-900/60 backdrop-blur-md z-50 p-4" x-cloak>
        <div @click.outside="closeModal()" x-show="isModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0" class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-600 rounded-2xl text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-black text-2xl text-slate-800 tracking-tight">Kalkulasi Gaji</h2>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Data Otomatis Terintegrasi</p>
                    </div>
                </div>
                <button @click="closeModal()" class="p-2 hover:bg-rose-50 rounded-full text-slate-300 hover:text-rose-500 transition-all">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-10">
                <form action="{{ route('admin.payroll.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Filter Posisi Form</label>
                        <select x-model="selectedPosisiForm" @change="selectedKaryawan = ''; gaji = 0; simpanan = 0;" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="ALL">-- Tampilkan Semua Posisi --</option>
                            <option value="Staff">Staff Operasional</option>
                            <option value="Manajer">Manajer</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Karyawan</label>
                        <select name="karyawan_id" x-model="selectedKaryawan" @change="fetchDataKaryawan()" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="">-- Pilih Karyawan --</option>
                            <option value="1" data-gaji="5000000" data-posisi="Staff" x-show="selectedPosisiForm === 'ALL' || selectedPosisiForm === 'Staff'">Budi Santoso (Staff Operasional)</option>
                            <option value="2" data-gaji="7000000" data-posisi="Manajer" x-show="selectedPosisiForm === 'ALL' || selectedPosisiForm === 'Manajer'">Siti Aminah (Manajer Hubungan)</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4 p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black uppercase tracking-widest text-blue-500 ml-1">Gaji Pokok (Oto)</label>
                            <input type="number" name="gaji_pokok" x-model="gaji" readonly required class="w-full bg-slate-100 border-none rounded-2xl px-5 py-4 font-black text-slate-700 cursor-not-allowed">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black uppercase tracking-widest text-rose-500 ml-1">Potongan Koperasi</label>
                            <input type="number" name="potongan_simpanan" x-model="simpanan" readonly class="w-full bg-slate-100 border-none rounded-2xl px-5 py-4 font-black text-rose-600 cursor-not-allowed">
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-8 bg-blue-600 rounded-[2.5rem] text-white shadow-xl shadow-blue-100">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Gaji Bersih Diterima</p>
                            <p class="text-3xl font-black tracking-tight">Rp <span x-text="formatNumber(gajiBersih)"></span></p>
                            <input type="hidden" name="gaji_bersih" :value="gajiBersih">
                        </div>
                    </div>
                    <button type="submit" class="w-full py-5 bg-slate-900 text-white font-black rounded-2xl hover:bg-black transition-all active:scale-95 uppercase tracking-widest text-xs">Konfirmasi Pembayaran Gaji</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= ALPINE.JS CORE MANAGER ================= --}}
<script>
function payrollManager() {
    return {
        isModalOpen: false,
        selectedPosisiForm: 'ALL',
        selectedKaryawan: '',
        gaji: 0,
        simpanan: 0,
        aturanWajib: {{ $organisasi['wajib'] ?? 50000 }},

        // State default filter pembuka (Mei 2026)
        filterBulan: '05',
        filterTahun: '2026',
        globalFilterPosisi: 'ALL',

        namaBulan: {
            '01': 'Januari', '02': 'Februari', '03': 'Maret', '04': 'April',
            '05': 'Mei', '06': 'Juni', '07': 'Juli', '08': 'Agustus',
            '09': 'September', '10': 'Oktober', '11': 'November', '12': 'Desember'
        },

        matchPeriode(element) {
            const bln = element.getAttribute('data-bulan');
            const thn = element.getAttribute('data-tahun');
            const pos = element.getAttribute('data-posisi');
            
            const matchWaktu = (this.filterBulan === bln && this.filterTahun === thn);
            const matchPosisi = (this.globalFilterPosisi === 'ALL' || this.globalFilterPosisi === pos);
            
            return (matchWaktu && matchPosisi);
        },

        isTableEmpty() {
            const rows = document.querySelectorAll('tbody tr[data-bulan]');
            let visibleRows = 0;
            rows.forEach(row => {
                if (row.style.display !== 'none') visibleRows++;
            });
            return visibleRows === 0;
        },

        fetchDataKaryawan() {
            const selectEl = document.querySelector('select[name="karyawan_id"]');
            if(this.selectedKaryawan !== '' && selectEl.selectedIndex > 0) {
                this.simpanan = this.aturanWajib;
                const selectedOption = selectEl.options[selectEl.selectedIndex];
                this.gaji = Number(selectedOption.getAttribute('data-gaji'));
            } else {
                this.gaji = 0;
                this.simpanan = 0;
            }
        },

        openModal() { this.isModalOpen = true; },
        closeModal() { this.isModalOpen = false; this.resetForm(); },
        resetForm() { this.selectedPosisiForm = 'ALL'; this.selectedKaryawan = ''; this.gaji = 0; this.simpanan = 0; },
        get gajiBersih() { let res = this.gaji - this.simpanan; return res > 0 ? res : 0; },
        formatNumber(num) { return new Intl.NumberFormat('id-ID').format(num); }
    }
}
</script>

<style> 
    [x-cloak] { display: none !important; } 
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection