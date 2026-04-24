<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#f4f7fa] p-6">
        
        <div class="flex flex-col lg:flex-row bg-white shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] rounded-[3rem] overflow-hidden w-full max-w-5xl border border-slate-100">
            
            <div class="lg:w-1/2 bg-white flex flex-col items-center justify-center p-12 lg:p-20 relative">
                {{-- Soft Background Pattern --}}
                <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e293b 1px, transparent 1px); background-size: 24px 24px;"></div>
                
                <div class="relative z-10 text-center space-y-8">
                    {{-- Logo Asli Tanpa Modifikasi --}}
                    <div class="transition-all duration-700 hover:scale-105">
                        <img src="{{ asset('images/dn.png') }}" alt="DanaKarya Logo" class="h-44 md:h-64 w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.1)]">
                    </div>
                    
                    <div class="space-y-2">
                        <div class="h-1 w-12 bg-blue-600 mx-auto rounded-full"></div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.4em] pt-2">Digital Cooperatives</p>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 bg-slate-50/50 p-10 lg:p-16 border-l border-slate-100 flex flex-col justify-center">
                <div class="max-w-sm mx-auto w-full space-y-8">
                    
                    <div class="text-center lg:text-left">
                        <h3 class="text-3xl font-black text-slate-900 tracking-tighter">Register.</h3>
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Daftarkan akun administrator baru</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Full Name</label>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus
                                class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 outline-none transition-all shadow-sm placeholder:text-slate-300"
                                placeholder="Nama lengkap Anda">
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Official Email</label>
                            <input id="email" type="email" name="email" :value="old('email')" required
                                class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 outline-none transition-all shadow-sm placeholder:text-slate-300"
                                placeholder="email@koperasi.id">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Password</label>
                                <input id="password" type="password" name="password" required
                                    class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 outline-none transition-all shadow-sm placeholder:text-slate-300"
                                    placeholder="••••••••">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Confirm</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 outline-none transition-all shadow-sm placeholder:text-slate-300"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.4em] hover:bg-blue-600 transition-all shadow-lg shadow-blue-900/10">
                                Create Account
                            </button>
                        </div>

                        <div class="pt-6 text-center">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Sudah memiliki akses? 
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-slate-900 font-black transition-colors underline underline-offset-4 decoration-2">Login Kembali</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>