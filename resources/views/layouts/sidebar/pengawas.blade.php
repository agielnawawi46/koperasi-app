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
                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 mt-1 block">Audit & Supervision</span>
            </div>
        </div>
    </div>

    {{-- ================= NAVIGATION ================= --}}
    <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto custom-scrollbar">
        
        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Pengawasan</p>

        @php
            $supervisorMenus = [
                [
                    'label' => 'Dashboard Audit',
                    'url' => '/supervisor/dashboard',
                    'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'
                ],
                [
                    'label' => 'Data Anggota',
                    'url' => '/supervisor/anggota',
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                ],
            ];
        @endphp

        @foreach($supervisorMenus as $menu)
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

        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Verifikasi Keuangan</p>

        @php
            $financeMenus = [
                ['label' => 'Audit Simpanan', 'url' => '/supervisor/simpanan', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['label' => 'Audit Pinjaman', 'url' => '/supervisor/pinjaman', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ['label' => 'Rekap Angsuran', 'url' => '/supervisor/angsuran', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ];
        @endphp

        @foreach($financeMenus as $menu)
        <a href="{{ $url = $menu['url'] }}" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is(trim($url, '/').'*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu['icon'] }}" />
            </svg>
            <span class="text-sm font-bold tracking-wide">{{ $menu['label'] }}</span>
        </a>
        @endforeach

        <div class="my-8 px-4">
            <div class="h-px bg-slate-800 w-full"></div>
        </div>

        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Finalisasi</p>

        <a href="/supervisor/laporan-shu" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('supervisor/laporan-shu*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Laporan & SHU</span>
        </a>

    </nav>

    {{-- ================= SUPERVISOR FOOTER ================= --}}
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