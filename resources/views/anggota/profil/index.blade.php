@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.anggota')
@endsection

@section('content')
<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ activeTab: 'profil', isEditing: false }">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Profil Anggota</h1>
            <p class="text-slate-500 mt-1 font-medium">Kelola informasi pribadi dan keamanan akun Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-sm font-bold border border-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Anggota Aktif
            </span>
        </div>
    </div>

    {{-- ================= TABS NAVIGATION ================= --}}
    <div class="flex gap-4 border-b border-slate-200">
        <button @click="activeTab = 'profil'" :class="activeTab === 'profil' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-400 hover:text-slate-600'" class="pb-4 px-2 font-black text-sm uppercase tracking-widest border-b-2 transition-colors">
            Data Pribadi
        </button>
        <button @click="activeTab = 'keamanan'" :class="activeTab === 'keamanan' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-400 hover:text-slate-600'" class="pb-4 px-2 font-black text-sm uppercase tracking-widest border-b-2 transition-colors">
            Keamanan Akun
        </button>
    </div>

    {{-- ================= TAB: PROFIL ================= --}}
    <div x-show="activeTab === 'profil'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
        
        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-48 h-48 bg-blue-50 rounded-bl-[120px] -z-0 transition-transform duration-500 group-hover:scale-110"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row gap-12">
                
                {{-- Foto Profil --}}
                <div class="flex flex-col items-center gap-4">
                    <div class="w-40 h-40 rounded-[2rem] bg-slate-100 border-4 border-white shadow-xl shadow-slate-200/50 flex items-center justify-center font-black text-6xl text-slate-300 relative group-hover:border-blue-50 transition-all overflow-hidden">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm cursor-pointer">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                    </div>
                </div>

                {{-- Form Identitas --}}
                <div class="flex-1 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-black text-slate-800 tracking-tight">Informasi Dasar</h2>
                        <button @click="isEditing = !isEditing" class="px-5 py-2.5 bg-blue-50 text-blue-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                            <span x-text="isEditing ? 'Batal Edit' : 'Edit Profil'"></span>
                        </button>
                    </div>

                    <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap</label>
                            <input type="text" :disabled="!isEditing" value="{{ auth()->user()->name ?? 'Budi Santoso' }}" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 disabled:opacity-70 disabled:cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Email</label>
                            <input type="email" :disabled="!isEditing" value="{{ auth()->user()->email ?? 'budi@mail.com' }}" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 disabled:opacity-70 disabled:cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nomor Telepon</label>
                            <input type="text" :disabled="!isEditing" value="081234567890" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 disabled:opacity-70 disabled:cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nomor KTP (NIK)</label>
                            <input type="text" disabled value="3271123456789012" class="w-full p-4 bg-slate-100 border border-slate-200 rounded-2xl text-slate-500 outline-none font-bold opacity-70 cursor-not-allowed">
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Domisili</label>
                            <textarea :disabled="!isEditing" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 disabled:opacity-70 disabled:cursor-not-allowed min-h-[100px]">Jl. Merdeka No.45, Jakarta Pusat</textarea>
                        </div>
                        
                        <div class="md:col-span-2 flex justify-end mt-4" x-show="isEditing" x-transition>
                            <button type="submit" class="px-8 py-4 bg-blue-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 hover:-translate-y-1">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TAB: KEAMANAN ================= --}}
    <div x-show="activeTab === 'keamanan'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8" style="display: none;">
        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden">
            <div class="max-w-2xl">
                <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Ubah Kata Sandi</h2>
                <p class="text-sm text-slate-500 font-medium mb-8">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                
                <form class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Kata Sandi Saat Ini</label>
                        <input type="password" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-bold text-slate-700" placeholder="••••••••">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Kata Sandi Baru</label>
                        <input type="password" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-bold text-slate-700" placeholder="••••••••">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-bold text-slate-700" placeholder="••••••••">
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="px-8 py-4 bg-slate-900 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 hover:-translate-y-1">
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
