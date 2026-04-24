@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="userManager()" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Pengguna</h1>
            <p class="text-slate-500 mt-1 font-medium">Kelola akses dan otoritas akun berdasarkan kategori role.</p>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-2xl text-blue-700 text-sm font-semibold">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
            </span>
            Sistem Aktif
        </div>
    </div>

    {{-- ================= ROLE CARDS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <template x-for="r in roles" :key="r.name">
            <div 
                @click="openRole(r)"
                class="group cursor-pointer bg-white p-8 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-blue-900/5 hover:-translate-y-2 transition-all duration-500 relative overflow-hidden flex flex-col items-center text-center"
            >
                <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700 text-blue-600" x-html="r.icon"></div>
                
                <div class="mb-5 p-5 bg-slate-50 rounded-[1.5rem] group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-xl group-hover:shadow-blue-200 transition-all duration-500 text-blue-600" x-html="r.icon"></div>
                
                <h3 class="font-black text-xl text-slate-800" x-text="r.name"></h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-2" x-text="r.desc"></p>
                
                <div class="mt-8 flex items-center gap-2 text-xs font-black uppercase tracking-widest text-blue-600 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0">
                    Kelola Data
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </div>
            </div>
        </template>
    </div>

    {{-- ================= MODAL DATA USER (LIST) ================= --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 flex items-center justify-center bg-slate-900/60 backdrop-blur-md z-50 p-4"
         x-cloak>

        <div @click.outside="closeModal"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="bg-white w-full max-w-4xl h-[85vh] rounded-[2.5rem] shadow-2xl flex flex-col overflow-hidden border border-white/20">

            {{-- Modal Header --}}
            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-600 rounded-2xl text-white shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-2xl text-slate-800">Entitas <span class="text-blue-600" x-text="currentRole"></span></h2>
                        <p class="text-xs font-bold text-slate-400 tracking-widest uppercase mt-0.5">Daftar Otoritas Terdaftar</p>
                    </div>
                </div>
                <button @click="closeModal" class="p-2 hover:bg-rose-50 rounded-full text-slate-300 hover:text-rose-500 transition-all">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Toolbar --}}
            <div class="px-10 py-5 border-b border-slate-50 flex justify-between items-center bg-white/50">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                    Total: <span class="text-blue-600" x-text="filteredUsers.length"></span> Pengguna
                </p>
                <button @click="openForm()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-sm font-bold shadow-lg shadow-blue-100 flex items-center gap-2 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Tambah Akun
                </button>
            </div>

            {{-- List User Scrollable --}}
            <div class="flex-1 overflow-y-auto px-10 py-8 space-y-4 custom-scrollbar">
                <template x-for="(user, index) in filteredUsers" :key="index">
                    <div class="p-6 bg-slate-50/50 border border-slate-100 rounded-[2rem] flex flex-col md:flex-row justify-between items-center gap-4 hover:border-blue-200 hover:bg-white hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 group">
                        <div class="flex items-center gap-5 w-full">
                            <div class="w-14 h-14 rounded-[1.25rem] bg-white shadow-sm flex items-center justify-center font-black text-blue-600 text-xl border border-slate-100" x-text="user.name.charAt(0)"></div>
                            <div class="flex-1">
                                <p class="font-bold text-slate-800 text-lg leading-tight" x-text="user.name"></p>
                                <div class="flex items-center gap-3 mt-1.5">
                                    <p class="text-sm font-medium text-slate-400" x-text="user.email"></p>
                                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                    <span class="text-[10px] px-2.5 py-1 rounded-lg font-black uppercase tracking-widest"
                                        :class="user.status == 'aktif' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600'"
                                        x-text="user.status"></span>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2 w-full md:w-auto opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                            <button @click="editUser(user, index)" class="flex-1 md:flex-none px-5 py-2.5 text-xs font-black uppercase tracking-widest text-blue-600 bg-white border border-blue-100 rounded-xl hover:bg-blue-600 hover:text-white transition-all">Edit</button>
                            <button @click="toggleStatus(index)" class="flex-1 md:flex-none px-5 py-2.5 text-xs font-black uppercase tracking-widest rounded-xl border transition-all"
                                :class="user.status == 'aktif' ? 'text-amber-600 border-amber-100 bg-white hover:bg-amber-600 hover:text-white' : 'text-emerald-600 border-emerald-100 bg-white hover:bg-emerald-600 hover:text-white'"
                                x-text="user.status == 'aktif' ? 'Suspend' : 'Re-Active'">
                            </button>
                            <button @click="deleteUser(index)" class="flex-1 md:flex-none px-5 py-2.5 text-xs font-black uppercase tracking-widest text-rose-500 bg-white border border-rose-100 hover:bg-rose-500 hover:text-white rounded-xl transition-all">Hapus</button>
                        </div>
                    </div>
                </template>

                <div x-show="filteredUsers.length === 0" class="flex flex-col items-center justify-center py-20 text-slate-300">
                    <svg class="w-20 h-20 mb-4 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-4m-8 0H4m8 2v5m4-7V5a1 1 0 112 0v1a1 1 0 01-1 1h-1z"/></svg>
                    <p class="text-sm font-black uppercase tracking-widest text-slate-400">Belum ada entitas terdaftar</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MODAL FORM (INPUT/EDIT) ================= --}}
    <div x-show="formOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 flex items-center justify-center bg-slate-900/80 backdrop-blur-xl z-[60] p-4" 
         x-cloak>
         
        <div @click.outside="formOpen=false" 
             x-show="formOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl border border-white/20">
            
            <div class="mb-10 text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-[2rem] flex items-center justify-center mx-auto mb-5 shadow-lg shadow-blue-100/50">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h2 class="font-black text-2xl text-slate-800" x-text="formMode"></h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Kredensial Akses Pengguna</p>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap</label>
                    <input x-model="form.name" type="text" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 placeholder:font-medium" placeholder="Contoh: Ahmad Faisal">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Email Resmi</label>
                    <input x-model="form.email" type="email" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 placeholder:font-medium" placeholder="email@koperasi.com">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Kata Sandi Akun</label>
                    <input type="password" x-model="form.password" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-bold text-slate-700 placeholder:font-medium" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center gap-3 mt-12">
                <button @click="formOpen=false" class="flex-1 py-4 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 rounded-2xl">
                    Batal
                </button>
                <button @click="saveUser" class="flex-[2] py-4 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all active:scale-95">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>

</div>

{{-- ================= CSS & JS ================= --}}
<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>

<script>
function userManager() {
    return {
        open: false,
        formOpen: false,
        currentRole: '',
        formMode: 'Tambah User',
        editIndex: null,

        roles: [
            { 
                name: 'Admin', 
                desc: 'Otoritas Sistem Utama', 
                icon: `<svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>` 
            },
            { 
                name: 'Pengawas', 
                desc: 'Audit & Monitoring', 
                icon: `<svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>` 
            },
            { 
                name: 'Pengurus', 
                desc: 'Operasional Harian', 
                icon: `<svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>` 
            },
            { 
                name: 'Anggota', 
                desc: 'Nasabah Koperasi', 
                icon: `<svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>` 
            }
        ],

        users: [
            { name: 'Admin Utama', email: 'admin@mail.com', role: 'Admin', status: 'aktif' },
            { name: 'Sari Rahayu', email: 'sari@mail.com', role: 'Pengurus', status: 'aktif' },
            { name: 'Ahmad Kurniawan', email: 'ahmad@mail.com', role: 'Pengawas', status: 'nonaktif' },
            { name: 'Budi Santoso', email: 'budi@mail.com', role: 'Anggota', status: 'aktif' }
        ],

        form: { name: '', email: '', password: '' },

        openRole(role) {
            this.currentRole = role.name
            this.open = true
        },

        closeModal() {
            this.open = false
        },

        get filteredUsers() {
            return this.users.filter(u => u.role === this.currentRole)
        },

        openForm() {
            this.formOpen = true
            this.formMode = 'Tambah User'
            this.form = { name: '', email: '', password: '' }
            this.editIndex = null
        },

        saveUser() {
            if (this.editIndex !== null) {
                // Update Logic
                const userEmail = this.filteredUsers[this.editIndex].email;
                const originalIndex = this.users.findIndex(u => u.email === userEmail);
                this.users[originalIndex] = {
                    ...this.form,
                    role: this.currentRole,
                    status: this.users[originalIndex].status
                }
            } else {
                // Create Logic
                this.users.push({
                    ...this.form,
                    role: this.currentRole,
                    status: 'aktif'
                })
            }
            this.formOpen = false
        },

        editUser(user, index) {
            this.formOpen = true
            this.formMode = 'Edit User'
            this.form = { ...user }
            this.editIndex = index
        },

        toggleStatus(index) {
            const userEmail = this.filteredUsers[index].email;
            const originalIndex = this.users.findIndex(u => u.email === userEmail);
            this.users[originalIndex].status = this.users[originalIndex].status === 'aktif' ? 'nonaktif' : 'aktif'
        },

        deleteUser(index) {
            if(confirm('Hapus user ini secara permanen?')) {
                const userEmail = this.filteredUsers[index].email;
                this.users = this.users.filter(u => u.email !== userEmail);
            }
        }
    }
}
</script>

@endsection