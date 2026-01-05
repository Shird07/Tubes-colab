<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-white py-10 px-6">

        <h1 class="text-3xl font-bold mb-6 text-center">
            Hasil Rekomendasi Smartphone
        </h1>

        @if($hasil->isEmpty())
            <div class="bg-yellow-600/20 border border-yellow-500 p-4 rounded text-center">
                Tidak ada smartphone yang cocok dengan kriteria Anda.
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($hasil as $index => $item)
                    <div class="bg-slate-800 rounded-xl p-5 shadow">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-slate-400">
                                Rank #{{ $index + 1 }}
                            </span>
                            <span class="text-sm font-bold text-indigo-400">
                                Skor {{ $item['score'] }}
                            </span>
                        </div>

                        <h2 class="text-xl font-semibold">
                            {{ $item['phone']->model_name }}
                        </h2>

                        <p class="text-slate-400 mb-2">
                            {{ $item['phone']->company_name }}
                        </p>

                        <ul class="text-sm space-y-1 mb-3">
                            <li>📸 Kamera: {{ $item['phone']->back_camera }} MP</li>
                            <li>🧠 RAM: {{ $item['phone']->ram }} GB</li>
                            <li>🔋 Baterai: {{ $item['phone']->battery_capacity }} mAh</li>
                        </ul>

                        <div class="font-bold text-green-400 mb-3">
                            Rp {{ number_format($item['price_rp'], 0, ',', '.') }}
                        </div>

                        <div class="text-sm text-slate-300 bg-slate-700 p-3 rounded">
                            💡 <b>Direkomendasikan karena:</b><br>
                            Memiliki spesifikasi tinggi dibandingkan kandidat lain
                            dalam rentang budget Anda.
                        </div>
<button 
    onclick="toggleDetail('detail-{{ $loop->index }}')" 
    class="mt-4 text-sm text-blue-400 hover:underline">
    🔍 Lihat Spesifikasi
</button>

<div id="detail-{{ $loop->index }}" 
     class="hidden mt-4 text-sm text-slate-300 border-t border-slate-600 pt-3 space-y-1">
     
    <p>📸 Kamera Depan: {{ $item['phone']->front_camera }} MP</p>
    <p>📸 Kamera Belakang: {{ $item['phone']->back_camera }} MP</p>
    <p>🧠 Prosesor: {{ $item['phone']->processor }}</p>
    <p>📱 Layar: {{ $item['phone']->screen_size }} inch</p>
    <p>⚖️ Berat: {{ $item['phone']->mobile_weight }} gram</p>
    <p>📅 Tahun Rilis: {{ $item['phone']->launched_year }}</p>
</div>

                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-10">
            <a href="{{ route('rekomendasi') }}"
               class="inline-block px-6 py-3 bg-indigo-600 rounded hover:bg-indigo-700">
                Ulangi Rekomendasi
            </a>
        </div>

    </div>
    <script>
function toggleDetail(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
}
</script>

</x-app-layout>
