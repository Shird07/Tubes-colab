@extends('layouts.marketing')

@section('content')
<!-- Hero Section -->
<section class="pt-24 lg:pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                Sistem Rekomendasi<br>
                <span class="text-indigo-600">Smartphone Terbaik</span>
            </h1>
            
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10">
                Platform berbasis sistem pakar untuk membantu Anda memilih smartphone
                terbaik berdasarkan <strong class="text-gray-800">budget</strong>, 
                <strong class="text-gray-800">kamera</strong>, dan 
                <strong class="text-gray-800">baterai</strong>.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('rekomendasi') }}"
                   class="inline-flex items-center justify-center px-8 py-3 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition duration-300">
                    🔍 Mulai Rekomendasi
                </a>
                
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center px-8 py-3 text-base font-medium rounded-md text-indigo-600 bg-white border border-indigo-600 hover:bg-indigo-50 md:py-4 md:text-lg md:px-10 transition duration-300">
                    👤 Login
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kenapa Memilih SmartRec?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Solusi cerdas untuk menemukan smartphone ideal sesuai kebutuhan Anda
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                    <span class="text-2xl">💰</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Budget Sesuai</h3>
                <p class="text-gray-600">
                    Temukan smartphone terbaik dalam rentang harga yang Anda tentukan.
                    Tidak perlu khawatir melebihi budget.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                    <span class="text-2xl">📸</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kamera Terbaik</h3>
                <p class="text-gray-600">
                    Rekomendasi berdasarkan kualitas kamera yang Anda butuhkan,
                    dari harian hingga profesional.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                    <span class="text-2xl">🔋</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Baterai Tahan Lama</h3>
                <p class="text-gray-600">
                    Smartphone dengan ketahanan baterai optimal sesuai penggunaan Anda,
                    baik untuk gaming atau produktivitas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Cara Kerja SmartRec
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Hanya 3 langkah sederhana untuk mendapatkan rekomendasi terbaik
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                    1
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Tentukan Kriteria</h3>
                <p class="text-gray-600">
                    Pilih budget, spesifikasi kamera, dan kebutuhan baterai sesuai preferensi Anda.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                    2
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Analisis Sistem Pakar</h3>
                <p class="text-gray-600">
                    Sistem kami menganalisis ratusan smartphone berdasarkan kriteria yang Anda berikan.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-indigo-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                    3
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Dapatkan Rekomendasi</h3>
                <p class="text-gray-600">
                    Terima rekomendasi smartphone terbaik yang paling cocok dengan kebutuhan Anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Siap Temukan Smartphone Ideal Anda?
        </h2>
        <p class="text-xl text-indigo-100 mb-10 max-w-3xl mx-auto">
            Bergabung dengan ribuan pengguna yang telah menemukan smartphone sempurna
            dengan bantuan sistem rekomendasi kami.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('rekomendasi') }}"
               class="inline-flex items-center justify-center px-8 py-3 text-lg font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-100 md:py-4 md:text-xl md:px-12 transition duration-300 shadow-lg">
                🔍 Mulai Sekarang - Gratis!
            </a>
            
            @if(Route::has('register'))
            <a href="{{ route('register') }}"
               class="inline-flex items-center justify-center px-8 py-3 text-lg font-medium rounded-md text-white border-2 border-white hover:bg-white/10 md:py-4 md:text-xl md:px-12 transition duration-300">
                📝 Daftar Akun
            </a>
            @endif
        </div>
        
        <p class="mt-6 text-indigo-200">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">
                Login di sini
            </a>
        </p>
    </div>
</section>

<!-- Footer/Additional Info -->
<footer class="py-10 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0">
                <span class="text-2xl font-bold text-gray-900">SmartRec</span>
                <p class="text-gray-600 mt-2">Sistem Rekomendasi Smartphone Terbaik © 2024</p>
            </div>
            
            <div class="flex gap-6">
                <a href="/about" class="text-gray-600 hover:text-indigo-600">
                    Tentang Kami
                </a>
                <a href="#" class="text-gray-600 hover:text-indigo-600">
                    Kebijakan Privasi
                </a>
                <a href="#" class="text-gray-600 hover:text-indigo-600">
                    Syarat Layanan
                </a>
                <a href="mailto:contact@smartrec.com" class="text-gray-600 hover:text-indigo-600">
                    Kontak
                </a>
            </div>
        </div>
    </div>
</footer>
@endsection