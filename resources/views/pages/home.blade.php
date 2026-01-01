@extends('layouts.marketing')

@section('content')
<section class="grid md:grid-cols-2 gap-10 items-center">
    <div>
        <h1 class="text-5xl font-bold mb-6">
            Sistem Rekomendasi Smartphone
        </h1>
        <p class="text-gray-400 mb-8">
            Berbasis metode pakar dan multi-kriteria
            untuk membantu memilih smartphone terbaik.
        </p>

        <a href="/rekomendasi"
           class="bg-indigo-600 px-6 py-3 rounded-lg">
            Mulai Rekomendasi
        </a>
    </div>

    <div class="rounded-xl bg-slate-800 h-64 flex items-center justify-center">
        <span class="text-gray-500">Preview Sistem</span>
    </div>
</section>
@endsection
