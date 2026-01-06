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

    {{-- ================= SCRIPT ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
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

        const charts = {
            brand: new Chart(chartBrand, {
                type: 'bar',
                data: { labels: [], datasets: [{ label:'Jumlah', data: [], backgroundColor:'#3b82f6' }] },
                options: baseOptions()
            }),

            year: new Chart(chartYear, {
                type: 'line',
                data: { labels: [], datasets: [{ label:'Jumlah', data: [], borderColor:'#22c55e', fill:true }] },
                options: {
                    ...baseOptions(),
                    plugins: { datalabels: { display: false } }
                }
            }),

            avgPrice: new Chart(chartAvgPrice, {
                type: 'bar',
                data: { labels: [], datasets: [{ label:'USD', data: [], backgroundColor:'#f59e0b' }] },
                options: baseOptions(v => '$' + Math.round(v))
            }),

            priceDist: new Chart(chartPriceDist, {
                type: 'bar',
                data: { labels: [], datasets: [{ label:'Jumlah', data: [], backgroundColor:'#8b5cf6' }] },
                options: baseOptions()
            }),

            ramPrice: new Chart(chartRamPrice, {
                type: 'scatter',
                data: { datasets: [{ label:'RAM vs Harga', data: [], backgroundColor:'#ec4899' }] },
                options: {
                    plugins: {
                        legend: { labels: { color: 'white' } },
                        datalabels: { display: false }
                    },
                    scales: {
                        x: { ticks: { color: 'white' }, title:{ display:true, text:'RAM (GB)', color:'white' } },
                        y: { ticks: { color: 'white' }, title:{ display:true, text:'Harga (USD)', color:'white' } }
                    }
                }
            }),

            battery: new Chart(chartBattery, {
                type: 'bar',
                data: { labels: [], datasets: [{ label:'mAh', data: [], backgroundColor:'#10b981' }] },
                options: baseOptions(v => Math.round(v) + ' mAh')
            }),

            screen: new Chart(chartScreen, {
                type: 'line',
                data: { labels: [], datasets: [{ label:'Inch', data: [], borderColor:'#0ea5e9' }] },
                options: {
                    ...baseOptions(v => v.toFixed(1) + '"'),
                    plugins: { datalabels: { display:false } }
                }
            }),

            processor: new Chart(chartProcessor, {
                type: 'bar',
                data: { labels: [], datasets: [{ label:'Jumlah', data: [], backgroundColor:'#f97316' }] },
                options: baseOptions()
            }),

            camera: new Chart(chartCamera, {
                type: 'bar',
                data: { labels: [], datasets: [{ label:'Jumlah', data: [], backgroundColor:'#a855f7' }] },
                options: baseOptions()
            }),

            flagship: new Chart(chartFlagship, {
                type: 'pie',
                data: { labels: [], datasets: [{ data: [], backgroundColor:['#ef4444','#22c55e'] }] },
                options: {
                    plugins: {
                        legend: { position:'bottom', labels:{ color:'white' } },
                        datalabels: {
                            color: 'white',
                            formatter: (v, ctx) => {
                                const t = ctx.chart.data.datasets[0].data.reduce((a,b)=>a+b,0);
                                return Math.round((v/t)*100) + '%';
                            }
                        }
                    }
                }
            })
        };

        function updateChart() {
            let brands = [...document.querySelectorAll('.brand-checkbox:checked')].map(cb => cb.value);
            if (!brands.length) brands = [...document.querySelectorAll('.brand-checkbox')].map(cb => cb.value);

            const params = new URLSearchParams();
            brands.forEach(b => params.append('brands[]', b));
            const year = yearFilter.value;
            if (year) params.append('year', year);

            fetch(`/dashboard/filter?${params}`)
                .then(res => res.json())
                .then(d => {
                    charts.brand.data.labels = d.perBrand.map(i=>i.company_name);
                    charts.brand.data.datasets[0].data = d.perBrand.map(i=>i.total);

                    charts.year.data.labels = d.perYear.map(i=>i.launched_year);
                    charts.year.data.datasets[0].data = d.perYear.map(i=>i.total);

                    charts.avgPrice.data.labels = d.avgPricePerBrand.map(i=>i.company_name);
                    charts.avgPrice.data.datasets[0].data = d.avgPricePerBrand.map(i=>i.avg_price);

                    charts.priceDist.data.labels = d.priceDistribution.map(i=>i.range_price);
                    charts.priceDist.data.datasets[0].data = d.priceDistribution.map(i=>i.total);

                    charts.ramPrice.data.datasets[0].data = d.ramVsPrice.map(i=>({x:i.ram,y:i.price}));

                    charts.battery.data.labels = d.avgBattery.map(i=>i.company_name);
                    charts.battery.data.datasets[0].data = d.avgBattery.map(i=>i.avg_battery);

                    charts.screen.data.labels = d.screenTrend.map(i=>i.launched_year);
                    charts.screen.data.datasets[0].data = d.screenTrend.map(i=>i.avg_screen);

                    charts.processor.data.labels = d.processorUsage.map(i=>i.processor);
                    charts.processor.data.datasets[0].data = d.processorUsage.map(i=>i.total);

                    charts.camera.data.labels = d.cameraUsage.map(i=>i.back_camera);
                    charts.camera.data.datasets[0].data = d.cameraUsage.map(i=>i.total);

                    charts.flagship.data.labels = d.flagshipCompare.map(i=>i.category);
                    charts.flagship.data.datasets[0].data = d.flagshipCompare.map(i=>i.total);

                    Object.values(charts).forEach(c => c.update());
                });
        }

        document.querySelectorAll('.brand-checkbox').forEach(cb => cb.addEventListener('change', updateChart));
        yearFilter.addEventListener('change', updateChart);
        updateChart();
    </script>
</x-app-layout>
