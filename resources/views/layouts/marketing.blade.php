<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SmartRec' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    {{-- VITE WAJIB ADA DI LAYOUT --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white antialiased font-[Inter]">


    <!-- ================= NAVBAR ================= -->
    <header class="px-8 py-6 flex items-center justify-between border-b border-white/10">

    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-400">
        SmartRec
    </a>

    <nav class="flex gap-6 text-lg items-center">
        <a href="{{ route('home') }}" class="hover:text-blue-400">Home</a>
        <a href="{{ route('about') }}" class="hover:text-blue-400">Tentang</a>
    </nav>

</header>

    <!-- ================= END NAVBAR ================= -->

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

</body>
</html>
