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
                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 mt-1 block">Enterprise v2.0</span>
            </div>
        </div>
    </div>

    {{-- ================= NAVIGATION ================= --}}
    <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto custom-scrollbar">
        
        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">Main Menu</p>

        {{-- Nav Item Template --}}
        @php
            $menuItems = [
                ['url' => '/admin/dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard'],
                ['url' => '/admin/organisasi', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'label' => 'Organisasi'],
                ['url' => '/admin/pengguna', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Pengguna'],
                ['url' => '/admin/penggajian', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'label' => 'Penggajian'],
            ];
        @endphp

        @foreach($menuItems as $item)
        <a href="{{ $url = $item['url'] }}" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is(trim($url, '/').'*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
            </svg>
            <span class="text-sm font-bold tracking-wide">{{ $item['label'] }}</span>
            
            @if(request()->is(trim($url, '/').'*'))
                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></div>
            @endif
        </a>
        @endforeach

        {{-- Divider --}}
        <div class="my-8 px-4">
            <div class="h-px bg-slate-800 w-full"></div>
        </div>

        <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4">System</p>

        <a href="/admin/monitoring" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('admin/monitoring*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Monitoring</span>
        </a>

        <a href="/admin/pengaturan" 
           class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl transition-all duration-300 {{ request()->is('admin/pengaturan*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-sm font-bold tracking-wide">Pengaturan</span>
        </a>

    </nav>

    {{-- ================= FOOTER ================= --}}
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