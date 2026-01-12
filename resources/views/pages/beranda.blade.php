<x-app-layout>
    <!-- Hero Banner (seperti OPPO) -->
    <div class="relative bg-gradient-to-r from-purple-900 via-blue-800 to-blue-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-16 sm:py-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="z-10">
                    <h1 class="text-5xl font-bold mb-4 leading-tight">
                        Selamat datang, 
                        <span class="text-cyan-300">{{ auth()->user()->name }}</span> 👋
                    </h1>
                    <p class="text-xl text-gray-200 mb-8">
                        Sistem rekomendasi smartphone terbaik untuk kebutuhan Anda. 
                        Temukan ponsel sempurna sesuai budget dan preferensi.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('rekomendasi') }}" 
                           class="px-8 py-3 bg-white text-blue-900 font-semibold rounded-full hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg">
                            🚀 Mulai Rekomendasi
                        </a>
                        <a href="{{ route('dashboard') }}" 
                           class="px-8 py-3 border-2 border-white text-white font-semibold rounded-full hover:bg-white/10 transition duration-300">
                            📈 Lihat Dashboard
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-8 -left-10 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
                    <div class="relative z-10">
                        <!-- Ilustrasi smartphone atau gambar hero -->
                        <div class="bg-gradient-to-br from-cyan-500/20 to-purple-500/20 rounded-3xl p-8 backdrop-blur-sm border border-white/20">
                            <div class="text-center">
                                <div class="text-6xl mb-4">📱</div>
                                <h3 class="text-2xl font-bold mb-2">SmartRec AI</h3>
                                <p class="text-gray-300">Rekomendasi berbasis AI untuk pengalaman terbaik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Quick Actions dengan Card gaya OPPO -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Apa yang ingin kamu lakukan hari ini?
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Pilih akses cepat ke fitur utama SmartRec
            </p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1: Rekomendasi -->
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 p-8 text-white shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="absolute top-4 right-4 opacity-20">
                        <span class="text-6xl">🔍</span>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-3xl">🔍</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Mulai Rekomendasi</h3>
                        <p class="text-blue-100 mb-6">
                            Temukan smartphone terbaik sesuai dengan kebutuhan dan budget Anda melalui sistem AI kami.
                        </p>
                        <a href="{{ route('rekomendasi') }}" 
                           class="inline-flex items-center text-white font-semibold hover:text-cyan-200 transition">
                            Jelajahi sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/30 to-transparent transform translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </div>

                <!-- Card 2: Dashboard -->
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 p-8 text-white shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="absolute top-4 right-4 opacity-20">
                        <span class="text-6xl">📊</span>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-3xl">📊</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Lihat Dashboard</h3>
                        <p class="text-purple-100 mb-6">
                            Analisis data lengkap dengan visualisasi interaktif untuk insight yang lebih mendalam.
                        </p>
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center text-white font-semibold hover:text-pink-200 transition">
                            Buka dashboard
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/30 to-transparent transform translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </div>

                <!-- Card 3: Manage (Admin only) -->
                @if(auth()->user()->role === 'admin')
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-green-500 p-8 text-white shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="absolute top-4 right-4 opacity-20">
                        <span class="text-6xl">⚙️</span>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-3xl">⚙️</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Kelola Smartphone</h3>
                        <p class="text-emerald-100 mb-6">
                            Kelola database smartphone dengan mudah. Tambah, edit, dan hapus data produk.
                        </p>
                        <a href="{{ route('smartphones.index') }}" 
                           class="inline-flex items-center text-white font-semibold hover:text-green-200 transition">
                            Kelola sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/30 to-transparent transform translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </div>
                @endif
            </div>
        </div>

        <!-- Featured Smartphones Section (gaya OPPO) -->
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Smartphone Populer</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Rekomendasi terbaik minggu ini</p>
                </div>
                <a href="{{ route('rekomendasi') }}" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">
                    Lihat semua →
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-cyan-100 dark:from-blue-900/30 dark:to-cyan-900/30 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <span class="text-5xl">📱</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Samsung Galaxy S24</h3>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ★★★★☆
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">(4.5)</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Flagship terbaru dengan kamera AI dan performa maksimal
                        </p>
                        <div class="text-blue-600 dark:text-blue-400 font-bold">Rp 12.999.000</div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <div class="w-32 h-32 bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <span class="text-5xl">📱</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">OPPO Find N5</h3>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">(4.8)</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Foldable premium dengan desain inovatif
                        </p>
                        <div class="text-blue-600 dark:text-blue-400 font-bold">Rp 19.999.000</div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <div class="w-32 h-32 bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <span class="text-5xl">📱</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">iPhone 15 Pro</h3>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">(4.7)</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Performa Apple terbaik dengan chip A17 Pro
                        </p>
                        <div class="text-blue-600 dark:text-blue-400 font-bold">Rp 21.999.000</div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex justify-center mb-4">
                            <div class="w-32 h-32 bg-gradient-to-br from-orange-100 to-red-100 dark:from-orange-900/30 dark:to-red-900/30 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <span class="text-5xl">📱</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Xiaomi 14</h3>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                ★★★★☆
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">(4.3)</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Flagship killer dengan harga kompetitif
                        </p>
                        <div class="text-blue-600 dark:text-blue-400 font-bold">Rp 9.999.000</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-gradient-to-r from-gray-900 to-black dark:from-gray-800 dark:to-gray-900 rounded-3xl p-8 text-white mb-16">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-gray-300">Smartphone</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-gray-300">Brand</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">10K+</div>
                    <div class="text-gray-300">Pengguna</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">95%</div>
                    <div class="text-gray-300">Kepuasan</div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center py-12">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Siap temukan smartphone impian Anda?
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                Gunakan sistem rekomendasi AI kami untuk mendapatkan pilihan terbaik sesuai kebutuhan dan budget.
            </p>
            <a href="{{ route('rekomendasi') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold rounded-full hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <span class="mr-2">🚀</span>
                Mulai Sekarang Gratis
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <div class="border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">SmartRec</div>
                    <div class="text-gray-600 dark:text-gray-400">Intelligent Recommendations</div>
                </div>
                <div class="text-center md:text-right">
                    <div class="text-gray-600 dark:text-gray-400 mb-2">
                        🕒 {{ now()->format('H:i') }} | 📅 {{ now()->format('d/m/Y') }}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-500">
                        © {{ date('Y') }} SmartRec. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</x-app-layout>