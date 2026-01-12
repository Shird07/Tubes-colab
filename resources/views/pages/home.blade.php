@extends('layouts.marketing')

@section('content')

<!-- ================= HERO ================= -->
<section class="pt-28 pb-24">
    <div class="max-w-7xl mx-auto px-8 grid lg:grid-cols-2 gap-16 items-center">

        <!-- LEFT -->
        <div>
            <span class="inline-block mb-4 px-4 py-2 text-sm font-medium bg-indigo-500/10 text-indigo-400 rounded-full">
                Sistem Pakar Rekomendasi Smartphone
            </span>

            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                Pilih Smartphone
                <span class="text-indigo-400">Paling Tepat</span><br>
                Sesuai Kebutuhan Anda
            </h1>

            <p class="mt-6 text-lg text-slate-300 max-w-xl">
                SmartRec membantu pengguna menentukan smartphone terbaik secara objektif
                menggunakan sistem pakar berbasis budget, kamera, dan baterai.
            </p>

            <div class="mt-10 flex gap-4">
                <a href="{{ route('rekomendasi') }}"
                   class="px-8 py-4 rounded-xl bg-indigo-500 text-white font-semibold hover:bg-indigo-600 transition">
                    Mulai Rekomendasi Gratis
                </a>

                <a href="{{ route('login') }}"
                   class="px-8 py-4 rounded-xl border border-white/20 text-white hover:border-indigo-400 hover:text-indigo-400 transition">
                    Login
                </a>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="bg-slate-900 border border-white/10 rounded-2xl p-10">
            <ul class="space-y-6 text-slate-300">
                <li class="flex gap-4">
                    <span class="text-indigo-400 font-bold">✓</span>
                    Rule-based sistem pakar
                </li>
                <li class="flex gap-4">
                    <span class="text-indigo-400 font-bold">✓</span>
                    Analisis multikriteria
                </li>
                <li class="flex gap-4">
                    <span class="text-indigo-400 font-bold">✓</span>
                    Hasil objektif & cepat
                </li>
            </ul>
        </div>

    </div>
</section>

<!-- ================= PROBLEM ================= -->
<section class="py-24 bg-slate-900/40">
    <div class="max-w-6xl mx-auto px-8 text-center">
        <h2 class="text-3xl font-bold mb-12">
            Tantangan Memilih Smartphone
        </h2>

        <div class="grid md:grid-cols-3 gap-10 text-slate-300">
            <div>
                <h4 class="font-semibold text-lg text-white">
                    Terlalu Banyak Pilihan
                </h4>
                <p class="mt-3">
                    Ratusan model smartphone membuat pengguna bingung menentukan pilihan.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-lg text-white">
                    Informasi Tidak Objektif
                </h4>
                <p class="mt-3">
                    Review sering bias promosi dan tidak sesuai kebutuhan nyata.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-lg text-white">
                    Salah Menentukan Prioritas
                </h4>
                <p class="mt-3">
                    Spesifikasi tinggi belum tentu sesuai penggunaan sehari-hari.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= SOLUSI ================= -->
<section class="py-24">
    <div class="max-w-6xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold">
                Solusi Berbasis Sistem Pakar
            </h2>
            <p class="mt-4 text-slate-300 max-w-2xl mx-auto">
                SmartRec menggabungkan data smartphone dan aturan sistem pakar
                untuk menghasilkan rekomendasi yang terukur dan transparan.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            <div class="bg-slate-900 border border-white/10 rounded-xl p-8">
                <h3 class="font-semibold text-lg mb-3">Rule-Based Engine</h3>
                <p class="text-slate-300">
                    Setiap rekomendasi dihasilkan dari aturan dan bobot kriteria.
                </p>
            </div>

            <div class="bg-slate-900 border border-white/10 rounded-xl p-8">
                <h3 class="font-semibold text-lg mb-3">Analisis Multikriteria</h3>
                <p class="text-slate-300">
                    Budget, kamera, dan baterai dianalisis secara bersamaan.
                </p>
            </div>

            <div class="bg-slate-900 border border-white/10 rounded-xl p-8">
                <h3 class="font-semibold text-lg mb-3">Hasil Transparan</h3>
                <p class="text-slate-300">
                    Rekomendasi dapat ditelusuri secara logis.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= CTA ================= -->
<section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Siap Temukan Smartphone Ideal Anda?
        </h2>

        <p class="text-xl text-indigo-100 mb-10">
            Gunakan sistem rekomendasi kami untuk hasil yang objektif dan cepat.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('rekomendasi') }}"
               class="px-10 py-4 text-lg font-semibold rounded-lg bg-white text-indigo-600 hover:bg-gray-100 transition">
                🔍 Mulai Sekarang
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-10 py-4 text-lg font-semibold rounded-lg border-2 border-white text-white hover:bg-white/10 transition">
                    📝 Daftar Akun
                </a>
            @endif
        </div>

        <p class="mt-6 text-indigo-200">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold underline">
                Login di sini
            </a>
        </p>
    </div>
</section>

@endsection
