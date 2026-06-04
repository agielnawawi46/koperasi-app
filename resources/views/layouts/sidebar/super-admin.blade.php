<aside class="w-72 min-h-screen bg-slate-900 text-white flex flex-col border-r border-slate-800">

    <div class="h-24 flex items-center px-8 bg-slate-900/50 backdrop-blur-sm sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-white rounded-full shadow-lg shadow-blue-500/10">
                <img src="{{ asset('images/logdanacdr.png') }}" alt="DanaKarya Logo" class="h-10 w-10 object-contain">
            </div>
            <div>
                <span class="text-xl font-black tracking-tight block leading-none">Dana<span class="text-blue-500">Karya</span></span>
                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 mt-1 block">Super Admin</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto custom-scrollbar">

        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Main Menu</p>

        <a href="{{ route('super-admin.dashboard') }}"
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->routeIs('super-admin.dashboard') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Dashboard</span>
        </a>

    </nav>

    {{-- ================= LOGOUT ================= --}}
    <div class="px-6 pb-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group flex items-center gap-4 w-full px-5 py-3.5 rounded-2xl text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 transition-all duration-300">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-sm font-bold tracking-wide">Logout</span>
            </button>
        </form>
    </div>

    <div class="p-9 border-t border-slate-800">
        <p class="text-center text-[9px] font-bold text-white mt-6 tracking-widest uppercase opacity-50 italic">© {{ date('Y') }} DanaKarya</p>
    </div>

</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.1); }
</style>
