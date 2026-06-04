<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 px-10 py-5 flex justify-between items-center sticky top-0 z-40">

    {{-- ================= BREADCRUMBS / TITLE ================= --}}
    <div class="flex items-center gap-4">
        <div class="hidden md:flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
            <span class="hover:text-blue-600 cursor-pointer transition-colors">Role</span>
            <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-800">Manajemen Pengguna</span>
        </div>
        {{-- Mobile Title --}}
        <h1 class="md:hidden text-lg font-black text-slate-800 tracking-tight">DanaKarya</h1>
    </div>

    {{-- ================= USER ACTIONS ================= --}}
    <div class="flex items-center gap-6">
        
        {{-- Notification Bell (Optional but adds premium feel) --}}
        <button class="relative p-2 text-slate-400 hover:text-blue-600 transition-colors">
            <div class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></div>
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <div class="h-8 w-px bg-slate-100 hidden sm:block"></div>

        {{-- User Profile & Logout --}}
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-black text-slate-800 leading-none">{{ auth()->user()->name ?? 'massyanto' }}</p>
                <p class="text-[9px] font-bold text-blue-600 uppercase tracking-widest mt-1">{{ auth()->user()->roles->first()->name ?? 'role' }}</p>
            </div>
            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 group focus:outline-none">
                    <div class="w-10 h-10 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shadow-sm group-hover:border-blue-200 transition-all">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </button>

                {{-- Dropdown Logout --}}
                <div x-show="open" @click.outside="open = false" 
                     x-transition class="absolute right-0 mt-3 w-48 bg-white rounded-[1.5rem] shadow-2xl shadow-slate-900/10 border border-slate-50 p-2 z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-rose-500 hover:bg-rose-50 rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-xs font-black uppercase tracking-widest">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</header>