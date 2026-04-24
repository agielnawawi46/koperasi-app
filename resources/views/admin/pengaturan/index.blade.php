@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

@php
    // SIMULASI DATA USER LOGIN
    $user = [
        'nama' => 'Ahmad Administrator',
        'email' => 'ahmad@danakarya.id',
        'role' => 'Administrator',
        'telepon' => '0812-3456-7890',
        'last_login' => '19 April 2026, 14:20 WIB',
    ];
@endphp

<div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8" x-data="{ tab: 'profil', openEdit: false }">
    
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pengaturan Akun</h1>
                <p class="text-slate-500 font-medium">Informasi personal dan keamanan akun Anda.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- MENU KIRI --}}
        <div class="lg:col-span-1 space-y-2">
            <button @click="tab = 'profil'" :class="tab === 'profil' ? 'bg-blue-600 text-white shadow-blue-200' : 'bg-white text-slate-600'" class="w-full flex items-center gap-3 px-5 py-4 rounded-2xl font-bold transition-all shadow-sm border border-slate-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Profil Saya
            </button>
            <button @click="tab = 'keamanan'" :class="tab === 'keamanan' ? 'bg-blue-600 text-white shadow-blue-200' : 'bg-white text-slate-600'" class="w-full flex items-center gap-3 px-5 py-4 rounded-2xl font-bold transition-all shadow-sm border border-slate-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                Keamanan
            </button>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="lg:col-span-3">
            
            {{-- TAB: PROFIL (READ ONLY VIEW) --}}
            <div x-show="tab === 'profil'" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden" x-cloak>
                <div class="p-10 space-y-10">
                    <div class="flex flex-col md:flex-row items-center gap-8 border-b border-slate-50 pb-8">
                        <div class="w-32 h-32 bg-blue-100 rounded-[2.5rem] flex items-center justify-center text-blue-600 text-4xl font-black">
                            {{ substr($user['nama'], 0, 1) }}
                        </div>
                        <div class="text-center md:text-left">
                            <h2 class="text-2xl font-black text-slate-800">{{ $user['nama'] }}</h2>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-[0.2em] mt-1">{{ $user['role'] }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</p>
                            <p class="text-lg font-bold text-slate-700">{{ $user['nama'] }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Alamat Email</p>
                            <p class="text-lg font-bold text-slate-700">{{ $user['email'] }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">No. Telepon</p>
                            <p class="text-lg font-bold text-slate-700">{{ $user['telepon'] }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Terakhir Login</p>
                            <p class="text-lg font-bold text-slate-700">{{ $user['last_login'] }}</p>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button @click="openEdit = true" class="inline-flex items-center gap-3 px-8 py-4 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            Edit Profil Akun
                        </button>
                    </div>
                </div>
            </div>

            {{-- TAB: KEAMANAN --}}
            <div x-show="tab === 'keamanan'" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-10 space-y-8" x-cloak>
                <h2 class="text-2xl font-black text-slate-800">Ubah Kata Sandi</h2>
                <form @submit.prevent="alert('Demo: Password Diperbarui!')" class="max-w-md space-y-6">
                    <input type="password" placeholder="Password Lama" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none font-semibold">
                    <input type="password" placeholder="Password Baru" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none font-semibold">
                    <button class="w-full py-4 bg-slate-800 text-white font-black rounded-2xl transition-all active:scale-95">Update Keamanan</button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= MODAL EDIT PROFIL ================= --}}
    <div x-show="openEdit" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-cloak>

        <div @click.outside="openEdit = false"
             class="bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl overflow-hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-600 rounded-2xl text-white shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </div>
                    <h2 class="font-extrabold text-2xl text-slate-800">Edit Profil</h2>
                </div>
                <button @click="openEdit = false" class="text-slate-300 hover:text-rose-500 transition-colors">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-10">
                <form @submit.prevent="alert('Demo: Data profil berhasil diubah!'); openEdit = false" class="space-y-6">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap</label>
                        <input type="text" value="{{ $user['nama'] }}" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-blue-500 outline-none font-semibold">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">No. Telepon</label>
                        <input type="text" value="{{ $user['telepon'] }}" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-blue-500 outline-none font-semibold">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email (Read Only)</label>
                        <input type="email" value="{{ $user['email'] }}" readonly class="w-full p-4 bg-slate-100 border border-slate-200 rounded-2xl font-semibold text-slate-400 cursor-not-allowed">
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="button" @click="openEdit = false" class="flex-1 py-4 font-bold text-slate-400 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors">Batal</button>
                        <button type="submit" class="flex-[2] py-4 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

@endsection