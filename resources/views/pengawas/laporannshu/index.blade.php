@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengawas')
@endsection

@section('content')

    <div class="px-8 py-8 bg-[#f8fafc] min-h-screen space-y-8">

        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Laporan SHU</h1>
            <p class="text-slate-500">Monitoring laporan sisa hasil usaha koperasi.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm p-8">

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b text-slate-400 uppercase text-xs">
                        <th class="py-3 text-left">Tahun</th>
                        <th>Total SHU</th>
                        <th>Dibagikan</th>
                    </tr>
                </thead>

                <tbody class="text-slate-700 font-semibold">

                    <tr class="border-b">
                        <td class="py-3">2025</td>
                        <td>Rp 120.000.000</td>
                        <td>Rp 110.000.000</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>
@endsection