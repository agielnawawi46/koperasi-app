@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')

<!-- Wrapper Background -->
<div class="bg-gray-100 p-6 min-h-screen">

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-blue-600">
            <p class="text-gray-500">Total Organisasi</p>
            <h2 class="text-2xl font-bold text-blue-600">12</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-green-600">
            <p class="text-gray-500">Total User</p>
            <h2 class="text-2xl font-bold text-green-600">325</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-yellow-500">
            <p class="text-gray-500">Sistem Aktif</p>
            <h2 class="text-2xl font-bold text-yellow-600">Aktif</h2>
        </div>

    </div>

    <!-- Grafik Aktivitas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="font-semibold mb-4 text-gray-700">Sistem Aktivitas Hari Ini</h2>
            <canvas id="activityTodayChart"></canvas>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="font-semibold mb-4 text-gray-700">Sistem Aktivitas Terbaru</h2>
            <canvas id="activityRecentChart"></canvas>
        </div>

    </div>

    <!-- Statistik Penggunaan Sistem -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="font-semibold mb-4 text-gray-700">Statistik Penggunaan Sistem</h2>
        <canvas id="systemUsageChart"></canvas>
    </div>

</div>

@endsection