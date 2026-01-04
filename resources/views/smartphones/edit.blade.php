<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Edit Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-white p-6 rounded-lg">

                <form action="{{ route('smartphones.update', $smartphone->id) }}"
                      method="POST"
                      class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @csrf
                    @method('PUT')

                    {{-- MODEL --}}
                    <div>
                        <label class="block mb-1">Model</label>
                        <input type="text" name="model_name"
                               value="{{ old('model_name', $smartphone->model_name) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- BRAND --}}
                    <div>
                        <label class="block mb-1">Brand</label>
                        <input type="text" name="company_name"
                               value="{{ old('company_name', $smartphone->company_name) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- RAM --}}
                    <div>
                        <label class="block mb-1">RAM</label>
                        <input type="text" name="ram"
                               value="{{ old('ram', $smartphone->ram) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- BERAT --}}
                    <div>
                        <label class="block mb-1">Berat</label>
                        <input type="text" name="mobile_weight"
                               value="{{ old('mobile_weight', $smartphone->mobile_weight) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- KAMERA DEPAN --}}
                    <div>
                        <label class="block mb-1">Kamera Depan</label>
                        <input type="text" name="front_camera"
                               value="{{ old('front_camera', $smartphone->front_camera) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- KAMERA BELAKANG --}}
                    <div>
                        <label class="block mb-1">Kamera Belakang</label>
                        <input type="text" name="back_camera"
                               value="{{ old('back_camera', $smartphone->back_camera) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- PROCESSOR --}}
                    <div>
                        <label class="block mb-1">Processor</label>
                        <input type="text" name="processor"
                               value="{{ old('processor', $smartphone->processor) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- BATERAI --}}
                    <div>
                        <label class="block mb-1">Baterai</label>
                        <input type="text" name="battery_capacity"
                               value="{{ old('battery_capacity', $smartphone->battery_capacity) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- UKURAN LAYAR --}}
                    <div>
                        <label class="block mb-1">Ukuran Layar</label>
                        <input type="text" name="screen_size"
                               value="{{ old('screen_size', $smartphone->screen_size) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- HARGA --}}
<div>
    <label class="block mb-1">Harga (USD)</label>
    <input
        type="text"
        name="price_usa"
        value="{{ old('price_usa', $smartphone->price_usa) }}"
        class="w-full bg-gray-700 border border-gray-600 rounded p-2"
        placeholder="Contoh: 399 USD / 1,299 USD "
        required
    >
</div>


                    {{-- TAHUN RILIS --}}
                    <div>
                        <label class="block mb-1">Tahun Rilis</label>
                        <input type="number" name="launched_year"
                               value="{{ old('launched_year', $smartphone->launched_year) }}"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    {{-- ACTION --}}
                    <div class="md:col-span-2 flex gap-3 mt-4">
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                            Update
                        </button>

                        <a href="{{ route('smartphones.index') }}"
                           class="px-6 py-2 bg-gray-600 hover:bg-gray-700 rounded">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
