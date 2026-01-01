<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- GRID STATISTIK -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- TOTAL SMARTPHONE -->
                        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">
                                Total Smartphone
                            </h3>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalSmartphone ?? 0 }}
                            </p>
                        </div>

                        <!-- TOTAL BRAND -->
                        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">
                                Total Brand
                            </h3>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalBrand ?? 0 }}
                            </p>
                        </div>

                        <!-- TOTAL USER -->
                        <div class="bg-purple-500 text-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">
                                Total User
                            </h3>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalUser ?? 0 }}
                            </p>
                        </div>

                    </div>
                    <!-- END GRID -->

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
