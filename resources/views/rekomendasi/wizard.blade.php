<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Sistem Rekomendasi Smartphone</h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded shadow text-center">
            <h1 class="text-2xl font-bold mb-4">Temukan Smartphone yang Tepat untuk Anda!</h1>
            <p class="mb-6">Isi beberapa pertanyaan berikut untuk mendapatkan rekomendasi smartphone sesuai kebutuhan Anda.</p>
            <button onclick="document.getElementById('wizard').classList.remove('hidden')"
                    class="px-6 py-3 bg-indigo-600 text-white rounded">
                Mulai Rekomendasi
            </button>
        </div>
    </div>
<div id="wizard" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
    <form method="POST" action="{{ route('rekomendasi.hasil') }}"
      class="bg-slate-800 p-8 rounded-xl w-full max-w-lg text-white space-y-6">

        @csrf

        {{-- STEP 1 --}}
        <div class="step">
            <h2 class="text-xl font-bold mb-2">Berapa budget maksimal Anda?</h2>
            <input type="number" name="budget" required
                placeholder="Contoh: 5000000"
                class="w-full p-3 rounded text-black">
            <p class="text-sm text-slate-400 mt-2">* Dalam Rupiah</p>
        </div>

        {{-- STEP 2 --}}
        <div class="step hidden">
            <h2 class="text-xl font-bold mb-2">Minimal kamera belakang (MP)?</h2>
            <input type="number" name="kamera"
                placeholder="Contoh: 48"
                class="w-full p-3 rounded text-black">
        </div>

        {{-- STEP 3 --}}
        <div class="step hidden">
            <h2 class="text-xl font-bold mb-2">Minimal RAM (GB)?</h2>
            <input type="number" name="ram"
                placeholder="Contoh: 8"
                class="w-full p-3 rounded text-black">
        </div>

        {{-- STEP 4 --}}
        <div class="step hidden">
            <h2 class="text-xl font-bold mb-2">Minimal baterai (mAh)?</h2>
            <input type="number" name="baterai"
                placeholder="Contoh: 5000"
                class="w-full p-3 rounded text-black">
        </div>

        {{-- NAV --}}
        <div class="flex justify-between pt-4">
            <button type="button" onclick="prevStep()"
                class="px-4 py-2 bg-slate-600 rounded">Back</button>

            <button type="button" onclick="nextStep()"
                class="px-4 py-2 bg-indigo-600 rounded">Next</button>

            <button type="submit"
                class="px-4 py-2 bg-green-600 rounded hidden"
                id="submitBtn">Proses</button>
        </div>
    </form>
</div>

<script>
let step = 0;
const steps = document.querySelectorAll('.step');
const submitBtn = document.getElementById('submitBtn');

function showStep() {
    steps.forEach((s, i) => s.classList.toggle('hidden', i !== step));
    submitBtn.classList.toggle('hidden', step !== steps.length - 1);
}

function nextStep() {
    if (step < steps.length - 1) step++;
    showStep();
}

function prevStep() {
    if (step > 0) step--;
    showStep();
}

showStep();
</script>
</x-app-layout> 
