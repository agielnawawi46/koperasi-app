<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DanaKarya - Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
<div class="flex min-h-screen">

    {{-- Sidebar akan diisi oleh layout turunan --}}
    @yield('sidebar')

    <!-- Konten -->
    <div class="flex-1 flex flex-col">

        @include('layouts.partials.header')

        <main class="flex-1 p-6">
            @yield('content')
        </main>

        @include('layouts.partials.footer')

    </div>
</div>
</body>
</html>