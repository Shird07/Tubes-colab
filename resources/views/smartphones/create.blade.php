<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Tambah Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-white p-6 rounded">

                <form action="{{ route('smartphones.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- MODEL --}}
                        <div>
                            <label class="block mb-1">Model</label>
                            <input type="text" name="model_name" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- BRAND --}}
                        <div>
                            <label class="block mb-1">Brand</label>
                            <input type="text" name="company_name" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- RAM --}}
                        <div>
                            <label class="block mb-1">RAM</label>
                            <input type="text" name="ram" placeholder="contoh: 6GB" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- BERAT --}}
                        <div>
                            <label class="block mb-1">Berat</label>
                            <input type="text" name="mobile_weight" placeholder="contoh: 174g" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- KAMERA DEPAN --}}
                        <div>
                            <label class="block mb-1">Kamera Depan</label>
                            <input type="text" name="front_camera" placeholder="contoh: 12MP" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- KAMERA BELAKANG --}}
                        <div>
                            <label class="block mb-1">Kamera Belakang</label>
                            <input type="text" name="back_camera" placeholder="contoh: 48MP" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- PROCESSOR --}}
                        <div>
                            <label class="block mb-1">Processor</label>
                            <input type="text" name="processor" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- BATERAI --}}
                        <div>
                            <label class="block mb-1">Baterai</label>
                            <input type="text" name="battery_capacity" placeholder="contoh: 3,600mAh" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- LAYAR --}}
                        <div>
                            <label class="block mb-1">Ukuran Layar</label>
                            <input type="text" name="screen_size" placeholder="contoh: 6.1 inches" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- HARGA --}}
                        <div>
                            <label class="block mb-1">Harga (USD)</label>
                            <input type="text" name="price_usa" placeholder="contoh: USD 799" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                        {{-- TAHUN --}}
                        <div>
                            <label class="block mb-1">Tahun Rilis</label>
                            <input type="number" name="launched_year" placeholder="2024" required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="flex gap-3 mt-6">
                        <button type="submit"
                            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                            Simpan
                        </button>

                        <a href="{{ route('smartphones.index') }}"
                           class="px-5 py-2 bg-gray-600 hover:bg-gray-700 rounded">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
