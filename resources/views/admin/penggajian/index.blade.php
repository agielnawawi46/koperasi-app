@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="payrollManager()" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-10">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Penggajian Karyawan</h1>
            <div class="flex items-center gap-2 text-slate-500 font-medium">
                <span class="flex h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                <p>Potongan simpanan dikunci sesuai Aturan Organisasi.</p>
            </div>
        </div>

        <button @click="openModal()"
            class="group inline-flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl shadow-xl shadow-blue-200 font-black transition-all active:scale-95">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
            </svg>
            Proses Gaji Baru
        </button>
    </div>

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Total Pengeluaran --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-[80px] -z-0"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Total Pengeluaran</p>
                    <div class="p-3 bg-slate-100 text-slate-600 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Rp 125.4M</h2>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-full w-fit">Bulan April</div>
            </div>
        </div>

        {{-- Total Potongan Simpanan --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[80px] -z-0"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.25em] text-rose-400/70">Total Potongan</p>
                    <div class="p-3 bg-rose-100 text-rose-600 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-rose-600 tracking-tight">Rp 12.2M</h2>
                <div class="text-[10px] font-black text-rose-600 uppercase tracking-widest bg-rose-50 px-3 py-1 rounded-full w-fit">Auto-Sync Organisasi</div>
            </div>
        </div>

        {{-- Periode --}}
        <div class="bg-blue-600 p-8 rounded-[2.5rem] shadow-xl shadow-blue-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[80px] -z-0"></div>
            <div class="relative z-10 space-y-6 text-white">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.25em] text-blue-100/80">Periode</p>
                    <div class="p-3 bg-white/20 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                </div>
                <h2 class="text-3xl font-black tracking-tight">April 2026</h2>
                <div class="text-[10px] font-black uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full w-fit border border-white/20">Status Aktif</div>
            </div>
        </div>
    </div>

    {{-- ================= TABLE DATA ================= --}}
    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Karyawan</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Gaji Pokok</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Simpanan (Auto)</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Gaji Bersih</th>
                        <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center font-black shadow-lg shadow-blue-100">BS</div>
                                <div>
                                    <p class="font-bold text-slate-800">Budi Santoso</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Staff Operasional</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6 text-right font-bold text-slate-700">Rp 5.000.000</td>
                        <td class="px-6 py-6 text-right font-bold text-rose-500">
                            <span class="text-[9px] block text-slate-300 uppercase mb-0.5 italic">Mandatory</span>
                            - Rp {{ number_format($organisasi['wajib'] ?? 50000) }}
                        </td>
                        <td class="px-6 py-6 text-right">
                            <span class="px-5 py-2.5 bg-emerald-50 text-emerald-600 rounded-2xl font-black text-sm border border-emerald-100">
                                Rp 4.950.000
                            </span>
                        </td>
                        <td class="px-10 py-6 text-center">
                            <button class="p-3 text-slate-300 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= MODAL ================= --}}
    <div x-show="isModalOpen" 
         class="fixed inset-0 flex items-center justify-center bg-slate-900/60 backdrop-blur-md z-50 p-4"
         x-cloak>
        <div @click.outside="closeModal()"
             x-show="isModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden">
            
            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-600 rounded-2xl text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-black text-2xl text-slate-800 tracking-tight">Kalkulasi Gaji</h2>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Sesuai Aturan Organisasi</p>
                    </div>
                </div>
                <button @click="closeModal()" class="p-2 hover:bg-rose-50 rounded-full text-slate-300 hover:text-rose-500 transition-all">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-10">
                <form @submit.prevent="savePayroll()" class="space-y-6">
                    {{-- PILIH KARYAWAN --}}
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Karyawan</label>
                        <select x-model="selectedKaryawan" @change="fetchAturanOrganisasi()" 
                                class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-blue-500 outline-none font-bold text-slate-700">
                            <option value="">-- Pilih Karyawan --</option>
                            <option value="Budi">Budi Santoso</option>
                            <option value="Siti">Siti Aminah</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100">
                        {{-- GAJI POKOK (INPUT MANUAL) --}}
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black uppercase tracking-widest text-blue-400 ml-1">Gaji Pokok</label>
                            <input type="number" x-model="gaji" class="w-full p-3 bg-white border border-slate-200 rounded-xl focus:border-blue-500 outline-none font-bold text-slate-700">
                        </div>

                        {{-- SIMPANAN (OTOMATIS & READONLY) --}}
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black uppercase tracking-widest text-rose-400 ml-1">Simpanan (Auto)</label>
                            <div class="relative">
                                <input type="number" x-model="simpanan" readonly 
                                    class="w-full p-3 bg-slate-100 border border-rose-100 rounded-xl font-black text-rose-600 outline-none cursor-not-allowed">
                                <div class="absolute right-3 top-3 text-rose-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- GAJI BERSIH DISPLAY --}}
                    <div class="flex items-center justify-between p-8 bg-blue-600 rounded-[2.5rem] text-white shadow-xl shadow-blue-100">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Gaji Bersih</p>
                            <p class="text-3xl font-black tracking-tight">Rp <span x-text="formatNumber(gajiBersih)"></span></p>
                        </div>
                        <svg class="w-10 h-10 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    </div>

                    <button type="submit" class="w-full py-5 bg-slate-900 text-white font-black rounded-2xl hover:bg-black transition-all active:scale-95 shadow-lg shadow-slate-200 uppercase tracking-widest text-xs">
                        Konfirmasi Pembayaran Gaji
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function payrollManager() {
    return {
        isModalOpen: false,
        selectedKaryawan: '',
        gaji: 0,
        simpanan: 0,
        
        // Aturan Organisasi (Ditarik dari database Laravel)
        aturanWajib: {{ $organisasi['wajib'] ?? 50000 }},

        fetchAturanOrganisasi() {
            if(this.selectedKaryawan !== '') {
                // Di sini sistem secara cerdas mengisi simpanan dari aturan organisasi
                this.simpanan = this.aturanWajib;
            } else {
                this.simpanan = 0;
            }
        },

        openModal() { this.isModalOpen = true; },
        closeModal() { 
            this.isModalOpen = false; 
            this.resetForm(); 
        },
        resetForm() { 
            this.selectedKaryawan = '';
            this.gaji = 0; 
            this.simpanan = 0; 
        },
        get gajiBersih() { 
            let res = Number(this.gaji) - Number(this.simpanan);
            return res > 0 ? res : 0; 
        },
        formatNumber(num) { 
            return new Intl.NumberFormat('id-ID').format(num); 
        },
        savePayroll() { 
            alert('Gaji untuk ' + this.selectedKaryawan + ' Berhasil Diproses & Simpanan Wajib Telah Dipotong Otomatis!'); 
            this.closeModal(); 
        }
    }
}
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection