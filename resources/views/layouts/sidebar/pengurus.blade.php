<aside class="w-64 min-h-screen bg-blue-900 text-white flex flex-col">

    <!-- Logo -->
    <div class="bg-white shadow h-20 flex items-center justify-center">
        <img 
            src="{{ asset('images/DanaKarya.png') }}" 
            alt="DanaKarya Logo" 
            class="h-16 object-contain"
        >
    </div>

    <!-- Menu -->
    <nav class="space-y-5 p-5">
        <a href="#" class="block p-3 rounded hover:bg-white/20">Dashboard</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">Manajemen Anggota</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">Manajemen Simpanan</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">Manajemen Pinjaman</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">manajemen Angsuran</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">Perhitungan & Distribusi SHU</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">Laporan Keuangan</a>
        <a href="#" class="block p-2 rounded hover:bg-white/20">Pengaturan</a>
    </nav>

    <!-- Footer Sidebar (selalu di bawah) -->
    <div class="mt-auto shadow h-16 flex items-center justify-center text-white">
        <p>
            © {{ date('Y') }} <span class="font-semibold">DanaKarya</span>
        </p>
    </div>

</aside>