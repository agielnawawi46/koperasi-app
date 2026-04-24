@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="monitoringSystem()" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-10">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-slate-200 pb-8">
        <div class="space-y-1">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Monitoring Sistem</h1>
            <p class="text-slate-500 font-medium">Pantau performa dan keamanan infrastruktur DanaKarya secara real-time.</p>
        </div>
        
        <div class="flex items-center gap-3 px-5 py-2.5 bg-emerald-50 rounded-2xl border border-emerald-100 shadow-sm shadow-emerald-50">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <span class="text-[10px] font-black text-emerald-700 uppercase tracking-[0.2em]">Live Monitoring Engine</span>
        </div>
    </div>

    {{-- ================= STATS GRID (REVISI DENGAN IKON) ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        {{-- Total Aktivitas --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-[60px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100">
            </div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Aktivitas</p>
                    <div class="p-2.5 bg-blue-100 text-blue-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-4xl font-black text-blue-600 tracking-tighter" x-text="aktivitas.length"></h2>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Logs</span>
                </div>
            </div>
        </div>

        {{-- Login Berhasil --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-[60px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400/70">Login Berhasil</p>
                    <div class="p-2.5 bg-emerald-100 text-emerald-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-4xl font-black text-emerald-600 tracking-tighter" x-text="loginBerhasil"></h2>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sesi</span>
                </div>
            </div>
        </div>

        {{-- Login Gagal --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-rose-50 rounded-bl-[60px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-rose-100"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-400/70">Login Gagal</p>
                    <div class="p-2.5 bg-rose-100 text-rose-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-4xl font-black text-rose-600 tracking-tighter" x-text="loginGagal"></h2>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Upaya</span>
                </div>
            </div>
        </div>

        {{-- Transaksi --}}
        <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-xl shadow-slate-200 relative overflow-hidden group hover:bg-slate-800 transition-all duration-500">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-bl-[60px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-white/10"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Transaksi</p>
                    <div class="p-2.5 bg-white/10 text-white rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-4xl font-black text-white tracking-tighter" x-text="transaksi"></h2>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Proses</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MAIN CONTENT GRID ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        {{-- TABLE LOGS --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-2">
                <h2 class=" font-black text-slate-800 tracking-tight uppercase text-xs">Aktivitas Sistem Terperinci</h2>
                <button class="px-5 py-2 bg-white border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-slate-50 transition-all">
                    Ekspor CSV
                </button>
            </div>
            
            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Waktu</th>
                                <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">User</th>
                                <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Aktivitas</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <template x-for="item in aktivitas" :key="item.id">
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-6 text-slate-400 tabular-nums font-bold text-xs" x-text="item.waktu"></td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-2">
                                            <div class="w-1.5 h-1.5 rounded-full bg-blue-400"></div>
                                            <span class="text-slate-800 font-bold text-sm tracking-tight" x-text="item.user"></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-slate-600 font-medium text-sm" x-text="item.aksi"></td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-4 py-1.5 text-[9px] font-black uppercase rounded-xl tracking-widest border"
                                            :class="item.status === 'Berhasil' 
                                                ? 'bg-emerald-50 text-emerald-600 border-emerald-100' 
                                                : 'bg-rose-50 text-rose-600 border-rose-100'"
                                            x-text="item.status">
                                        </span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ACTIVITY FEED --}}
        <div class="space-y-6">
            <h2 class="font-black text-slate-800 tracking-tight uppercase text-xs px-2">Real-time Feed</h2>
            
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 relative">
                <div class="absolute left-10 top-12 bottom-12 w-[1px] bg-slate-100"></div>
                
                <ul class="space-y-8 relative">
                    <template x-for="item in aktivitas.slice(0,5)">
                        <li class="flex items-start gap-6 relative">
                            {{-- Dot Indicator --}}
                            <div class="mt-1.5 w-2.5 h-2.5 rounded-full ring-4 ring-white shrink-0 z-10 transition-transform group-hover:scale-125"
                                :class="item.status === 'Berhasil' ? 'bg-emerald-500 shadow-lg shadow-emerald-200' : 'bg-rose-500 shadow-lg shadow-rose-200'">
                            </div>
                            
                            <div class="space-y-2">
                                <p class="text-slate-800 font-bold text-sm leading-snug tracking-tight" x-text="item.aksi"></p>
                                <div class="flex items-center gap-3">
                                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest tabular-nums" x-text="item.waktu"></span>
                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                    <span class="text-blue-600 text-[10px] font-black uppercase tracking-widest" x-text="item.user"></span>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>

                <button class="w-full mt-10 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-blue-600 border-t border-slate-50 transition-all hover:tracking-[0.3em]">
                    View Global Logs →
                </button>
            </div>
            
            
        </div>
    </div>
</div>

<script>
    function monitoringSystem() {
        return {
            loginBerhasil: 142,
            loginGagal: 3,
            transaksi: 58,
            aktivitas: [
                { id: 1, waktu: '10:45:02', user: 'Admin_Andi', aksi: 'Mengubah limit kredit Anggota #092', status: 'Berhasil' },
                { id: 2, waktu: '10:42:15', user: 'Budi_S', aksi: 'Login Gagal (Salah Password)', status: 'Gagal' },
                { id: 3, waktu: '10:30:00', user: 'Sistem', aksi: 'Backup Database Otomatis', status: 'Berhasil' },
                { id: 4, waktu: '10:15:33', user: 'Pengawas_Mona', aksi: 'Pencairan Pinjaman RP 5.000.000', status: 'Berhasil' },
                { id: 5, waktu: '09:55:12', user: 'Admin_Andi', aksi: 'Menghapus User "Tamu_01"', status: 'Berhasil' },
                { id: 6, waktu: '09:40:00', user: 'Sistem', aksi: 'Update patch keamanan v2.1', status: 'Berhasil' },
            ]
        }
    }
</script>

<style>
    [x-cloak] { display: none !important; }
    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar { height: 6px; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>

@endsection