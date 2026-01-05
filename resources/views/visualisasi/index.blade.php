<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Visualisasi Data Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- CHART 1: Jumlah Smartphone per Brand --}}
            <div class="bg-gray-800 p-6 rounded text-white">
                <h3 class="text-lg font-semibold mb-4">
                    Jumlah Smartphone per Brand
                </h3>
                <canvas id="brandChart" height="120"></canvas>
            </div>

            {{-- CHART 2: Jumlah Smartphone per Tahun --}}
            <div class="bg-gray-800 p-6 rounded text-white">
                <h3 class="text-lg font-semibold mb-4">
                    Jumlah Smartphone per Tahun Rilis
                </h3>
                <canvas id="yearChart" height="120"></canvas>
            </div>

        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Brand Chart
        new Chart(document.getElementById('brandChart'), {
            type: 'bar',
            data: {
                labels: @json($brands),
                datasets: [{
                    label: 'Jumlah Smartphone',
                    data: @json($brandTotals),
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { color: 'white' } }
                },
                scales: {
                    x: { ticks: { color: 'white' }, grid: { color: '#374151' } },
                    y: { ticks: { color: 'white' }, grid: { color: '#374151' } }
                }
            }
        });

        // Year Chart
        new Chart(document.getElementById('yearChart'), {
            type: 'line',
            data: {
                labels: @json($years),
                datasets: [{
                    label: 'Jumlah Smartphone',
                    data: @json($yearTotals),
                    borderColor: '#22c55e',
                    backgroundColor: '#22c55e',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { color: 'white' } }
                },
                scales: {
                    x: { ticks: { color: 'white' }, grid: { color: '#374151' } },
                    y: { ticks: { color: 'white' }, grid: { color: '#374151' } }
                }
            }
        });
    </script>
</x-app-layout>
