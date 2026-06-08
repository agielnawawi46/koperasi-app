@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')

@php
    $authUser = auth()->user();
@endphp

<div class="px-8 py-8 space-y-8 animate-fade-in" x-data="{ tab: 'profil', openEdit: false }">

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-4 text-emerald-700 text-sm font-bold shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl px-6 py-4 text-red-600 text-sm font-bold shadow-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Profil Akun</h1>
                <p class="text-slate-500 font-medium">Informasi personal dan keamanan akun Anda.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- MENU KIRI --}}
        <div class="lg:col-span-1 space-y-2">
            <button @click="tab = 'profil'" :class="tab === 'profil' ? 'bg-blue-600 text-white shadow-xl shadow-blue-200' : 'bg-white text-slate-600 border border-slate-100'" class="w-full flex items-center gap-3 px-5 py-4 rounded-2xl font-black transition-all shadow-sm hover:bg-blue-50 active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Profil Saya
            </button>
            <button @click="tab = 'keamanan'" :class="tab === 'keamanan' ? 'bg-blue-600 text-white shadow-xl shadow-blue-200' : 'bg-white text-slate-600 border border-slate-100'" class="w-full flex items-center gap-3 px-5 py-4 rounded-2xl font-black transition-all shadow-sm hover:bg-blue-50 active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                Keamanan
            </button>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="lg:col-span-3">
            
            {{-- TAB: PROFIL --}}
            <div x-show="tab === 'profil'" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden" x-cloak>
                <div class="p-10 space-y-10">
                    <div class="flex flex-col md:flex-row items-center gap-8 border-b border-slate-50 pb-8">
                        <div class="w-32 h-32 bg-gradient-to-br from-slate-100 to-slate-200 rounded-[2.5rem] flex items-center justify-center font-black text-slate-600 text-4xl shadow-sm">
                            {{ substr($authUser->name, 0, 1) }}
                        </div>
                        <div class="text-center md:text-left">
                            <h2 class="text-2xl font-black text-slate-800">{{ $authUser->name }}</h2>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">{{ $authUser->roles->first()->name ?? 'Pengawas' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</p>
                            <p class="text-lg font-bold text-slate-700">{{ $authUser->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Alamat Email</p>
                            <p class="text-lg font-bold text-slate-700">{{ $authUser->email }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">No. Telepon</p>
                            <p class="text-lg font-bold text-slate-700">{{ $authUser->phone ?? '-' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Terdaftar Sejak</p>
                            <p class="text-lg font-bold text-slate-700">{{ $authUser->created_at->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button onclick="openEditModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            Edit Profil Akun
                        </button>
                    </div>
                </div>
            </div>

            {{-- TAB: KEAMANAN --}}
            <div x-show="tab === 'keamanan'" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-10 space-y-8" x-cloak>
                <h2 class="text-2xl font-black text-slate-800">Ubah Kata Sandi</h2>
                <form method="POST" action="{{ route('pengawas.profil.password') }}" class="max-w-md space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Password Lama</label>
                        <input type="password" name="current_password" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Password Baru</label>
                        <input type="password" name="password" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                    <button type="submit" class="w-full py-4 bg-slate-800 text-white font-black rounded-2xl hover:bg-slate-900 transition-all active:scale-95">Update Keamanan</button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= MODAL EDIT PROFIL ================= --}}
    <div id="modalEditProfil" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">
        <div class="bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all duration-300 scale-95 translate-y-8">

            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-600 rounded-2xl text-white shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </div>
                    <h2 class="font-extrabold text-2xl text-slate-800">Edit Profil</h2>
                </div>
                <button onclick="closeEditModal()" class="text-slate-300 hover:text-rose-500 transition-colors">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-10">
                <form method="POST" action="{{ route('pengawas.profil.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $authUser->name }}" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                        @error('name') <p class="text-[10px] font-bold text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">No. Telepon</label>
                        <input type="text" name="phone" value="{{ $authUser->phone }}" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all">
                        @error('phone') <p class="text-[10px] font-bold text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email (Read Only)</label>
                        <input type="email" value="{{ $authUser->email }}" readonly class="w-full bg-slate-100 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-400 cursor-not-allowed">
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="button" onclick="closeEditModal()" class="flex-1 py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 rounded-2xl">Batal</button>
                        <button type="submit" class="flex-[2] py-4 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openEditModal() {
    const modal = document.getElementById('modalEditProfil');
    const content = modal.querySelector('div');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'translate-y-8');
        content.classList.add('scale-100', 'translate-y-0');
    });
}
function closeEditModal() {
    const modal = document.getElementById('modalEditProfil');
    const content = modal.querySelector('div');
    content.classList.remove('scale-100', 'translate-y-0');
    content.classList.add('scale-95', 'translate-y-8');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
document.addEventListener('click', function(event) {
    const modal = document.getElementById('modalEditProfil');
    if (!modal.classList.contains('hidden') && event.target === modal) {
        closeEditModal();
    }
});
</script>

<style>
    [x-cloak] { display: none !important; }
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
</style>

@endsection
