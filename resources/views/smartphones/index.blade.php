<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Data Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-[1600px] mx-auto px-2">
            <div class="bg-gray-800 text-white p-6 rounded-lg w-full">

                <h3 class="text-lg font-bold mb-4">
                    Daftar Smartphone
                </h3>

                {{-- TOMBOL TAMBAH (ADMIN ONLY) --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('smartphones.create') }}"
                       class="inline-block mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                        + Tambah Smartphone
                    </a>
                @endif

                {{-- SEARCH --}}
                <form method="GET"
                      action="{{ route('smartphones.index') }}"
                      class="mb-4 flex flex-col md:flex-row gap-3"
                      id="searchForm">

                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        value="{{ request('search') }}"
                        placeholder="Cari model, brand, RAM, processor..."
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

                {{-- TABLE --}}
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-700 text-sm">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="p-2 border">Model</th>
                                <th class="p-2 border">Brand</th>
                                <th class="p-2 border">RAM</th>
                                <th class="p-2 border">Harga</th>
                                <th class="p-2 border">Tahun</th>

                                @if(auth()->user()->role === 'admin')
                                    <th class="p-2 border text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($smartphones as $phone)
                                <tr class="hover:bg-gray-700">
                                    <td class="p-2 border">{{ $phone->model_name }}</td>
                                    <td class="p-2 border">{{ $phone->company_name }}</td>
                                    <td class="p-2 border">{{ $phone->ram }}</td>
                                    <td class="p-2 border">{{ $phone->price_usa }}</td>
                                    <td class="p-2 border">{{ $phone->launched_year }}</td>

                                    @if(auth()->user()->role === 'admin')
                                        <td class="p-2 border text-center space-x-2">
                                            {{-- EDIT --}}
                                            <a href="{{ route('smartphones.edit', $phone->id) }}"
                                               class="inline-block px-3 py-1 bg-yellow-500 hover:bg-yellow-600 rounded text-xs text-white">
                                                Edit
                                            </a>

                                            {{-- DELETE --}}
                                            <button
                                                onclick="openDeleteModal({{ $phone->id }})"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-xs text-white">
                                                Hapus
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}"
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

    {{-- MODAL DELETE --}}
    <div id="deleteModal"
         class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

        <div class="bg-gray-800 rounded-lg w-[400px] p-6 text-white shadow-xl">
            <h3 class="text-lg font-semibold mb-3 text-center">
                Hapus Data Smartphone?
            </h3>

            <p class="text-sm text-gray-300 mb-6 text-center">
                Data yang dihapus tidak dapat dikembalikan.
            </p>

            <div class="flex justify-center gap-3">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded">
                    Batal
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        // SEARCH DEBOUNCE
        const searchInput = document.getElementById('searchInput');
        const searchForm  = document.getElementById('searchForm');

        let typingTimer;
        const debounceDelay = 700;

        searchInput.addEventListener('input', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                searchForm.submit();
            }, debounceDelay);
        });

        // DELETE MODAL
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm  = document.getElementById('deleteForm');

        function openDeleteModal(id) {
            deleteForm.action = `/smartphones/${id}`;
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        }
    </script>
</x-app-layout>
