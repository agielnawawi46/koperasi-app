@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')

<div x-data="monitoringSystem()" class="px-8 py-8 space-y-8 animate-fade-in">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Monitoring Sistem</h1>
            <p class="text-slate-500 font-medium">Pantau aktivitas sistem secara ringkas.</p>
        </div>
        <div class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl border border-emerald-100 uppercase tracking-wide">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
            Live
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="group relative bg-white p-8 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-blue-900/5 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700 text-blue-600">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"/></svg>
            </div>
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-blue-700 transition-colors">Total Aktivitas</p>
                    <div class="p-4 bg-slate-50 rounded-[1.5rem] group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-xl group-hover:shadow-blue-200 transition-all duration-500 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums" x-text="totalLogs"></h2>
            </div>
        </div>

        <div class="group relative bg-white p-8 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-emerald-900/5 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700 text-emerald-600">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400/70 group-hover:text-emerald-700 transition-colors">Login Berhasil</p>
                    <div class="p-4 bg-slate-50 rounded-[1.5rem] group-hover:bg-emerald-600 group-hover:text-white group-hover:shadow-xl group-hover:shadow-emerald-200 transition-all duration-500 text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums" x-text="loginBerhasil"></h2>
            </div>
        </div>

        <div class="group relative bg-white p-8 rounded-[2.5rem] border border-slate-200/60 shadow-sm hover:shadow-2xl hover:shadow-rose-900/5 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700 text-rose-600">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-400/70 group-hover:text-rose-700 transition-colors">Login Gagal</p>
                    <div class="p-4 bg-slate-50 rounded-[1.5rem] group-hover:bg-rose-600 group-hover:text-white group-hover:shadow-xl group-hover:shadow-rose-200 transition-all duration-500 text-rose-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tabular-nums" x-text="loginGagal"></h2>
            </div>
        </div>

        <div class="group relative bg-slate-900 p-8 rounded-[2.5rem] border border-slate-800 shadow-sm hover:shadow-2xl hover:shadow-slate-900/10 hover:-translate-y-2 hover:bg-slate-800 transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 group-hover:scale-150 transition-all duration-700 text-white">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Transaksi</p>
                    <div class="p-4 bg-white/10 rounded-[1.5rem] text-white group-hover:bg-white group-hover:text-slate-900 group-hover:shadow-xl transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-white tabular-nums" x-text="totalLoans + totalSavings"></h2>
            </div>
        </div>
    </div>

    {{-- RECENT ACTIVITY (DROPDOWN) --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden">
        <button @click="open = !open" class="w-full px-8 py-6 flex items-center justify-between hover:bg-slate-50/50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 bg-emerald-500 rounded-full shadow-lg shadow-emerald-200 group-hover:animate-pulse"></div>
                <h2 class="font-black text-slate-800 tracking-tight">Aktivitas Terkini</h2>
                <span class="text-[10px] font-black text-slate-400 tabular-nums tracking-widest">({{ $recentLogs->count() }})</span>
            </div>
            <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-[1000px]" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-[1000px]" x-transition:leave-end="opacity-0 max-h-0" class="border-t border-slate-50 divide-y divide-slate-50" x-cloak>
            @forelse($recentLogs as $log)
            <div class="flex items-center gap-4 px-8 py-4 hover:bg-slate-50/50 transition-colors">
                <div class="w-9 h-9 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center font-black text-slate-600 text-xs shrink-0">
                    {{ strtoupper(substr($log->user?->name ?? 'S', 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ $log->description ?? $log->action }}</p>
                    <p class="text-[10px] font-bold text-slate-400">
                        {{ $log->user?->name ?? 'Sistem' }}
                        <span class="mx-1.5">&middot;</span>
                        {{ $log->created_at->format('d M H:i') }}
                    </p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[10px] font-black rounded-xl border uppercase tracking-wide shrink-0
                    {{ $log->action === 'login' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-blue-50 text-blue-700 border-blue-100' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $log->action === 'login' ? 'bg-emerald-500' : 'bg-blue-500' }}"></span>
                    {{ $log->action }}
                </span>
            </div>
            @empty
            <div class="px-8 py-12 text-center font-bold text-slate-400 italic">Belum ada aktivitas.</div>
            @endforelse
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
</style>

<script>
function monitoringSystem() {
    return {
        open: false,
        loginBerhasil: {{ $loginBerhasil }},
        loginGagal: {{ $loginGagal }},
        totalLogs: {{ $totalLogs }},
        totalLoans: {{ $totalLoans }},
        totalSavings: {{ $totalSavings }},
    }
}
</script>

@endsection
