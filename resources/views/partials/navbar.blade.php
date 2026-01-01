<nav class="border-b border-slate-800 bg-slate-950">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <div class="font-bold text-lg tracking-wide">
            📱 SmartRec
        </div>

        <div class="flex gap-6 text-sm">
            <a href="/" class="hover:text-blue-400">Home</a>
            <a href="/rekomendasi" class="hover:text-blue-400">Rekomendasi</a>
            <a href="/dashboard" class="hover:text-blue-400">Dashboard</a>
            <a href="/about" class="hover:text-blue-400">Tentang</a>
        </div>

        <div class="text-sm">
            @auth
                {{ auth()->user()->name }}
            @else
                <a href="/login" class="hover:text-blue-400">Login</a>
            @endauth
        </div>

    </div>
</nav>
