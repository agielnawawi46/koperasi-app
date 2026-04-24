@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="{ open: false, tab: 'profil' }" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8 animate-fade-in">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-slate-200">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Aturan & Prosedur</h1>
                <p class="text-slate-500 font-medium italic">Konfigurasi aktif yang mengendalikan logika sistem DanaKarya.</p>
            </div>
        </div>
        <button @click="open = true" class="group flex items-center gap-3 px-8 py-4 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-100 hover:bg-blue-700 transition-all active:scale-95">
            <span>Ubah Aturan</span>
            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
        </button>
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
                    </div>
                </div>
            </div>
        </div>

        {{-- SEKTOR KANAN: ATURAN LOGIKA --}}
        <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Prosedur Simpanan --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Logic: Simpanan</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end border-b border-slate-50 pb-2">
                            <span class="text-sm font-bold text-slate-400">Setoran Pokok</span>
                            <span class="text-xl font-black text-slate-800">Rp {{ number_format($organisasi['pokok'] ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between items-end border-b border-slate-50 pb-2">
                            <span class="text-sm font-bold text-slate-400">Wajib per Bulan</span>
                            <span class="text-xl font-black text-slate-800">Rp {{ number_format($organisasi['wajib'] ?? 0) }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center gap-2">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <p class="text-xs font-bold text-slate-400">Tagihan otomatis terbit tgl {{ $organisasi['tgl_tagihan'] ?? '1' }}</p>
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
                <div class="mt-6 p-3 bg-slate-50 rounded-xl">
                    <p class="text-[10px] font-bold text-slate-500">Metode Pembayaran: <span class="text-blue-600">{{ $organisasi['payment_method'] ?? 'Manual' }}</span></p>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL EDIT (SAMA SEPERTI SEBELUMNYA) --}}
    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md" x-cloak>
        <div @click.outside="open = false" class="bg-white w-full max-w-4xl rounded-[3rem] shadow-2xl overflow-hidden animate-slide-up">
            
            <div class="flex border-b border-slate-50 bg-slate-50/30">
                <button @click="tab = 'profil'" :class="tab === 'profil' ? 'bg-white text-blue-600 border-b-4 border-blue-600' : 'text-slate-400'" class="flex-1 py-6 font-black uppercase text-[10px] tracking-[0.2em] transition-all">1. Profil Koperasi</button>
                <button @click="tab = 'prosedur'" :class="tab === 'prosedur' ? 'bg-white text-blue-600 border-b-4 border-blue-600' : 'text-slate-400'" class="flex-1 py-6 font-black uppercase text-[10px] tracking-[0.2em] transition-all">2. Prosedur Sistem</button>
            </div>

            <form action="{{ route('organisasi.update') }}" method="POST" class="p-10 space-y-8">
                @csrf
                
                {{-- TAB 1: IDENTITAS --}}
                <div x-show="tab === 'profil'" class="grid grid-cols-2 gap-6 animate-fade-in">
                    <div class="col-span-2 space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap Koperasi</label>
                        <input type="text" name="nama" value="{{ $organisasi['nama'] ?? '' }}" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-bold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Perusahaan Naungan</label>
                        <input type="text" name="perusahaan" value="{{ $organisasi['perusahaan'] ?? '' }}" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none font-bold">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email CS</label>
                        <input type="email" name="email" value="{{ $organisasi['email'] ?? '' }}" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none font-bold">
                    </div>
                    <div class="col-span-2 space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Kantor</label>
                        <textarea name="alamat" rows="2" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none font-bold">{{ $organisasi['alamat'] ?? '' }}</textarea>
                    </div>
                </div>

                {{-- TAB 2: PROSEDUR --}}
                <div x-show="tab === 'prosedur'" class="space-y-8 animate-fade-in">
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Simpanan Pokok (Rp)</label>
                            <input type="number" name="pokok" value="{{ $organisasi['pokok'] ?? '' }}" class="w-full p-4 bg-emerald-50/30 border border-emerald-100 rounded-2xl font-black text-emerald-700 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Simpanan Wajib (Rp)</label>
                            <input type="number" name="wajib" value="{{ $organisasi['wajib'] ?? '' }}" class="w-full p-4 bg-emerald-50/30 border border-emerald-100 rounded-2xl font-black text-emerald-700 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Tgl Tagihan</label>
                            <select name="tgl_tagihan" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold">
                                @for($i=1; $i<=28; $i++) <option value="{{ $i }}" {{ ($organisasi['tgl_tagihan'] ?? '') == $i ? 'selected' : '' }}>Tanggal {{ $i }}</option> @endfor
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 pt-8 border-t border-slate-50">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Bunga Pinjaman (%)</label>
                            <input type="number" step="0.1" name="bunga" value="{{ $organisasi['bunga'] ?? '' }}" class="w-full p-4 bg-amber-50/30 border border-amber-100 rounded-2xl font-black text-amber-700 outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Bunga</label>
                            <select name="metode" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold">
                                <option value="Flat Rate" {{ ($organisasi['metode'] ?? '') == 'Flat Rate' ? 'selected' : '' }}>Flat Rate</option>
                                <option value="Efektif" {{ ($organisasi['metode'] ?? '') == 'Efektif' ? 'selected' : '' }}>Efektif</option>
                            </select>
                        </div>
                        <div class="col-span-2 space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Metode Pembayaran Utama</label>
                            <select name="payment_method" class="w-full p-4 bg-blue-50/30 border border-blue-100 rounded-2xl font-bold text-blue-700">
                                <option value="Potong Gaji" {{ ($organisasi['payment_method'] ?? '') == 'Potong Gaji' ? 'selected' : '' }}>Potong Gaji Otomatis</option>
                                <option value="Transfer Manual" {{ ($organisasi['payment_method'] ?? '') == 'Transfer Manual' ? 'selected' : '' }}>Transfer Manual</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6">
                    <button type="button" @click="open = false" class="flex-1 py-4 text-slate-400 font-bold uppercase text-xs tracking-widest">Batal</button>
                    <button type="submit" class="flex-[2] py-5 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-100 hover:bg-blue-700 transition-all">Simpan & Terapkan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    .animate-fade-in { animation: fadeIn 0.4s ease-out; }
    .animate-slide-up { animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>

@endsection