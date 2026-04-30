<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DanaKarya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/collapse.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f1f5f9] antialiased text-slate-800 p-20 md:p-8 md:pt-20 space-y-8">
{{-- ================= FLOATING HEADER ================= --}}
<header x-data="{ atTop: true }" 
        @scroll.window="atTop = (window.pageYOffset > 50 ? false : true)"
        class="fixed top-0 left-0 right-0 z-[100] px-4 md:px-8 py-6 transition-all duration-500">
    
    <nav class="max-w-3xl mx-auto backdrop-blur-md border transition-all duration-500 rounded-[2.5rem] px-8 py-3 flex items-center justify-center gap-8 md:gap-12"
         :class="atTop ? 'bg-white/30 border-white/20 shadow-none' : 'bg-white/90 border-slate-200 shadow-xl'">
        
        {{-- Href diarahkan ke ID 'beranda' --}}
        <a href="#beranda" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-700 hover:text-blue-600 transition-colors">Beranda</a>
        <a href="#tentang" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-700 hover:text-blue-600 transition-colors">Tentang</a>
        <a href="#kontak" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-700 hover:text-blue-600 transition-colors">Kontak</a>
    </nav>
</header>

<main class="space-y-12 pt-1">
    {{-- TAMBAHKAN id="beranda" DI SINI --}}
    <section id="beranda" class="relative px-4 py-20 md:py-32 overflow-hidden bg-white rounded-[4rem] border border-slate-200/60 shadow-sm mx-4 md:mx-8">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50/50 rounded-full -mr-64 -mt-64 blur-3xl"></div>
        <div class="max-w-6xl mx-auto relative z-10 px-18">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-10 text-center lg:text-left order-2 lg:order-1">
                    <div class="space-y-6">
                        <h1 class="text-5xl md:text-7xl font-black tracking-tighter leading-[0.9] text-slate-900">
                            Solusi Finansial <br> <span class="text-blue-600">Masa Depan.</span>
                        </h1>
                        <p class="text-slate-500 text-lg max-w-xl mx-auto lg:mx-0 font-medium">
                            Kelola simpanan dan pantau aset Anda secara transparan bersama <span class="text-slate-900 font-bold italic">Dana Karya.</span>
                        </p>
                    </div>
                    <a href="/login" class="inline-block px-10 py-5 bg-slate-900 text-white rounded-[2rem] text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all">
                        Masuk Ke Aplikasi
                    </a>
                </div>
                <div class="flex justify-center lg:justify-end order-1 lg:order-2">
                    <img src="{{ asset('images/dn.png') }}" alt="Logo DanaKarya" class="h-48 md:h-72 lg:h-80 w-auto object-contain">
                </div>
            </div>
        </div>
    </section>

    {{-- ================= TENTANG (CARD 2) ================= --}}
    <section id="tentang" class="bg-white rounded-[4rem] border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="max-w-6xl mx-auto px-8 py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div class="relative group">
                    <div class="aspect-square bg-slate-50 rounded-[3rem] overflow-hidden border border-slate-100 shadow-inner transition-all duration-700 group-hover:scale-[0.98]">
                        <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&q=80" alt="About Us" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="space-y-10">
                    <div class="space-y-4">
                        <span class="text-blue-600 text-[10px] font-black uppercase tracking-[0.4em]">Tentang Kami</span>
                        <h2 class="text-5xl font-black tracking-tighter text-slate-900 leading-none">Membangun Ekonomi <br>Tanpa Batas.</h2>
                        <p class="text-slate-500 font-medium leading-relaxed">Platform koperasi digital terintegrasi yang fokus pada kesejahteraan anggota melalui transparansi data 100%.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        @foreach(['Transparansi Log Transaksi', 'Suku Bunga Kompetitif', 'Keanggotaan Inklusif'] as $item)
                        <div class="flex items-center gap-4 p-5 bg-slate-50 rounded-[1.5rem] border border-slate-100 group hover:border-blue-200 transition-all">
                            <div class="p-2 bg-white text-blue-600 rounded-lg shadow-sm group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-xs font-black text-slate-700 uppercase tracking-widest">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- ================= OMNI-CHANNEL COMMUNICATION (CARD 3) ================= --}}
    <section id="kontak" class="bg-slate-900 rounded-[4rem] border border-slate-800 shadow-2xl overflow-hidden relative">
        {{-- Dekorasi Cahaya Futuristik --}}
        <div class="absolute -bottom-24 -right-24 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute -top-24 -left-24 w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-[100px]"></div>
        
        <div class="max-w-6xl mx-auto px-8 py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                {{-- SISI KIRI: TEXT & STATUS --}}
                <div class="space-y-12 text-center lg:text-left">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-emerald-500">Sistem Online 24/7</span>
                        </div>
                        <h2 class="text-6xl font-black tracking-tighter text-white leading-none text-balance">Pilih Cara Anda <br><span class="text-blue-500">Berinteraksi.</span></h2>
                        <p class="text-slate-400 font-medium max-w-sm mx-auto lg:mx-0 leading-relaxed">
                            Tanpa form yang rumit. Klik ikon di samping untuk langsung terhubung dengan tim representatif kami secara instan.
                        </p>
                    </div>
                </div>

                {{-- SISI KANAN: FULL BENTO MESSENGER GRID --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    
                    {{-- WhatsApp --}}
                    <a href="https://wa.me/6281211112222" target="_blank" class="group p-8 bg-white/5 border border-white/10 rounded-[3rem] hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all duration-500">
                        <div class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-emerald-500/20 text-emerald-500 rounded-2xl group-hover:scale-110 group-hover:rotate-12 transition-all">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.937 3.659 1.432 5.628 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">WhatsApp</span>
                        </div>
                    </a>

                    {{-- Telegram --}}
                    <a href="https://t.me/yourusername" target="_blank" class="group p-8 bg-white/5 border border-white/10 rounded-[3rem] hover:bg-blue-400/20 hover:border-blue-400/50 transition-all duration-500">
                        <div class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-blue-400/20 text-blue-400 rounded-2xl group-hover:scale-110 group-hover:-rotate-12 transition-all">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.161c-.18.717-3.903 16.324-4.103 17.152-.2.828-.485 1.034-.781 1.058-.646.054-1.137-.432-1.762-.842-.979-.641-1.532-1.04-2.482-1.665-1.099-.723-.387-1.119.24-1.77.164-.17 3.013-2.763 3.068-2.997.007-.029.014-.138-.051-.195-.065-.057-.16-.038-.229-.022-.098.022-1.66 1.056-4.685 3.102-.444.305-.845.454-1.205.446-.395-.01-1.156-.224-1.722-.408-.694-.225-1.246-.345-1.198-.729.025-.2.301-.404.827-.613 3.235-1.411 5.392-2.343 6.474-2.798 3.085-1.294 3.725-1.519 4.142-1.527.092-.001.297.022.43.13.111.091.141.213.155.297.014.084.032.274.017.432z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Telegram</span>
                        </div>
                    </a>

                    {{-- Messenger --}}
                    <a href="https://m.me/yourpage" target="_blank" class="group p-8 bg-white/5 border border-white/10 rounded-[3rem] hover:bg-blue-600/20 hover:border-blue-600/50 transition-all duration-500">
                        <div class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-blue-600/20 text-blue-600 rounded-2xl group-hover:scale-110 transition-all">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.126 0 0 4.708 0 11.23c0 3.394 1.365 6.413 3.593 8.443.187.17.293.407.288.656l-.014 2.193c-.006.915.962 1.503 1.716 1.01l2.454-1.603a.76.76 0 01.52-.102c1.104.305 2.276.47 3.443.47 6.874 0 12-4.708 12-11.23C24 4.708 18.874 0 12 0z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Messenger</span>
                        </div>
                    </a>

                    {{-- Instagram --}}
                    <a href="https://instagram.com/direct/t/yourusername" target="_blank" class="group p-8 bg-white/5 border border-white/10 rounded-[3rem] hover:bg-pink-500/20 hover:border-pink-500/50 transition-all duration-500">
                        <div class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-pink-500/20 text-pink-500 rounded-2xl group-hover:scale-110 transition-all">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Instagram</span>
                        </div>
                    </a>

                    {{-- Line --}}
                    <a href="https://line.me/ti/p/~yourid" target="_blank" class="group p-8 bg-white/5 border border-white/10 rounded-[3rem] hover:bg-lime-500/20 hover:border-lime-500/50 transition-all duration-500">
                        <div class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-lime-500/20 text-lime-500 rounded-2xl group-hover:scale-110 transition-all">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 10.304c0-5.269-5.383-9.556-12-9.556s-12 4.287-12 9.556c0 4.723 4.266 8.672 10.021 9.428l-.711 2.347c-.082.271.19.508.443.342l5.161-3.39c4.276-.641 7.086-4.041 7.086-7.181z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Line</span>
                        </div>
                    </a>

                    {{-- Email Direct --}}
                    <a href="mailto:support@koperasi.id" class="group p-8 bg-blue-600/20 border border-blue-500/50 rounded-[3rem] hover:bg-blue-600 transition-all duration-500">
                        <div class="flex flex-col items-center gap-4">
                            <div class="p-4 bg-white/10 text-white rounded-2xl group-hover:rotate-12 transition-all">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Official Email</span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <footer class="py-12 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">&copy; 2026 DANAKARYA DIGITAL ECOSYSTEM</p>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
        ::selection { background-color: #3b82f6; color: white; }
    </style>
</body>
</html>