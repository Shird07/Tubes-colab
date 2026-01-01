<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Smartphone Recommendation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100">

    <nav class="bg-gray-900 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">
            <span class="font-bold text-lg">SmartRec</span>
            <div class="space-x-4">
                <a href="/" class="hover:text-blue-400">Home</a>
                <a href="/rekomendasi" class="hover:text-blue-400">Rekomendasi</a>
                <a href="/dashboard" class="hover:text-blue-400">Dashboard</a>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

</body>
</html>
