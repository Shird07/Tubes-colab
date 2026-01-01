<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>SmartRec — Smartphone Recommendation</title>

    {{-- CSS dari template --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100">

    <!-- NAVBAR -->
    <header class="border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <div class="text-xl font-bold tracking-wide">
                SmartRec
            </div>

            <nav class="flex items-center gap-6 text-sm">
                <a href="{{ route('home') }}" class="hover:text-indigo-400">Home</a>
                <a href="{{ route('rekomendasi') }}" class="hover:text-indigo-400">Rekomendasi</a>
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-400">Dashboard</a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('smartphones.index') }}"
                           class="text-indigo-400 font-semibold">
                            Admin
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="ml-4 px-4 py-2 bg-slate-800 rounded hover:bg-slate-700">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700">
                        Login
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-20">
        @yield('content')
    </main>

</body>
</html>
