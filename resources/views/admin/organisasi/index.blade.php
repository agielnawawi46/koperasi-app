@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div class="px-8 py-8 space-y-8 animate-fade-in">

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-4 text-emerald-700 text-sm font-bold shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border border-red-200 rounded-2xl px-6 py-4 text-red-600 text-sm font-bold shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Aturan & Prosedur</h1>
                <p class="text-slate-500 font-medium italic">Konfigurasi aktif yang mengendalikan logika sistem DanaKarya.</p>
            </div>
        </div>
        <div class="flex gap-3">
            <button onclick="openProfilModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-white text-slate-700 font-bold rounded-2xl border border-slate-200 shadow-sm hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span>Profil Koperasi</span>
            </button>
            <button onclick="openProsedurModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                <span>Prosedur Sistem</span>
            </button>
        </div>
    </div>

    {{-- LIVE DISPLAY (HASIL INPUTAN) --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- SEKTOR KIRI: PROFIL --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-full -z-0"></div>
                <div class="relative z-10">
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-full uppercase tracking-widest">Identitas Koperasi</span>
                    <h2 class="text-2xl font-black text-slate-800 mt-4 leading-tight">{{ $organisasi['nama'] ?? 'Belum Diisi' }}</h2>
                    <p class="text-blue-600 font-bold text-sm mt-1 underline decoration-blue-200 underline-offset-4">{{ $organisasi['perusahaan'] ?? 'Perusahaan Utama' }}</p>
                    
                    <div class="mt-8 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600">{{ $organisasi['email'] ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600 line-clamp-2">{{ $organisasi['alamat'] ?? '-' }}</span>
                        </div>
                        @if($organisasi['bank_name'])
                        <div class="pt-2 border-t border-slate-50">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Rekening Transfer</p>
                            <div class="text-xs font-bold text-slate-700 space-y-1">
                                <p>{{ $organisasi['bank_name'] }} - {{ $organisasi['bank_account_number'] ?? '-' }}</p>
                                <p class="text-slate-500">a/n {{ $organisasi['bank_account_name'] ?? '-' }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- SEKTOR KANAN: ATURAN LOGIKA --}}
        <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Prosedur Simpanan terintegrasi Auto-Payroll --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Logic: Auto-Payroll</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end border-b border-slate-50 pb-2">
                            <span class="text-sm font-bold text-slate-400">Setoran Pokok</span>
                            <span class="text-xl font-black text-slate-800">Rp {{ number_format($organisasi['pokok'] ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between items-end border-b border-slate-50 pb-2">
                            <span class="text-sm font-bold text-slate-400">Wajib (Potong Gaji)</span>
                            <span class="text-xl font-black text-rose-600">Rp {{ number_format($organisasi['wajib'] ?? 0) }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center gap-2">
                    <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></div>
                    <p class="text-xs font-bold text-slate-400">Sinkron Otomatis ke Slip Gaji Baru</p>
                </div>
            </div>

            {{-- Prosedur Pinjaman --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <span class="text-[10px] font-black text-amber-400 uppercase tracking-widest">Logic: Kredit</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end border-b border-slate-50 pb-2">
                            <span class="text-sm font-bold text-slate-400">Suku Bunga</span>
                            <span class="text-xl font-black text-slate-800">{{ $organisasi['bunga'] ?? '0' }}% <span class="text-xs text-slate-400">/ bln</span></span>
                        </div>
                        <div class="flex justify-between items-end border-b border-slate-50 pb-2">
                            <span class="text-sm font-bold text-slate-400">Metode Hitung</span>
                            <span class="text-sm font-black text-slate-800 uppercase italic">{{ $organisasi['metode'] ?? 'Belum Diatur' }}</span>
                        </div>
                    </div>
                </div>
                    <div class="mt-6 p-3 bg-slate-50 rounded-xl space-y-1">
                        <p class="text-[10px] font-bold text-slate-500">Metode Pembayaran: <span class="text-blue-600">{{ $organisasi['payment_method'] ?? 'Manual' }}</span></p>
                        @if($organisasi['payment_method'] === 'Potong Gaji')
                            <p class="text-[8px] font-bold text-emerald-600 italic">Otomatis potong gaji tiap tanggal {{ $organisasi['tgl_tagihan'] }}</p>
                        @else
                            <p class="text-[8px] font-bold text-amber-600 italic">Anggota bayar via transfer/bayar langsung tiap tanggal {{ $organisasi['tgl_tagihan'] }}</p>
                        @endif
                    </div>
            </div>

        </div>
    </div>

@push('modals')
    {{-- MODAL PROFIL KOPERASI --}}
    <div id="modalProfil" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl flex flex-col max-h-[90vh] transform transition-all duration-500 scale-95 translate-y-8">

            <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-800">Profil Koperasi</h2>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Informasi Identitas Resmi</p>
                    </div>
                </div>
                <button onclick="closeProfilModal()" class="p-2 hover:bg-rose-50 rounded-xl text-slate-300 hover:text-rose-500 transition-all">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ route('admin.organisasi.update') }}" method="POST" class="p-8 space-y-6 overflow-y-auto custom-scrollbar">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap Koperasi</label>
                    <input type="text" name="nama" value="{{ $organisasi['nama'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Koperasi ABC">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Perusahaan Naungan</label>
                        <input type="text" name="perusahaan" value="{{ $organisasi['perusahaan'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="PT. Maju Bersama">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email CS</label>
                        <input type="email" name="email" value="{{ $organisasi['email'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="cs@koperasi.com">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Kantor</label>
                    <textarea name="alamat" rows="2" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Jl. Contoh No. 123">{{ $organisasi['alamat'] ?? '' }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Telepon</label>
                        <input type="text" name="phone" value="{{ $organisasi['phone'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="021-12345678">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Website</label>
                        <input type="text" name="website" value="{{ $organisasi['website'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="www.koperasi.com">
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
                    <button type="button" onclick="closeProfilModal()" class="flex-1 py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 rounded-2xl">Batal</button>
                    <button type="submit" class="flex-[2] py-4 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all active:scale-95">Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('modals')
    {{-- MODAL PROSEDUR SISTEM --}}
    <div id="modalProsedur" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-3xl rounded-[2.5rem] shadow-2xl flex flex-col max-h-[90vh] transform transition-all duration-500 scale-95 translate-y-8">

            <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-800">Prosedur Sistem</h2>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aturan Keuangan & Metode Pembayaran</p>
                    </div>
                </div>
                <button onclick="closeProsedurModal()" class="p-2 hover:bg-rose-50 rounded-xl text-slate-300 hover:text-rose-500 transition-all">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ route('admin.organisasi.update') }}" method="POST" class="p-8 space-y-8 overflow-y-auto custom-scrollbar"
                  x-data="{ paymentMethod: '{{ $organisasi['payment_method'] ?? 'Transfer Manual' }}' }">
                @csrf
                @method('PUT')

                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Konfigurasi Simpanan</p>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Pokok (Rp)</label>
                            <input type="number" name="pokok" value="{{ $organisasi['pokok'] ?? '' }}" class="w-full p-4 bg-emerald-50/30 border border-emerald-100 rounded-2xl font-black text-emerald-700 outline-none focus:ring-2 focus:ring-emerald-500" placeholder="0">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Wajib (Rp)</label>
                            <input type="number" name="wajib" value="{{ $organisasi['wajib'] ?? '' }}" class="w-full p-4 bg-emerald-50/30 border border-emerald-100 rounded-2xl font-black text-emerald-700 outline-none focus:ring-2 focus:ring-emerald-500" placeholder="0">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Tgl Tagihan</label>
                            <select name="tgl_tagihan" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                                @for($i=1; $i<=28; $i++) <option value="{{ $i }}" {{ ($organisasi['tgl_tagihan'] ?? '') == $i ? 'selected' : '' }}>Tanggal {{ $i }}</option> @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Konfigurasi Pinjaman</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Bunga (%/bln)</label>
                            <input type="number" step="0.1" name="bunga" value="{{ $organisasi['bunga'] ?? '' }}" class="w-full p-4 bg-amber-50/30 border border-amber-100 rounded-2xl font-black text-amber-700 outline-none focus:ring-2 focus:ring-amber-500" placeholder="0">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Bunga</label>
                            <select name="metode" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                                <option value="Flat Rate" {{ ($organisasi['metode'] ?? '') == 'Flat Rate' ? 'selected' : '' }}>Flat Rate</option>
                                <option value="Efektif" {{ ($organisasi['metode'] ?? '') == 'Efektif' ? 'selected' : '' }}>Efektif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Metode Pembayaran</p>
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Pembayaran Utama</label>
                            <select name="payment_method" x-model="paymentMethod" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                                <option value="Potong Gaji">Potong Gaji Otomatis</option>
                                <option value="Transfer Manual">Transfer Manual</option>
                            </select>
                            <p class="text-[9px] text-slate-400 font-medium italic ml-1">
                                <span x-show="paymentMethod === 'Potong Gaji'">Sistem otomatis mengisi saldo wajib tiap tanggal tagihan.</span>
                                <span x-show="paymentMethod === 'Transfer Manual'">Sistem kirim pengingat, anggota transfer/bayar langsung ke pengurus.</span>
                            </p>
                        </div>
                        <div x-show="paymentMethod === 'Transfer Manual'" x-cloak x-transition:enter.duration.200ms class="border-t border-slate-100 pt-4">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Info Rekening Bank (Untuk Transfer)</p>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Bank</label>
                                    <input type="text" name="bank_name" value="{{ $organisasi['bank_name'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="BCA">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Atas Nama</label>
                                    <input type="text" name="bank_account_name" value="{{ $organisasi['bank_account_name'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Koperasi ABC">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">No. Rekening</label>
                                    <input type="text" name="bank_account_number" value="{{ $organisasi['bank_account_number'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
                    <button type="button" onclick="closeProsedurModal()" class="flex-1 py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 rounded-2xl">Batal</button>
                    <button type="submit" class="flex-[2] py-4 bg-emerald-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-200 transition-all active:scale-95">Simpan Prosedur</button>
                </div>
            </form>
        </div>
    </div>
@endpush
</div>

<script>
function openProfilModal() {
    const modal = document.getElementById('modalProfil');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeProfilModal() {
    const modal = document.getElementById('modalProfil');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const modal = document.getElementById('modalProfil');
    if (!modal.classList.contains('hidden') && event.target === modal) {
        closeProfilModal();
    }
});

function openProsedurModal() {
    const modal = document.getElementById('modalProsedur');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeProsedurModal() {
    const modal = document.getElementById('modalProsedur');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const modal = document.getElementById('modalProsedur');
    if (!modal.classList.contains('hidden') && event.target === modal) {
        closeProsedurModal();
    }
});
</script>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection