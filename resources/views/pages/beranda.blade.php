<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Greeting --}}
        <h1 class="text-2xl font-semibold mb-2 text-white">
            Selamat datang, {{ auth()->user()->name }} 👋
        </h1>

        <p class="text-gray-500 mb-8">
            Apa yang ingin kamu lakukan hari ini?
        </p>

        {{-- Quick Actions --}}
        <div class="grid md:grid-cols-3 gap-6">

            {{-- Rekomendasi --}}
            <a href="{{ route('rekomendasi') }}" class="p-6 rounded-xl border border-gray-700 bg-gray-900/40
          hover:bg-white hover:border-transparent
          transition-all duration-300 group">

                <h2 class="text-lg font-semibold mb-1 
               text-gray-300 group-hover:text-gray-900 transition">
                    🔍 Mulai Rekomendasi
                </h2>

                <p class="text-sm 
              text-gray-400 group-hover:text-gray-600 transition">
                    Cari smartphone terbaik sesuai kebutuhanmu.
                </p>

            </a>


            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}" class="p-6 rounded-xl border border-gray-700 bg-gray-900/40
          hover:bg-white hover:border-transparent
          transition-all duration-300 group">

                <h2 class="text-lg font-semibold mb-1 text-gray-300 group-hover:text-gray-900 transition">
                    📊 Lihat Dashboard
                </h2>

                <p class="text-sm text-gray-400 group-hover:text-gray-600 transition">
                    Visualisasi & insight data smartphone.
                </p>

            </a>


            {{-- Admin Only --}}
            @if(auth()->user()->role === 'admin')
                    <a href="{{ route('smartphones.index') }}" class="p-6 rounded-xl border border-gray-700 bg-gray-900/40
                  hover:bg-white hover:border-transparent
                  transition-all duration-300 group">

                        <h2 class="text-lg font-semibold mb-1 text-gray-300 group-hover:text-gray-900 transition">
                            ⚙️ Kelola Smartphone
                        </h2>

                        <p class="text-sm text-gray-400 group-hover:text-gray-600 transition">
                            Tambah, ubah, dan hapus data smartphone.
                        </p>

                    </a>

            @endif

        </div>
    </div>
</x-app-layout>