@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="monitoringSystem()" class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-10">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Monitoring Sistem</h1>
            <p class="text-slate-500 font-medium">Pantau performa dan keamanan infrastruktur DanaKarya secara real-time.</p>
        </div>
        
        <div class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
            Live Monitoring Engine
        </div>
    </div>

    {{-- ================= STATS GRID (REVISI DENGAN IKON) ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        {{-- Total Aktivitas --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-blue-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Total Aktivitas</p>
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-blue-600 tabular-nums" x-text="totalLogs"></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-blue-100/50 text-blue-700 border border-blue-200 uppercase tracking-widest">Total Logs</div>
                </div>
            </div>
        </div>

        {{-- Login Berhasil --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-emerald-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400/70 group-hover:text-emerald-700 transition-colors">Login Berhasil</p>
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-emerald-600 tabular-nums" x-text="loginBerhasil"></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-100/50 text-emerald-700 border border-emerald-200 uppercase tracking-widest">Sesi Aktif</div>
                </div>
            </div>
        </div>

        {{-- Login Gagal --}}
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110 group-hover:bg-rose-100"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-400/70 group-hover:text-rose-700 transition-colors">Login Gagal</p>
                    <div class="p-4 bg-rose-100 text-rose-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-rose-600 tabular-nums" x-text="loginGagal"></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-rose-100/50 text-rose-700 border border-rose-200 uppercase tracking-widest">Upaya Gagal</div>
                </div>
            </div>
        </div>

        {{-- Transaksi --}}
        <div class="group relative bg-slate-900 p-8 rounded-[2.5rem] shadow-xl shadow-slate-200 overflow-hidden hover:bg-slate-800 transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-[80px] -z-0 transition-all duration-500 group-hover:scale-110"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Transaksi</p>
                    <div class="p-4 bg-white/20 text-white rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-white tabular-nums" x-text="totalLoans + totalSavings"></h2>
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-[10px] font-black bg-white/10 text-white border border-white/20 uppercase tracking-widest">Total Proses</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MAIN CONTENT GRID ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        {{-- TABLE LOGS --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-2">
                <h2 class="font-black text-slate-800 tracking-tight uppercase text-xs">Aktivitas Sistem Terperinci</h2>
                <button class="group flex items-center gap-2 px-5 py-3.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl shadow-sm hover:border-green-500 hover:text-green-600 transition-all active:scale-95">
                    <div class="p-1.5 bg-slate-50 group-hover:bg-green-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    Ekspor CSV
                </button>
            </div>
            
            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden animate-slide-up">
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
                                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 text-[10px] font-black rounded-xl border uppercase tracking-wide"
                                            :class="item.status === 'Berhasil' 
                                                ? 'bg-emerald-50 text-emerald-700 border-emerald-100' 
                                                : 'bg-rose-50 text-rose-700 border-rose-100'">
                                            <span class="w-1.5 h-1.5 rounded-full"
                                                :class="item.status === 'Berhasil' ? 'bg-emerald-500' : 'bg-rose-500'"></span>
                                            <span x-text="item.status"></span>
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
            loginBerhasil: {{ $logs->where('action', 'login')->count() }},
            loginGagal: {{ $logs->where('action', 'LIKE', '%fail%')->count() }},
            transaksi: {{ $logs->whereIn('action', ['create_transaction', 'create_loan', 'approve_loan'])->count() }},
            totalLogs: {{ $totalLogs }},
            totalUsers: {{ $totalUsers }},
            totalLoans: {{ $totalLoans }},
            totalSavings: {{ $totalSavings }},
            aktivitas: [
                @foreach($logs as $log)
                {
                    id: {{ $log->id }},
                    waktu: '{{ $log->created_at->format('H:i:s') }}',
                    user: '{{ $log->user?->name ?? 'Sistem' }}',
                    aksi: '{{ $log->description ?? $log->action }}',
                    status: '{{ $log->action === 'login' ? 'Berhasil' : 'Berhasil' }}'
                },
                @endforeach
            ]
        }
    }
</script>

<style>
    [x-cloak] { display: none !important; }
    .overflow-x-auto::-webkit-scrollbar { height: 6px; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection