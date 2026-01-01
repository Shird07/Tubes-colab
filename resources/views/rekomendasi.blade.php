@extends('layouts.marketing')

@section('content')
<section class="relative overflow-hidden px-8 py-24 max-w-7xl mx-auto">

    <h1 class="text-5xl font-bold leading-tight mb-6">
        Sistem Rekomendasi Smartphone
    </h1>

    <p class="text-lg text-slate-300 max-w-2xl mb-10">
        Platform berbasis sistem pakar untuk membantu pengguna memilih smartphone terbaik
        berdasarkan <b>budget</b>, <b>kamera</b>, dan <b>baterai</b>.
    </p>

    <div class="flex gap-4">
        <a href="{{ route('rekomendasi') }}"
           class="px-6 py-3 rounded bg-indigo-600 hover:bg-indigo-500 transition">
            Mulai Rekomendasi
        </a>

        <a href="{{ route('login') }}"
           class="px-6 py-3 rounded border border-white/20 hover:bg-white/10 transition">
            Login
        </a>
    </div>

</section>
@endsection
