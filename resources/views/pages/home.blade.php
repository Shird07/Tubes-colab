@extends('layouts.marketing')

@section('content')
<section class="pt-24 lg:pt-28">
    <div class="w-full px-10 lg:px-16">

        <div class="max-w-3xl">
            <h1 class="text-5xl font-bold mb-6">
                Sistem Rekomendasi Smartphone
            </h1>

            <p class="text-gray-400 mb-8">
                Platform berbasis sistem pakar untuk membantu pengguna memilih smartphone
                terbaik berdasarkan <strong>budget</strong>, <strong>kamera</strong>, dan <strong>baterai</strong>.
            </p>

            <div class="flex gap-4">
                <a href="/rekomendasi"
                   class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-lg">
                    Mulai Rekomendasi
                </a>

                <a href="{{ route('login') }}"
                   class="px-6 py-3 rounded-lg border border-white/20 hover:bg-white/10">
                    Login
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
