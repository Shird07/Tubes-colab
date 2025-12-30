<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Tambah Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-white p-6 rounded">

                <form action="{{ route('smartphones.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Nama</label>
                        <input type="text" name="name"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Brand</label>
                        <input type="text" name="brand"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Harga</label>
                        <input type="number" name="price"
                               class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                               required>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                            Simpan
                        </button>

                        <a href="{{ route('smartphones.index') }}"
                           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-la
