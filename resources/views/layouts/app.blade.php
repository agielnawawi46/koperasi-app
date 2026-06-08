<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DanaKarya</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-gray-100 antialiased">
<div class="flex min-h-screen w-full overflow-x-clip">

    {{-- Sidebar akan diisi oleh layout turunan --}}
    @yield('sidebar')

    <div class="flex-1 min-w-0 flex flex-col overflow-x-clip">

        @include('layouts.partials.header')

        <main class="flex-1 bg-[#f8fafc]">
            @yield('content')
        </main>

        @include('layouts.partials.footer')

    </div>
</div>
@stack('modals')
</body>
</html>