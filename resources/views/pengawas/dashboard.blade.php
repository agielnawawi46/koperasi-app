@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Pengawas</h1>

<div class="grid grid-cols-2 gap-4 mb-6">

    <div class="bg-gray-700 text-white p-4 rounded-xl">
        <p>Total Transaksi</p>
        <h2 class="text-xl font-bold">3,200</h2>
    </div>

    <div class="bg-blue-600 text-white p-4 rounded-xl">
        <p>Laporan Bulanan</p>
        <h2 class="text-xl font-bold">12</h2>
    </div>

</div>

<div class="bg-white p-4 rounded-xl shadow">
    <h2 class="font-bold mb-3">Monitoring</h2>
    <p class="text-sm">Semua transaksi berjalan normal ✔</p>
</div>

@endsection