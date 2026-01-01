<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SmartRec' }}</title>

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white antialiased">

<!-- NAVBAR -->
<header class="px-8 py-6 flex items-center justify-between border-b border-white/10">
    <div class="text-xl font-bold">SmartRec</div>

    <nav class="flex gap-6 text-sm">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('rekomendasi') }}">Rekomendasi</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>

        @auth
            <span class="opacity-70">{{ auth()->user()->name }}</span>
        @else
            <a href="{{ route('login') }}" class="font-semibold">Login</a>
        @endauth
    </nav>
</header>

<!-- CONTENT -->
<main>
    @yield('content')
</main>

</body>
</html>
