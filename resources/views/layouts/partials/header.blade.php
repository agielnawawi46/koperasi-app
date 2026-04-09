<header class="bg-white shadow p-4 flex justify-between items-center">

    <h1 class="text-xl font-bold text-blue-800">
        DanaKarya
    </h1>

    <div class="flex items-center gap-4">
        <span>{{ auth()->user()->name ?? 'Guest' }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500">Logout</button>
        </form>
    </div>

</header>