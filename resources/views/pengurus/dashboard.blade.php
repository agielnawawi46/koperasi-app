@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Pengurus</h1>

<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-green-600 text-white p-4 rounded-xl">
        <p>Simpanan Masuk</p>
        <h2 class="text-xl font-bold">Rp 500 JT</h2>
    </div>

    <div class="bg-yellow-500 text-white p-4 rounded-xl">
        <p>Pengajuan Pinjaman</p>
        <h2 class="text-xl font-bold">25</h2>
    </div>

    <div class="bg-blue-600 text-white p-4 rounded-xl">
        <p>Cicilan Aktif</p>
        <h2 class="text-xl font-bold">120</h2>
    </div>

</div>

<div class="bg-white p-4 rounded-xl shadow">
    <h2 class="font-bold mb-3">Daftar Pengajuan</h2>
    <table class="w-full text-sm">
        <tr class="border-b">
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>Budi</td>
            <td>Rp 5.000.000</td>
            <td class="text-yellow-500">Pending</td>
        </tr>
    </table>
</div>

@endsection