<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Data Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-white p-6 rounded">

                <h3 class="text-lg font-bold mb-4">Daftar Smartphone</h3>

                {{-- Tombol tambah --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('smartphones.create') }}"
                       class="inline-block mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                        + Tambah Smartphone
                    </a>
                @endif

                {{-- Search --}}
                <form method="GET" action="{{ route('smartphones.index') }}" class="mb-4 flex gap-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari model / brand / processor..."
                        class="w-1/3 px-4 py-2 rounded bg-gray-700 border border-gray-600"
                    >
                    <button class="px-4 py-2 bg-blue-600 rounded">Search</button>
                </form>

                {{-- Table --}}
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
                            <td class="p-2 border text-center">
                                <button
                                    onclick="openDeleteModal({{ $phone->id }})"
                                    class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded">
                                    Hapus
                                </button>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-400">
                                Data tidak ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL HAPUS (KECIL + TENGAH + ANIMASI) --}}
    <div id="deleteModal" class="fixed inset-0 z-[9999] hidden">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/60"
             onclick="closeDeleteModal()"></div>

        {{-- Modal Box --}}
        <div class="relative min-h-screen flex items-center justify-center px-4">
            <div id="modalBox"
                 class="bg-gray-800 rounded-lg w-full max-w-xs p-4 text-white
                        shadow-xl transform scale-95 opacity-0
                        transition-all duration-200">

                <h2 class="text-base font-semibold text-center mb-1">
                    Hapus Data?
                </h2>

                <p class="text-xs text-center text-gray-300 mb-4">
                    Data ini akan dihapus permanen.
                </p>

                <div class="flex justify-center gap-2">
                    <button
                        onclick="closeDeleteModal()"
                        class="px-3 py-1.5 text-sm bg-gray-600 hover:bg-gray-700 rounded">
                        Batal
                    </button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-3 py-1.5 text-sm bg-red-600 hover:bg-red-700 rounded">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
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

            setTimeout(() => modal.classList.add('hidden'), 200);
        }
    </script>
</x-app-layout>
