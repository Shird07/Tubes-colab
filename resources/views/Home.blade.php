@extends('layouts.marketing')

@section('content')
<section class="grid md:grid-cols-2 gap-14 items-center">

    <div>
        <h1 class="text-5xl font-extrabold leading-tight mb-6">
            Sistem Rekomendasi Smartphone
        </h1>

        <p class="text-slate-400 text-lg mb-8">
            Platform berbasis sistem pakar untuk membantu pengguna memilih
            smartphone terbaik berdasarkan <b>budget</b>, <b>kamera</b>,
            <b>baterai</b>, dan <b>spesifikasi</b>.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('rekom
