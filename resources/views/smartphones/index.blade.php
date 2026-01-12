<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Data Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                {{-- Total Smartphone --}}
                <div class="bg-gradient-to-r from-purple-900/80 to-purple-800/60 backdrop-blur-sm p-4 rounded-xl border border-purple-700/30">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-700/30 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-purple-200">Total Smartphone</p>
                            <p class="text-2xl font-bold text-white">{{ $smartphones->total() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Unique Brands --}}
                <div class="bg-gradient-to-r from-blue-900/80 to-blue-800/60 backdrop-blur-sm p-4 rounded-xl border border-blue-700/30">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-700/30 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-blue-200">Total Brands</p>
                            <p class="text-2xl font-bold text-white">{{ $brandsCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                {{-- Average Price --}}
                <div class="bg-gradient-to-r from-green-900/80 to-green-800/60 backdrop-blur-sm p-4 rounded-xl border border-green-700/30">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-700/30 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-green-200">Avg Price</p>
                            <p class="text-2xl font-bold text-white">${{ number_format($avgPrice ?? 0) }}</p>
                        </div>
                    </div>
                </div>

                {{-- Latest Year --}}
                <div class="bg-gradient-to-r from-amber-900/80 to-amber-800/60 backdrop-blur-sm p-4 rounded-xl border border-amber-700/30">
                    <div class="flex items-center">
                        <div class="p-2 bg-amber-700/30 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-amber-200">Latest Year</p>
                            <p class="text-2xl font-bold text-white">{{ $latestYear ?? date('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN CARD --}}
            <div class="bg-gradient-to-br from-gray-900 to-gray-800/90 backdrop-blur-sm rounded-xl shadow-xl border border-gray-700/50 overflow-hidden">
                
                {{-- HEADER --}}
                <div class="px-6 py-4 border-b border-gray-700/50">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">📱 Daftar Smartphone</h3>
                            <p class="text-sm text-gray-400 mt-1">Kelola data smartphone dengan mudah</p>
                        </div>
                        
                        {{-- TOMBOL TAMBAH & EXPORT (ADMIN ONLY) --}}
                        @if(auth()->user()->role === 'admin')
                            <div class="mt-3 md:mt-0 flex space-x-2">
                                <a href="{{ route('smartphones.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Smartphone
                                </a>
                                
                                {{-- TOMBOL EXPORT EXCEL --}}
                                <a href="{{ route('smartphones.export.excel') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- SEARCH & FILTERS --}}
                <div class="px-6 py-4 bg-gray-800/50 border-b border-gray-700/30">
                    <form method="GET" action="{{ route('smartphones.index') }}" class="space-y-4">
                        
                        {{-- SEARCH BAR --}}
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="search"
                                id="searchInput"
                                value="{{ request('search') }}"
                                placeholder="Cari model, brand, RAM, processor, tahun..."
                                class="w-full pl-10 pr-4 py-3 bg-gray-800/70 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>

                        {{-- FILTERS ROW --}}
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            {{-- Brand Filter --}}
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Brand</label>
                                <select name="brand" class="w-full bg-gray-800/70 border border-gray-700 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua Brand</option>
                                    @foreach($brandsList ?? [] as $brand)
                                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Year Filter --}}
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Tahun</label>
                                <select name="year" class="w-full bg-gray-800/70 border border-gray-700 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua Tahun</option>
                                    @foreach($yearsList ?? [] as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- RAM Filter --}}
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">RAM</label>
                                <select name="ram" class="w-full bg-gray-800/70 border border-gray-700 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua RAM</option>
                                    <option value="4" {{ request('ram') == '4' ? 'selected' : '' }}>4GB</option>
                                    <option value="6" {{ request('ram') == '6' ? 'selected' : '' }}>6GB</option>
                                    <option value="8" {{ request('ram') == '8' ? 'selected' : '' }}>8GB</option>
                                    <option value="12" {{ request('ram') == '12' ? 'selected' : '' }}>12GB</option>
                                    <option value="16" {{ request('ram') == '16' ? 'selected' : '' }}>16GB</option>
                                </select>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-end space-x-2">
                                <button type="submit"
                                        class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded-lg font-medium transition-all duration-300">
                                    Terapkan Filter
                                </button>
                                <a href="{{ route('smartphones.index') }}"
                                   class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors duration-300">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-800/80 border-b border-gray-700/50">
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Model</span>
                                        <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Brand</span>
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>RAM</span>
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Harga</span>
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Tahun</span>
                                    </div>
                                </th>
                                @if(auth()->user()->role === 'admin')
                                    <th class="py-3 px-6 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <span>Aksi</span>
                                        </div>
                                    </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-700/50">
                            @forelse ($smartphones as $phone)
                                <tr class="hover:bg-gray-800/50 transition-colors duration-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-900/30 to-blue-800/20 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-white">{{ $phone->model_name }}</div>
                                                <div class="text-xs text-gray-400">{{ $phone->processor ?? 'Processor not set' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-900/30 text-blue-300">
                                            {{ $phone->company_name }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            <span class="text-sm text-white">{{ $phone->ram }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="text-sm font-bold text-green-400">${{ str_replace('USD ', '', $phone->price_usa) }}</div>
                                        <div class="text-xs text-gray-400">{{ $phone->price_usa }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-900/30 text-amber-300">
                                            {{ $phone->launched_year }}
                                        </span>
                                    </td>
                                    
                                    @if(auth()->user()->role === 'admin')
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                {{-- EDIT --}}
                                                <a href="{{ route('smartphones.edit', $phone->id) }}"
                                                   class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-amber-700/30 to-amber-600/20 hover:from-amber-600/40 hover:to-amber-500/30 text-amber-300 rounded-lg text-sm font-medium transition-all duration-300 border border-amber-700/30">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>

                                                {{-- DELETE --}}
                                                <button onclick="openDeleteModal({{ $phone->id }})"
                                                        class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-700/30 to-red-600/20 hover:from-red-600/40 hover:to-red-500/30 text-red-300 rounded-lg text-sm font-medium transition-all duration-300 border border-red-700/30">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" class="py-12 px-6 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-gray-400 text-lg">Data smartphone tidak ditemukan.</p>
                                            <p class="text-gray-500 text-sm mt-2">Coba ubah filter pencarian atau tambahkan data baru.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION & FOOTER --}}
                <div class="px-6 py-4 border-t border-gray-700/50 bg-gray-800/30">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="text-sm text-gray-400 mb-4 md:mb-0">
                            Menampilkan {{ $smartphones->firstItem() ?? 0 }} - {{ $smartphones->lastItem() ?? 0 }} dari {{ $smartphones->total() }} data
                        </div>
                        
                        {{-- PAGINATION --}}
                        @if($smartphones->hasPages())
                            <div class="flex space-x-2">
                                {{-- Previous --}}
                                @if($smartphones->onFirstPage())
                                    <span class="px-3 py-2 bg-gray-800/50 text-gray-600 rounded-lg cursor-not-allowed">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $smartphones->previousPageUrl() }}" class="px-3 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </a>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach($smartphones->getUrlRange(1, $smartphones->lastPage()) as $page => $url)
                                    @if($page == $smartphones->currentPage())
                                        <span class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg font-medium">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg transition-colors duration-300">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next --}}
                                @if($smartphones->hasMorePages())
                                    <a href="{{ $smartphones->nextPageUrl() }}" class="px-3 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="px-3 py-2 bg-gray-800/50 text-gray-600 rounded-lg cursor-not-allowed">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div id="deleteModal"
         class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4 transition-opacity duration-300">

        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl w-full max-w-md p-6 border border-gray-700/50 shadow-2xl transform transition-all duration-300 scale-95 opacity-0"
             id="modalContent">
            <div class="text-center mb-6">
                <div class="mx-auto w-16 h-16 bg-gradient-to-r from-red-900/30 to-red-800/20 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Hapus Data Smartphone?</h3>
                <p class="text-gray-400">Data yang dihapus tidak dapat dikembalikan. Apakah Anda yakin?</p>
            </div>

            <div class="flex justify-center gap-3">
                <button onclick="closeDeleteModal()"
                        class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors duration-300 flex-1">
                    Batal
                </button>

                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white rounded-lg font-medium transition-all duration-300">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        // SEARCH DEBOUNCE
        // SEARCH DEBOUNCE (FIXED)
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');

        let typingTimer;
        const debounceDelay = 700;

        if (searchInput && searchForm) {
            searchInput.addEventListener('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    console.log('Auto submit search form');
                    searchForm.submit(); // ✅ PASTI FORM SEARCH
                }, debounceDelay);
            });
        }

        // DELETE MODAL ANIMATION
        const deleteModal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        const deleteForm = document.getElementById('deleteForm');

        function openDeleteModal(id) {
            deleteForm.action = `/smartphones/${id}`;
            deleteModal.classList.remove('hidden');
            
            setTimeout(() => {
                deleteModal.classList.add('flex');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 50);
            }, 10);
        }

        function closeDeleteModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                deleteModal.classList.remove('flex');
                deleteModal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if(e.target === deleteModal) {
                closeDeleteModal();
            }
        });

        // Close with ESC key
        document.addEventListener('keydown', function(e) {
            if(e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                closeDeleteModal();
            }
        });
    </script>

    {{-- STYLE --}}
    <style>
        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(31, 41, 55, 0.3);
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: rgba(75, 85, 99, 0.6);
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(107, 114, 128, 0.8);
        }

        /* Smooth transitions */
        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        /* Hover effects */
        tr {
            transition: all 0.2s ease;
        }
    </style>
</x-app-layout>