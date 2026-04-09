<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DanaKarya</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    {{-- HEADER --}}
    @include('layouts.partials.header')

    <div class="flex">

        {{-- SIDEBAR --}}
        @php
            $role = $role ?? 'nulls'; // dummy role
        @endphp

        @if($role == 'admin')
            @include('layouts.sidebar.admin')
        @elseif($role == 'pengurus')
            @include('layouts.sidebar.pengurus')
        @elseif($role == 'pengawas')
            @include('layouts.sidebar.pengawas')
        @elseif($role == 'anggota')
            @include('layouts.sidebar.anggota')
        @endif

        {{-- CONTENT --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

    {{-- FOOTER --}}
    @include('layouts.partials.footer')

</body>
</html>