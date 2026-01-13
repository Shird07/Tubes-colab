<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SmartRec' }}</title>
    <style>
        .reveal {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s ease;
        }
        .reveal.active {
        opacity: 1;
        transform: translateY(0);
        }
    </style>


    ##-------------------------------- BRAND PARTNERS ------------------------------##
    <style>
        .brand-card.show {
            opacity: 1;
            transform: scale(1);
        }
    </style>

    <style>
        @keyframes marquee {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        .brand-marquee-track {
            animation: marquee 35s linear infinite;
        }

        .brand-marquee-track:hover {
            animation-play-state: paused;
        }
    </style>

    <style>
        @keyframes marquee-left {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes marquee-right {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }

        .marquee-left {
            animation: marquee-left 35s linear infinite;
        }

        .marquee-right {
            animation: marquee-right 45s linear infinite;
        }

        /* Pause on hover */
        .marquee:hover {
            animation-play-state: paused;
        }
    </style>


    <style>
/* Fade kiri & kanan */
.fade-mask::before,
.fade-mask::after {
    content: "";
    position: absolute;
    top: 0;
    width: 120px;
    height: 100%;
    z-index: 10;
    pointer-events: none;
}

/* Kiri */
.fade-mask::before {
    left: 0;
    background: linear-gradient(
        to right,
        white 0%,
        rgba(255,255,255,0) 100%
    );
}

/* Kanan */
.fade-mask::after {
    right: 0;
    background: linear-gradient(
        to left,
        white 0%,
        rgba(255,255,255,0) 100%
    );
}
</style>

<style>
html, body {
    overflow-x: hidden;
}
</style>



    ##----------------------------------------------------------------------------------##

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    {{-- VITE WAJIB ADA DI LAYOUT --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-white antialiased font-[Inter]">


    <!-- ================= NAVBAR ================= -->
     <header id="navbar"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300
            px-8 py-3 flex items-center justify-between
            bg-slate-950/80 backdrop-blur border-b border-white/10">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('img/logo.png') }}" class="h-6 w-auto">
            <span class="text-xl font-bold text-indigo-400">
                SmartRec
            </span>
        </a>

        <!-- MENU -->
        <nav class="flex gap-5 text-base items-center">
            <a href="{{ route('home') }}" class="hover:text-indigo-400 transition">Home</a>
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-400 transition">Dashboard</a>
            <a href="{{ route('rekomendasi') }}" class="hover:text-indigo-400 transition">Rekomendasi</a>
        </nav>
    </header>

<!-- ================= END NAVBAR ================= -->


    <!-- CONTENT -->
    <main class="pt-28">
        @yield('content')
    </main>

    <footer class="bg-slate-900 border-t border-white/10 py-16">
        <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-4 gap-10 text-slate-400">

            <!-- BRAND -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4">SmartRec</h3>
                <p class="text-sm leading-relaxed">
                    Platform rekomendasi smartphone berbasis sistem pakar
                    untuk membantu pengguna memilih perangkat terbaik
                    sesuai kebutuhan secara objektif.
                </p>
            </div>

            <!-- NAVIGATION -->
            <div>
                <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-indigo-400">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-indigo-400">Tentang</a></li>
                    <li><a href="{{ route('rekomendasi') }}" class="hover:text-indigo-400">Rekomendasi</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div>
                <h4 class="text-white font-semibold mb-4">Kontak</h4>
                <ul class="space-y-2 text-sm">
                    <li>Email: <a href="mailto:contact@smartrec.id" class="hover:text-indigo-400">contact@smartrec.id</a></li>
                    <li>WhatsApp: <span class="text-slate-300">+62 812-3456-7890</span></li>
                    <li>Lokasi: Indonesia</li>
                </ul>
            </div>

            <!-- POWERED -->
            <div>
                <h4 class="text-white font-semibold mb-4">Powered By</h4>
                <p class="text-sm">
                    Cinta 
                </p>
            </div>

        </div>

        <div class="mt-12 text-center text-sm text-slate-500">
            © {{ date('Y') }} SmartRec. All rights reserved.
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const reveals = document.querySelectorAll('.reveal');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            } else {
                entry.target.classList.remove('active');
            }
            });
        }, { threshold: 0.15 });

        reveals.forEach(r => observer.observe(r));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navbar = document.getElementById('navbar');

            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add(
                        'bg-slate-900',
                        'shadow-lg',
                        'border-white/20'
                    );
                } else {
                    navbar.classList.remove(
                        'bg-slate-900',
                        'shadow-lg',
                        'border-white/20'
                    );
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const brandCards = document.querySelectorAll('.brand-card');

            const observer = new IntersectionObserver(entries => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('show');
                        }, index * 120);
                    }
                });
            }, { threshold: 0.2 });

            brandCards.forEach(card => observer.observe(card));
        });
    </script>




</body>
</html>
