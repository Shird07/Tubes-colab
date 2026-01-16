<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Dashboard Visualisasi Data Smartphone
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ================= TOTAL SMARTPHONE ================= --}}
            <div class="flex justify-center">
                <div class="bg-gray-800 w-full max-w-lg p-6 rounded text-white text-center">
                    <p class="text-sm text-gray-400 mb-1">
                        Total Smartphone
                    </p>
                    <p class="text-4xl font-bold">
                        {{ $totalSmartphone }}
                    </p>
                </div>
            </div>

            {{-- ================= FILTER DATA (RAPI & TIDAK BERLEBIHAN) ================= --}}
            <div class="bg-gray-800 p-4 rounded text-white">

                <p class="text-sm text-gray-400 mb-3">
                    Filter Brand & Tahun
                </p>

                {{-- BRAND CHECKBOX (AUTO PINDAH BARIS, TIDAK KE SAMPING TERUS) --}}
                <div class="flex flex-wrap gap-x-4 gap-y-2 mb-4">
                    @foreach ($brands as $brand)
                        <label class="flex items-center gap-2 text-sm whitespace-nowrap">
                            <input
                                type="checkbox"
                                class="brand-checkbox accent-blue-600"
                                value="{{ $brand }}">
                            {{ $brand }}
                        </label>
                    @endforeach
                </div>

                {{-- FILTER TAHUN --}}
                <div>
                    <select id="yearFilter"
                            class="bg-gray-700 border border-gray-600 rounded px-3 py-2 text-sm">
                        <option value="">Semua Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- TOMBOL SELECT ALL / DESELECT ALL --}}
                <div class="mt-3 flex gap-2">
                    <button type="button" id="selectAllBrands" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded">
                        Centang Semua
                    </button>
                    <button type="button" id="deselectAllBrands" class="bg-gray-600 hover:bg-gray-700 text-white text-sm px-3 py-1 rounded">
                        Hapus Semua
                    </button>
                </div>

            </div>

            {{-- ================= CHART GRID ================= --}}
            <div class="space-y-6">

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Jumlah Smartphone per Brand
                    </h3>
                    <canvas id="chartBrand"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Jumlah Smartphone per Tahun
                    </h3>
                    <canvas id="chartYear"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Rata-rata Harga Smartphone per Brand
                    </h3>
                    <canvas id="chartAvgPrice"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Distribusi Harga Smartphone
                    </h3>
                    <canvas id="chartPriceDist"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Hubungan RAM dengan Harga
                    </h3>
                    <canvas id="chartRamPrice"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Rata-rata Kapasitas Baterai per Brand
                    </h3>
                    <canvas id="chartBattery"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Tren Ukuran Layar per Tahun
                    </h3>
                    <canvas id="chartScreen"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Processor yang Paling Banyak Digunakan
                    </h3>
                    <canvas id="chartProcessor"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Resolusi Kamera Belakang Dominan
                    </h3>
                    <canvas id="chartCamera"></canvas>
                </div>

                <div class="bg-gray-800 p-6 rounded text-white">
                    <h3 class="text-lg font-semibold mb-4">
                        Perbandingan Flagship vs Non-Flagship
                    </h3>
                    <canvas id="chartFlagship"></canvas>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= SCRIPT ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.register(ChartDataLabels);

            function baseOptions(formatter = v => v) {
                return {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            labels: { color: 'white' }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            color: 'white',
                            font: { weight: 'bold', size: 11 },
                            formatter
                        }
                    },
                    scales: {
                        x: { ticks: { color: 'white' } },
                        y: { beginAtZero: true, ticks: { color: 'white' } }
                    }
                }
            }

            // 🔥 DATA AWAL DARI PHP (SEMUA DATA)
            const initialData = {
                perBrand: @json($perBrand),
                perYear: @json($perYear),
                priceDistribution: @json($priceDistribution),
                avgPricePerBrand: @json($avgPricePerBrand),
                ramVsPrice: @json($ramVsPrice),
                avgBattery: @json($avgBattery),
                screenTrend: @json($screenTrend),
                processorUsage: @json($processorUsage),
                cameraUsage: @json($cameraUsage),
                flagshipCompare: @json($flagshipCompare),
            };

            // 🔥 INISIALISASI CHART DENGAN SEMUA DATA
            const charts = {
                brand: new Chart(document.getElementById('chartBrand'), {
                    type: 'bar',
                    data: {
                        labels: initialData.perBrand.map(i => i.company_name),
                        datasets: [{
                            label: 'Jumlah',
                            data: initialData.perBrand.map(i => i.total),
                            backgroundColor: '#3b82f6'
                        }]
                    },
                    options: baseOptions()
                }),

                year: new Chart(document.getElementById('chartYear'), {
                    type: 'line',
                    data: {
                        labels: initialData.perYear.map(i => i.launched_year),
                        datasets: [{
                            label: 'Jumlah',
                            data: initialData.perYear.map(i => i.total),
                            borderColor: '#22c55e',
                            fill: true
                        }]
                    },
                    options: {
                        ...baseOptions(),
                        plugins: { datalabels: { display: false } }
                    }
                }),

                avgPrice: new Chart(document.getElementById('chartAvgPrice'), {
                    type: 'bar',
                    data: {
                        labels: initialData.avgPricePerBrand.map(i => i.company_name),
                        datasets: [{
                            label: 'USD',
                            data: initialData.avgPricePerBrand.map(i => i.avg_price),
                            backgroundColor: '#f59e0b'
                        }]
                    },
                    options: baseOptions(v => '$' + Math.round(v))
                }),

                priceDist: new Chart(document.getElementById('chartPriceDist'), {
                    type: 'bar',
                    data: {
                        labels: initialData.priceDistribution.map(i => i.range_price),
                        datasets: [{
                            label: 'Jumlah',
                            data: initialData.priceDistribution.map(i => i.total),
                            backgroundColor: '#8b5cf6'
                        }]
                    },
                    options: baseOptions()
                }),

                ramPrice: new Chart(document.getElementById('chartRamPrice'), {
                    type: 'scatter',
                    data: {
                        datasets: [{
                            label: 'RAM vs Harga',
                            data: initialData.ramVsPrice.map(i => ({
                                x: i.ram,
                                y: i.price
                            })),
                            backgroundColor: '#ec4899',
                            pointRadius: 5
                        }]
                    },
                    options: {
                        plugins: {
                            legend: { labels: { color: 'white' } },
                            datalabels: { display: false }
                        },
                        scales: {
                            x: {
                                ticks: { color: 'white' },
                                title: { 
                                    display: true, 
                                    text: 'RAM (GB)', 
                                    color: 'white',
                                    font: { size: 14 }
                                }
                            },
                            y: {
                                ticks: { color: 'white' },
                                title: { 
                                    display: true, 
                                    text: 'Harga (USD)', 
                                    color: 'white',
                                    font: { size: 14 }
                                }
                            }
                        }
                    }
                }),

                battery: new Chart(document.getElementById('chartBattery'), {
                    type: 'bar',
                    data: {
                        labels: initialData.avgBattery.map(i => i.company_name),
                        datasets: [{
                            label: 'mAh',
                            data: initialData.avgBattery.map(i => i.avg_battery),
                            backgroundColor: '#10b981'
                        }]
                    },
                    options: baseOptions(v => Math.round(v) + ' mAh')
                }),

                screen: new Chart(document.getElementById('chartScreen'), {
                    type: 'line',
                    data: {
                        labels: initialData.screenTrend.map(i => i.launched_year),
                        datasets: [{
                            label: 'Inch',
                            data: initialData.screenTrend.map(i => i.avg_screen),
                            borderColor: '#0ea5e9',
                            tension: 0.4
                        }]
                    },
                    options: {
                        ...baseOptions(v => v.toFixed(1) + '"'),
                        plugins: { datalabels: { display: false } }
                    }
                }),

                processor: new Chart(document.getElementById('chartProcessor'), {
                    type: 'bar',
                    data: {
                        labels: initialData.processorUsage.map(i => i.processor),
                        datasets: [{
                            label: 'Jumlah',
                            data: initialData.processorUsage.map(i => i.total),
                            backgroundColor: '#f97316'
                        }]
                    },
                    options: baseOptions()
                }),

                camera: new Chart(document.getElementById('chartCamera'), {
                    type: 'bar',
                    data: {
                        labels: initialData.cameraUsage.map(i => i.back_camera),
                        datasets: [{
                            label: 'Jumlah',
                            data: initialData.cameraUsage.map(i => i.total),
                            backgroundColor: '#a855f7'
                        }]
                    },
                    options: baseOptions()
                }),

                flagship: new Chart(document.getElementById('chartFlagship'), {
                    type: 'pie',
                    data: {
                        labels: initialData.flagshipCompare.map(i => i.category),
                        datasets: [{
                            data: initialData.flagshipCompare.map(i => i.total),
                            backgroundColor: ['#ef4444', '#22c55e']
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { 
                                    color: 'white',
                                    font: { size: 14 }
                                }
                            },
                            datalabels: {
                                color: 'white',
                                font: { size: 14, weight: 'bold' },
                                formatter: (v, ctx) => {
                                    const t = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    return Math.round((v / t) * 100) + '%';
                                }
                            }
                        }
                    }
                })
            };

            // 🔥 FUNGSI UNTUK UPDATE CHART SAAT FILTER BERUBAH
            function updateChart() {
                let brands = [...document.querySelectorAll('.brand-checkbox:checked')].map(cb => cb.value);
                
                const params = new URLSearchParams();
                
                if (brands.length > 0) {
                    brands.forEach(b => params.append('brands[]', b));
                }
                
                const yearFilter = document.getElementById('yearFilter');
                const year = yearFilter ? yearFilter.value : '';
                
                if (year) params.append('year', year);

                console.log('Fetching filter with:', params.toString());

                fetch(`/dashboard/filter?${params}`)
                    .then(res => {
                        if (!res.ok) {
                            throw new Error(`HTTP error! status: ${res.status}`);
                        }
                        return res.json();
                    })
                    .then(d => {
                        console.log('Filter response received:', d);
                        
                        // Update data chart dengan validasi data kosong
                        // 1. Chart Brand
                        if (d.perBrand && d.perBrand.length > 0) {
                            charts.brand.data.labels = d.perBrand.map(i => i.company_name);
                            charts.brand.data.datasets[0].data = d.perBrand.map(i => i.total);
                        } else {
                            charts.brand.data.labels = [];
                            charts.brand.data.datasets[0].data = [];
                        }

                        // 2. Chart Year
                        if (d.perYear && d.perYear.length > 0) {
                            charts.year.data.labels = d.perYear.map(i => i.launched_year);
                            charts.year.data.datasets[0].data = d.perYear.map(i => i.total);
                        } else {
                            charts.year.data.labels = [];
                            charts.year.data.datasets[0].data = [];
                        }

                        // 3. Chart Average Price
                        if (d.avgPricePerBrand && d.avgPricePerBrand.length > 0) {
                            charts.avgPrice.data.labels = d.avgPricePerBrand.map(i => i.company_name);
                            charts.avgPrice.data.datasets[0].data = d.avgPricePerBrand.map(i => i.avg_price);
                        } else {
                            charts.avgPrice.data.labels = [];
                            charts.avgPrice.data.datasets[0].data = [];
                        }

                        // 4. Chart Price Distribution
                        if (d.priceDistribution && d.priceDistribution.length > 0) {
                            charts.priceDist.data.labels = d.priceDistribution.map(i => i.range_price);
                            charts.priceDist.data.datasets[0].data = d.priceDistribution.map(i => i.total);
                        } else {
                            charts.priceDist.data.labels = [];
                            charts.priceDist.data.datasets[0].data = [];
                        }

                        // 5. Chart RAM vs Price
                        if (d.ramVsPrice && d.ramVsPrice.length > 0) {
                            charts.ramPrice.data.datasets[0].data = d.ramVsPrice.map(i => ({ x: i.ram, y: i.price }));
                        } else {
                            charts.ramPrice.data.datasets[0].data = [];
                        }

                        // 6. Chart Battery
                        if (d.avgBattery && d.avgBattery.length > 0) {
                            charts.battery.data.labels = d.avgBattery.map(i => i.company_name);
                            charts.battery.data.datasets[0].data = d.avgBattery.map(i => i.avg_battery);
                        } else {
                            charts.battery.data.labels = [];
                            charts.battery.data.datasets[0].data = [];
                        }

                        // 7. Chart Screen
                        if (d.screenTrend && d.screenTrend.length > 0) {
                            charts.screen.data.labels = d.screenTrend.map(i => i.launched_year);
                            charts.screen.data.datasets[0].data = d.screenTrend.map(i => i.avg_screen);
                        } else {
                            charts.screen.data.labels = [];
                            charts.screen.data.datasets[0].data = [];
                        }

                        // 8. Chart Processor
                        if (d.processorUsage && d.processorUsage.length > 0) {
                            charts.processor.data.labels = d.processorUsage.map(i => i.processor);
                            charts.processor.data.datasets[0].data = d.processorUsage.map(i => i.total);
                        } else {
                            charts.processor.data.labels = [];
                            charts.processor.data.datasets[0].data = [];
                        }

                        // 9. Chart Camera
                        if (d.cameraUsage && d.cameraUsage.length > 0) {
                            charts.camera.data.labels = d.cameraUsage.map(i => i.back_camera);
                            charts.camera.data.datasets[0].data = d.cameraUsage.map(i => i.total);
                        } else {
                            charts.camera.data.labels = [];
                            charts.camera.data.datasets[0].data = [];
                        }

                        // 10. Chart Flagship
                        if (d.flagshipCompare && d.flagshipCompare.length > 0) {
                            charts.flagship.data.labels = d.flagshipCompare.map(i => i.category);
                            charts.flagship.data.datasets[0].data = d.flagshipCompare.map(i => i.total);
                        } else {
                            charts.flagship.data.labels = [];
                            charts.flagship.data.datasets[0].data = [];
                        }

                        // Update semua chart
                        Object.values(charts).forEach(c => c.update());
                    })
                    .catch(error => {
                        console.error('Error fetching filter data:', error);
                        alert('Terjadi kesalahan saat memuat data filter. Silakan coba lagi.');
                    });
            }

            // 🔥 EVENT LISTENER UNTUK FILTER
            document.querySelectorAll('.brand-checkbox').forEach(cb => {
                cb.addEventListener('change', updateChart);
            });

            const yearFilterElement = document.getElementById('yearFilter');
            if (yearFilterElement) {
                yearFilterElement.addEventListener('change', updateChart);
            }

            // Event listener untuk tombol Select All / Deselect All
            document.getElementById('selectAllBrands').addEventListener('click', function() {
                document.querySelectorAll('.brand-checkbox').forEach(cb => {
                    cb.checked = true;
                });
                updateChart();
            });

            document.getElementById('deselectAllBrands').addEventListener('click', function() {
                document.querySelectorAll('.brand-checkbox').forEach(cb => {
                    cb.checked = false;
                });
                updateChart();
            });

            console.log('Dashboard initialized - No brands selected by default');
        });
    </script>
</x-app-layout>