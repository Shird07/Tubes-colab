<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Data Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-white p-6 rounded-lg">

                <h3 class="text-lg font-bold mb-4">Daftar Smartphone</h3>

                {{-- Tombol Tambah (ADMIN ONLY) --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('smartphones.create') }}"
                       class="inline-block mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                        + Tambah Smartphone
                    </a>
                @endif

                {{-- SEARCH --}}
                <form method="GET"
                      action="{{ route('smartphones.index') }}"
                      class="mb-4 flex flex-col md:flex-row gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari berdasarkan model atau brand..."
                        class="w-full md:w-1/3 px-3 py-2 rounded
                               bg-gray-700 text-white placeholder-gray-400
                               border border-gray-600
                               focus:outline-none focus:ring focus:ring-blue-500">

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                        Search
                    </button>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-700 text-sm">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="p-2 border">Model</th>
                                <th class="p-2 border">Brand</th>
                                <th class="p-2 border">RAM</th>
                                <th class="p-2 border">Harga</th>
                                <th class="p-2 border">Tahun</th>
                                <th class="p-2 border text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($smartphones as $phone)
                                <tr class="hover:bg-gray-700">
                                    <td class="p-2 border">
                                        {{ $phone->model_name }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $phone->company_name }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $phone->ram }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $phone->price_usa }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ $phone->launched_year }}
                                    </td>
                                    <td class="p-2 border text-center">
                                        <button
                                            onclick="openDeleteModal({{ $phone->id }})"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="p-4 text-center text-gray-400">
                                        Data smartphone tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="deleteModal" class="fixed inset-0 z-[9999] hidden">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/70"
             onclick="closeDeleteModal()"></div>

        {{-- Wrapper --}}
        <div class="relative min-h-screen flex items-center justify-center px-4">

            {{-- Modal Box --}}
            <div id="modalBox"
                 class="bg-gray-800 rounded-2xl
                        w-[420px] max-w-[90vw]
                        px-8 py-7
                        text-white shadow-2xl
                        transform scale-95 opacity-0
                        transition-all duration-200">

                {{-- Icon --}}
                <div class="flex justify-center mb-4">
                    <div class="w-12 h-12 flex items-center justify-center
                                rounded-full bg-red-600/20 text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22m-5-4H6a1 1 0 00-1 1v1h14V4a1 1 0 00-1-1z" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-lg font-semibold text-center mb-2">
                    Hapus Data?
                </h2>

                <p class="text-sm text-center text-gray-300 mb-6">
                    Data ini akan dihapus secara permanen dan tidak dapat dikembalikan.
                </p>

                <div class="flex justify-center gap-4">
                    <button
                        onclick="closeDeleteModal()"
                        class="px-5 py-2 rounded-lg
                               bg-gray-600 hover:bg-gray-700">
                        Batal
                    </button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg
                                   bg-red-600 hover:bg-red-700">
                            Ya, Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            const box = document.getElementById('modalBox');
            const form = document.getElementById('deleteForm');

            form.action = `/smartphones/${id}`;
            modal.classList.remove('hidden');

            requestAnimationFrame(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const box = document.getElementById('modalBox');

            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    </script>
</x-app-layout>
