<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-16">

        <h1 class="text-3xl font-semibold mb-2 text-white">
            Selamat datang, {{ auth()->user()->name }} 👋
        </h1>

        <p class="text-slate-400 mb-10">
            Apa yang ingin kamu lakukan hari ini?
        </p>

        <div class="grid md:grid-cols-3 gap-6">

            {{-- Rekomendasi --}}
            <a href="{{ route('rekomendasi') }}"
               class="p-6 rounded-xl border border-white/10 bg-slate-900/50
               hover:bg-slate-900 hover:border-indigo-400
               transition-all duration-300 group">

                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/20
                                flex items-center justify-center text-indigo-400">
                        🔍
                    </div>
                    <h2 class="text-lg font-semibold text-slate-300 group-hover:text-white transition">
                        Mulai Rekomendasi
                    </h2>
                </div>

                <p class="text-sm text-slate-400">
                    Cari smartphone terbaik sesuai kebutuhanmu.
                </p>
            </a>

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="p-6 rounded-xl border border-white/10 bg-slate-900/50
               hover:bg-slate-900 hover:border-indigo-400
               transition-all duration-300 group">

                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/20
                                flex items-center justify-center text-indigo-400">
                        📊
                    </div>
                    <h2 class="text-lg font-semibold text-slate-300 group-hover:text-white transition">
                        Lihat Dashboard
                    </h2>
                </div>

                <p class="text-sm text-slate-400">
                    Visualisasi & insight data smartphone.
                </p>
            </a>

            {{-- Admin --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('smartphones.index') }}"
               class="p-6 rounded-xl border border-white/10 bg-slate-900/50
               hover:bg-slate-900 hover:border-indigo-400
               transition-all duration-300 group">

                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/20
                                flex items-center justify-center text-indigo-400">
                        ⚙️
                    </div>
                    <h2 class="text-lg font-semibold text-slate-300 group-hover:text-white transition">
                        Kelola Smartphone
                    </h2>
                </div>

                <p class="text-sm text-slate-400">
                    Tambah, ubah, dan hapus data smartphone.
                </p>
            </a>
            @endif

        </div>
    </div>
</x-app-layout>
