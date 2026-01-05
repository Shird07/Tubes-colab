<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-800">
        <div class="text-center max-w-xl">

            <h1 class="text-4xl font-bold text-white mb-4">
                Sistem Rekomendasi Smartphone
            </h1>

            <p class="text-slate-300 mb-8">
                Kami akan membantu Anda memilih smartphone terbaik
                berdasarkan kebutuhan dan budget Anda.
            </p>

            <button
                onclick="startWizard()"
                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg text-lg">
                Mulai Rekomendasi
            </button>

        </div>
    </div>

    {{-- WIZARD --}}
    @include('rekomendasi.wizard')
</x-app-layout>

<script>
function startWizard() {
    document.getElementById('wizard').classList.remove('hidden');
}
</script>
