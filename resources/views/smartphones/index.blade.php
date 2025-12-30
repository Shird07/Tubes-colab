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
                @if(auth()->user()->role === 'admin')
    <a href="{{ route('smartphones.create') }}"
       class="inline-block mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white">
        + Tambah Smartphone
    </a>
@endif


                <table class="w-full border border-gray-700">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Brand</th>
                            <th class="p-2 border">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($smartphones as $phone)
                        <tr>
                            <td class="p-2 border">{{ $phone->name }}</td>
                            <td class="p-2 border">{{ $phone->brand }}</td>
                            <td class="p-2 border">{{ $phone->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
