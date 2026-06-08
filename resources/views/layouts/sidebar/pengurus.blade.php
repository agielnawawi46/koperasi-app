<aside class="w-72 min-h-screen bg-slate-900 text-white flex flex-col border-r border-slate-800">

    {{-- ================= LOGO SECTION ================= --}}
    <div class="h-24 flex items-center px-8 bg-slate-900/50 backdrop-blur-sm sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-white rounded-full shadow-lg shadow-blue-500/10">
                <img 
                    src="{{ asset('images/logdanacdr.png') }}" 
                    alt="DanaKarya Logo" 
                    class="h-10 w-10 object-contain"
                >
            </div>
            <div>
                <span class="text-xl font-black tracking-tight block leading-none">Dana<span class="text-blue-500">Karya</span></span>
                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 mt-1 block">Staff Operasional</span>
            </div>
        </div>
    </div>

    {{-- ================= NAVIGATION ================= --}}
    <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto custom-scrollbar">
        
        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Menu Utama</p>

        {{-- Nav Item List --}}
        @php
            $staffMenus = [
                [
                    'label' => 'Dashboard',
                    'url' => '/pengurus/dashboard',
                    'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
                ],
                [
                    'label' => 'Transaksi Simpanan',
                    'url' => '/pengurus/transsimpanan',
                    'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
                ],
                [
                    'label' => 'Kelola Pinjaman',
                    'url' => '/pengurus/kelpinjaman',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                ],
                [
                    'label' => 'Input Angsuran',
                    'url' => '/pengurus/inpangsuran',
                    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'
                ],
            ];
        @endphp

        @foreach($staffMenus as $menu)
        <a href="{{ $url = $menu['url'] }}" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is(trim($url, '/').'*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu['icon'] }}" />
            </svg>
            <span class="text-sm font-bold tracking-wide">{{ $menu['label'] }}</span>
            @if(request()->is(trim($url, '/').'*'))
                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></div>
            @endif
        </a>
        @endforeach

        <div class="my-8 px-4">
            <div class="h-px bg-slate-800 w-full"></div>
        </div>

        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Analitik & Pantauan</p>

        <a href="/pengurus/lapharian" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('pengurus/lapharian*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Laporan Keuangan</span>
        </a>

        <a href="/pengurus/monitoring" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('pengurus/monitoring*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Monitoring Aktif</span>
        </a>

        <a href="/pengurus/shu" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('pengurus/shu*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">SHU</span>
        </a>

        <div class="my-8 px-4">
            <div class="h-px bg-slate-800 w-full"></div>
        </div>

        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Akun</p>

        <a href="/pengurus/profil" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('pengurus/profil*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Profil</span>
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

    {{-- ================= STAFF FOOTER ================= --}}
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