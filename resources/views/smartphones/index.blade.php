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

                {{-- Tombol tambah (admin only) --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('smartphones.create') }}"
                       class="inline-block mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white">
                        + Tambah Smartphone
                    </a>
                @endif

                {{-- SEARCH --}}
                <form method="GET" action="{{ route('smartphones.index') }}" class="mb-4 flex gap-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari model / brand / processor..."
                        class="w-1/3 px-4 py-2 rounded bg-gray-700 text-white border border-gray-600"
                    >
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
                        Search
                    </button>
                </form>

                {{-- TABLE --}}
                <div class="overflow-x-auto">
                <table class="w-full border border-gray-700 text-sm">
                    <thead>
                        <tr class="bg-gray-700 text-gray-200">
                            <th class="p-2 border">Model</th>
                            <th class="p-2 border">Brand</th>
                            <th class="p-2 border">RAM</th>
                            <th class="p-2 border">Berat</th>
                            <th class="p-2 border">Kamera Depan</th>
                            <th class="p-2 border">Kamera Belakang</th>
                            <th class="p-2 border">Processor</th>
                            <th class="p-2 border">Baterai</th>
                            <th class="p-2 border">Layar</th>
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
                            <td class="p-2 border">{{ $phone->mobile_weight }}</td>
                            <td class="p-2 border">{{ $phone->front_camera }}</td>
                            <td class="p-2 border">{{ $phone->back_camera }}</td>
                            <td class="p-2 border">{{ $phone->processor }}</td>
                            <td class="p-2 border">{{ $phone->battery_capacity }}</td>
                            <td class="p-2 border">{{ $phone->screen_size }}</td>
                            <td class="p-2 border">{{ $phone->price_usa }}</td>
                            <td class="p-2 border">{{ $phone->launched_year }}</td>

                            @if(auth()->user()->role === 'admin')
                            <td class="p-2 border text-center">
                                <form action="{{ route('smartphones.destroy', $phone->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-white">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center p-4 text-gray-400">
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
</x-app-layout>
