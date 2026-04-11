<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
        <!-- Container utama: logo + form -->
        <div class="flex flex-col md:flex-row items-center bg-white shadow-xl rounded-lg p-8 w-full max-w-4xl">
            
            <!-- Logo + Tagline -->
            <div class="flex flex-col items-center justify-center md:w-1/2 mb-6 md:mb-0 md:pr-8 border-b md:border-b-0 md:border-r">
                <img src="{{ asset('images/dn.png') }}" alt="DanaKarya Logo" class="h-60 mb-4">
                <p class="text-gray-500 text-xs mt-1 text-center max-w-xs">
                    Platform Koperasi Modern
                </p>
                <p class="text-gray-500 text-xs mt-1 text-center max-w-xs">
                    yang Transparan dan Terpercaya
                </p>
            </div>

            <!-- Card Form -->
            <div class="md:w-1/2 w-full md:pl-8">
                <h2 class="text-xl font-bold text-center mb-6 text-green-700">Login</h2>

                <form>
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input id="email" type="email" name="email"
                               class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-green-300"
                               placeholder="Masukkan email Anda">
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                        <input id="password" type="password" name="password"
                               class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-green-300"
                               placeholder="Masukkan password">
                    </div>

                    <!-- Tombol -->
                    <button type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                        Login
                    </button>

                    <!-- Link ke Register -->
                    <p class="text-sm text-center mt-4 text-gray-500">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar disini</a>, hanya admin
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>