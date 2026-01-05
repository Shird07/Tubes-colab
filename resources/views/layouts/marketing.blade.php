<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SmartRec' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white antialiased">

<!-- ================= NAVBAR ================= -->
<header class="px-8 py-6 flex items-center justify-between border-b border-white/10">

    {{-- LOGO (PNG) --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img
            src="{{ asset('img/SmartRec-Logo.png') }}"
            alt="SmartRec Logo"
            style="height:140px; width:auto;"
        >
    </a>

    {{-- NAVIGATION --}}
    <nav class="flex gap-7 text-xl items-center">

        {{-- HOME --}}
        <a href="{{ route('home') }}" class="hover:text-blue-400">
            Home
        </a>

        {{-- AUTHENTICATED USER --}}
        @auth
            <a href="{{ route('rekomendasi') }}" class="hover:text-blue-400">
                Rekomendasi
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="hover:text-blue-400">
                    Dashboard
                </a>
            @endif

            <span class="opacity-70">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="hover:text-red-400">
                    Logout
                </button>
            </form>
        @endauth

        {{-- GUEST --}}
        @guest
            <a href="{{ route('login') }}" class="hover:text-blue-400">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white">
                Register
            </a>
        @endguest

    </nav>
</header>
<!-- ================= END NAVBAR ================= -->

<!-- CONTENT -->
<main>
    @yield('content')
</main>

</body>
</html>
