@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Input Angsuran</h1>
            </div>
            <p class="text-slate-500 font-medium ml-1">Pencatatan pembayaran cicilan dan pelunasan anggota.</p>
        </div>
        <div class="flex items-center gap-3">
            {{-- Tombol Excel --}}
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl shadow-sm hover:border-green-500 hover:text-green-600 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-50 group-hover:bg-green-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                Export Excel
            </button>
            
            {{-- Tombol PDF --}}
            <button class="group flex items-center gap-2 px-5 py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-xl shadow-slate-200 hover:bg-slate-900 transition-all active:scale-95">
                <div class="p-1.5 bg-slate-700 group-hover:bg-red-500 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                </div>
                Cetak PDF
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- ================= KIRI: FORM INPUT ================= --}}
        <div class="lg:col-span-7 space-y-8">
            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-10 space-y-8">
                    <div class="flex items-center gap-4 border-b border-slate-50 pb-8">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 transition-colors duration-500" id="iconBox">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800" id="formTitle">Cari Data Pinjaman</h2>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1" id="formSubtitle">Pilih anggota untuk memuat informasi</p>
                        </div>
                    </div>

                    <form action="{{ route('pengurus.inpangsuran.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @csrf
                        {{-- Search Anggota --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Anggota / ID Pinjaman</label>
                            <div class="relative group">
                                <select name="loan_id" onchange="activateForm(this)" class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-0 transition-all cursor-pointer appearance-none">
                                    <option value="">Pilih Anggota Aktif...</option>
                                    @foreach($pinjamanAktif as $p)
                                    <option value="{{ $p->id }}" data-loan='@json($p->load("installments"))'>{{ $p->loan_number }} | {{ $p->user->name ?? 'Unknown' }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Section yang akan di-unlock --}}
                        <div class="opacity-20 pointer-events-none space-y-2 transition-all duration-700" id="inputSet1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Angsuran Ke-</label>
                            <input type="text" id="angsuranKe" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" readonly>
                        </div>

                        <div class="opacity-20 pointer-events-none space-y-2 transition-all duration-700" id="inputSet2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Metode Bayar</label>
                            <select name="payment_method" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none">
                                <option>Transfer Bank</option>
                                <option>Potong Gaji</option>
                                <option>Tunai</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 opacity-20 pointer-events-none space-y-2 transition-all duration-700" id="inputSet3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nominal Setoran (Rp)</label>
                            <div class="relative">
                                <input type="number" name="amount" id="jumlahSetoran" class="w-full bg-slate-50 border-none rounded-2xl px-14 py-5 text-xl font-black text-slate-800 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="0">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 font-black text-slate-400">Rp</span>
                            </div>
                        </div>

                        <div class="md:col-span-2 opacity-20 pointer-events-none transition-all duration-700" id="submitAction">
                            <button disabled class="w-full py-5 bg-slate-200 text-slate-400 font-black text-[11px] uppercase tracking-[0.3em] rounded-2xl cursor-not-allowed transition-all">
                                Menunggu Data Anggota...
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= KANAN: PREVIEW CARD (DYNAMIC) ================= --}}
        <div class="lg:col-span-5" id="previewContainer">
            {{-- Initial Empty State --}}
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
        </div>

    </div>
</div>

{{-- ================= LOGIC JAVASCRIPT ================= --}}
<script>
    function activateForm(select) {
        const isSelected = select.value !== "";
        const loanId = select.value;
        
        const iconBox = document.getElementById('iconBox');
        const formTitle = document.getElementById('formTitle');
        const formSubtitle = document.getElementById('formSubtitle');
        const previewContainer = document.getElementById('previewContainer');
        const angsuranKe = document.getElementById('angsuranKe');
        const jumlahSetoran = document.getElementById('jumlahSetoran');
        
        const inputs = ['inputSet1', 'inputSet2', 'inputSet3', 'submitAction'];

        if (isSelected) {
            fetch('/pengurus/inpangsuran/data/' + loanId)
                .then(res => res.json())
                .then(data => {
                    iconBox.classList.replace('bg-slate-100', 'bg-slate-900');
                    iconBox.classList.replace('text-slate-400', 'text-white');
                    formTitle.innerText = "Lengkapi Pembayaran";
                    formSubtitle.innerText = "Masukkan detail nominal dan metode bayar";

                    inputs.forEach(id => {
                        const el = document.getElementById(id);
                        el.classList.remove('opacity-20', 'pointer-events-none');
                        if(id === 'submitAction') {
                            el.innerHTML = `
                                <button type="submit" class="w-full py-5 bg-slate-900 text-white font-black text-[11px] uppercase tracking-[0.3em] rounded-2xl shadow-2xl shadow-slate-200 hover:bg-emerald-600 hover:shadow-emerald-100 transition-all active:scale-[0.98]">
                                    Konfirmasi & Simpan Angsuran
                                </button>`;
                        }
                    });

                    angsuranKe.value = 'Angsuran ke-' + (data.angsuran_ke || '-');
                    jumlahSetoran.value = data.jumlah_setoran || 0;

                    previewContainer.innerHTML = `
                        <div class="space-y-8 animate-slide-up">
                            <div class="bg-blue-600 rounded-[3rem] p-10 text-white shadow-xl shadow-blue-100 relative overflow-hidden group">
                                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
                                <div class="relative z-10 space-y-8">
                                    <div class="flex justify-between items-start">
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200">Informasi Saldo</p>
                                            <h3 class="text-xl font-bold">${data.nama}</h3>
                                        </div>
                                        <div class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-xl text-[10px] font-black border border-white/20 uppercase tracking-widest">${data.no_pinjaman}</div>
                                    </div>
                                    <div>
                                        <p class="text-4xl font-black tabular-nums tracking-tight">Rp ${Number(data.sisa_pinjaman).toLocaleString('id-ID')}</p>
                                        <p class="text-xs font-medium text-blue-100 mt-2 italic">Sisa ${data.sisa_angsuran} kali angsuran lagi</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-6 pt-4 border-t border-white/10">
                                        <div>
                                            <p class="text-[9px] font-black uppercase tracking-widest text-blue-200">Terakhir Bayar</p>
                                            <p class="text-sm font-bold uppercase tracking-tight">${data.terakhir_bayar || '-'}</p>
                                        </div>
                                        <div>
                                            <p class="text-[9px] font-black uppercase tracking-widest text-blue-200">Jatuh Tempo</p>
                                            <p class="text-sm font-bold uppercase tracking-tight">${data.jatuh_tempo || '-'}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-amber-50 rounded-[2.5rem] p-8 border border-amber-100 flex gap-5 items-center">
                                <div class="w-12 h-12 bg-amber-500 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                </div>
                                <p class="text-xs font-bold text-amber-800 leading-relaxed italic">
                                    Verifikasi bukti transfer sebelum menyimpan data transaksi.
                                </p>
                            </div>
                        </div>
                    `;
                });
        }
    }
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection