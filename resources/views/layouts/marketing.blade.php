<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SmartRec</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white">

    {{-- NAVBAR --}}
    <nav class="flex justify-between px-10 py-6">
        <span class="font-bold">SmartRec</span>
        <div class="space-x-6">
            <a href="/">Home</a>
            <a href="/rekomendasi">Rekomendasi</a>
            <a href="/dashboard">Dashboard</a>
            @auth
                <span>{{ auth()->user()->name }}</span>
            @else
                <a href="/login">Login</a>
            @endauth
        </div>
    </nav>

    {{-- CONTENT --}}
    <main class="px-10 py-16">
        @yield('content')
    </main>

</body>
</html>
