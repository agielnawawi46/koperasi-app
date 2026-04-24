@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection
@section('content')

<div class="px-6 pt-1 bg-gray-100 min-h-screen space-y-8">

    {{-- ================= Header ================= --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Pengawas</h1>
    </div>

    {{-- ================= Ringkasan ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-gray-700">
            <p class="text-gray-500 text-sm">Total Transaksi</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-1">
                3,200
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-blue-600">
            <p class="text-gray-500 text-sm">Laporan Bulanan</p>
            <h2 class="text-3xl font-bold text-blue-600 mt-1">
                12
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-green-600">
            <p class="text-gray-500 text-sm">Status Sistem</p>
            <h2 class="text-3xl font-bold text-green-600 mt-1">
                Normal
            </h2>
        </div>

    </div>

    {{-- ================= Monitoring Sistem ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="font-semibold text-gray-700 mb-4">
            Monitoring Sistem
        </h2>

        <ul class="space-y-3 text-sm text-gray-700">
            <li class="flex justify-between">
                <span>✔ Transaksi berjalan normal</span>
                <span class="text-green-600">OK</span>
            </li>
            <li class="flex justify-between">
                <span>✔ Tidak ada anomali pinjaman</span>
                <span class="text-green-600">OK</span>
            </li>
            <li class="flex justify-between">
                <span>✔ Sistem aktif</span>
                <span class="text-green-600">OK</span>
            </li>
        </ul>
    </div>

    {{-- ================= Akses Cepat Laporan ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="font-semibold text-gray-700 mb-4">
            Akses Laporan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a class="bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg">
                Laporan Transaksi
            </a>

            <a class="bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg">
                Laporan Simpanan
            </a>

            <a class="bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg">
                Laporan Pinjaman
            </a>
        </div>
    </div>

</div>

@endsection