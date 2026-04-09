@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-4 gap-4 mb-6">

    <div class="bg-blue-600 text-white p-4 rounded-xl shadow">
        <p>Total Anggota</p>
        <h2 class="text-xl font-bold">1,250</h2>
    </div>

    <div class="bg-green-600 text-white p-4 rounded-xl shadow">
        <p>Total Simpanan</p>
        <h2 class="text-xl font-bold">Rp 3 M</h2>
    </div>

    <div class="bg-yellow-500 text-white p-4 rounded-xl shadow">
        <p>Total Pinjaman</p>
        <h2 class="text-xl font-bold">Rp 1.5 M</h2>
    </div>

    <div class="bg-gray-700 text-white p-4 rounded-xl shadow">
        <p>SHU Tahun Ini</p>
        <h2 class="text-xl font-bold">Rp 200 JT</h2>
    </div>

</div>

<div class="bg-white p-4 rounded-xl shadow">
    <h2 class="font-bold mb-3">Aktivitas Terbaru</h2>
    <ul class="space-y-2 text-sm">
        <li>✔ Anggota baru mendaftar</li>
        <li>✔ Pinjaman disetujui</li>
        <li>✔ Pembayaran cicilan masuk</li>
    </ul>
</div>

@endsection