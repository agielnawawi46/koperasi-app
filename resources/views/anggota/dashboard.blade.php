@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Anggota</h1>

<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-green-600 text-white p-4 rounded-xl">
        <p>Simpanan Saya</p>
        <h2 class="text-xl font-bold">Rp 10.000.000</h2>
    </div>

    <div class="bg-yellow-500 text-white p-4 rounded-xl">
        <p>Pinjaman Saya</p>
        <h2 class="text-xl font-bold">Rp 5.000.000</h2>
    </div>

    <div class="bg-blue-600 text-white p-4 rounded-xl">
        <p>Cicilan Bulanan</p>
        <h2 class="text-xl font-bold">Rp 500.000</h2>
    </div>

</div>

<div class="bg-white p-4 rounded-xl shadow">
    <h2 class="font-bold mb-3">Riwayat Transaksi</h2>
    <ul class="text-sm space-y-2">
        <li>✔ Simpanan masuk Rp 1.000.000</li>
        <li>✔ Cicilan dibayar Rp 500.000</li>
    </ul>
</div>

@endsection