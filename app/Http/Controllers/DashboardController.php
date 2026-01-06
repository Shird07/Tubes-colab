<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSmartphone = Smartphone::count();

        // Data untuk filter
        $brands = Smartphone::select('company_name')
            ->distinct()
            ->orderBy('company_name')
            ->pluck('company_name');

        $years = Smartphone::select('launched_year')
            ->distinct()
            ->orderBy('launched_year')
            ->pluck('launched_year');

        // 🔥 AMBIL DATA UNTUK SEMUA CHART AWAL
        $baseQuery = Smartphone::query();

        // 1️⃣ Jumlah Smartphone per Brand
        $perBrand = (clone $baseQuery)
            ->select('company_name', DB::raw('COUNT(*) as total'))
            ->groupBy('company_name')
            ->orderBy('total', 'desc')
            ->get();

        // 2️⃣ Jumlah Smartphone per Tahun
        $perYear = (clone $baseQuery)
            ->select('launched_year', DB::raw('COUNT(*) as total'))
            ->groupBy('launched_year')
            ->orderBy('launched_year')
            ->get();

        // 3️⃣ Distribusi Harga Smartphone - PERBAIKI QUERY
        $priceDistribution = (clone $baseQuery)
            ->selectRaw("
                CASE
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) < 200 THEN '< 200'
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) BETWEEN 200 AND 399 THEN '200 - 399'
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) BETWEEN 400 AND 699 THEN '400 - 699'
                    ELSE '>= 700'
                END as range_price,
                COUNT(*) as total
            ")
            ->groupBy('range_price')
            ->get();

        // 4️⃣ Rata-rata Harga per Brand - PERBAIKI QUERY
        $avgPricePerBrand = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED)) as avg_price")
            )
            ->groupBy('company_name')
            ->get();

        // 5️⃣ RAM vs Harga - PERBAIKI QUERY
        $ramVsPrice = (clone $baseQuery)
            ->select(
                DB::raw("CAST(REPLACE(ram, 'GB', '') AS UNSIGNED) as ram"),
                DB::raw("CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) as price")
            )
            ->whereNotNull('ram')
            ->whereNotNull('price_usa')
            ->get();

        // 6️⃣ Rata-rata Baterai per Brand
        $avgBattery = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REPLACE(battery_capacity, 'mAh', '') AS UNSIGNED)) as avg_battery")
            )
            ->groupBy('company_name')
            ->get();

        // 7️⃣ Ukuran Layar vs Tahun Rilis
        $screenTrend = (clone $baseQuery)
            ->select(
                'launched_year',
                DB::raw('AVG(CAST(screen_size AS DECIMAL(4,2))) as avg_screen')
            )
            ->groupBy('launched_year')
            ->orderBy('launched_year')
            ->get();

        // 8️⃣ Processor Usage
        $processorUsage = (clone $baseQuery)
            ->select('processor', DB::raw('COUNT(*) as total'))
            ->groupBy('processor')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 9️⃣ Kamera Belakang Dominan
        $cameraUsage = (clone $baseQuery)
            ->select('back_camera', DB::raw('COUNT(*) as total'))
            ->groupBy('back_camera')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 🔟 Flagship vs Non-Flagship - PERBAIKI QUERY
        $flagshipCompare = (clone $baseQuery)
            ->selectRaw("
                CASE
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) >= 700
                        THEN 'Flagship'
                    ELSE 'Non-Flagship'
                END as category,
                COUNT(*) as total
            ")
            ->groupBy('category')
            ->get();

        return view('dashboard', [
            'totalSmartphone' => $totalSmartphone,
            'brands' => $brands,
            'years' => $years,
            'perBrand' => $perBrand,
            'perYear' => $perYear,
            'priceDistribution' => $priceDistribution,
            'avgPricePerBrand' => $avgPricePerBrand,
            'ramVsPrice' => $ramVsPrice,
            'avgBattery' => $avgBattery,
            'screenTrend' => $screenTrend,
            'processorUsage' => $processorUsage,
            'cameraUsage' => $cameraUsage,
            'flagshipCompare' => $flagshipCompare,
        ]);
    }

    // ================= FILTER (AJAX | SEMUA VISUALISASI) =================
    public function filter(Request $request)
    {
        $baseQuery = Smartphone::query();

        // 🔥 FIX: Handle ketika TIDAK ADA brand yang dipilih
        if ($request->has('brands') && !empty($request->brands)) {
            $baseQuery->whereIn('company_name', $request->brands);
        }

        // 🔥 FILTER TAHUN
        if ($request->filled('year')) {
            $baseQuery->where('launched_year', $request->year);
        }

        // 1️⃣ Jumlah Smartphone per Brand
        $perBrand = (clone $baseQuery)
            ->select('company_name', DB::raw('COUNT(*) as total'))
            ->groupBy('company_name')
            ->orderBy('total', 'desc')
            ->get();

        // 2️⃣ Jumlah Smartphone per Tahun
        $perYear = (clone $baseQuery)
            ->select('launched_year', DB::raw('COUNT(*) as total'))
            ->groupBy('launched_year')
            ->orderBy('launched_year')
            ->get();

        // 3️⃣ Distribusi Harga Smartphone - PERBAIKI QUERY
        $priceDistribution = (clone $baseQuery)
            ->selectRaw("
                CASE
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) < 200 THEN '< 200'
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) BETWEEN 200 AND 399 THEN '200 - 399'
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) BETWEEN 400 AND 699 THEN '400 - 699'
                    ELSE '>= 700'
                END as range_price,
                COUNT(*) as total
            ")
            ->groupBy('range_price')
            ->get();

        // 4️⃣ Rata-rata Harga per Brand - PERBAIKI QUERY
        $avgPricePerBrand = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED)) as avg_price")
            )
            ->groupBy('company_name')
            ->get();

        // 5️⃣ RAM vs Harga - PERBAIKI QUERY
        $ramVsPrice = (clone $baseQuery)
            ->select(
                DB::raw("CAST(REPLACE(ram, 'GB', '') AS UNSIGNED) as ram"),
                DB::raw("CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) as price")
            )
            ->whereNotNull('ram')
            ->whereNotNull('price_usa')
            ->get();

        // 6️⃣ Rata-rata Baterai per Brand
        $avgBattery = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REPLACE(battery_capacity, 'mAh', '') AS UNSIGNED)) as avg_battery")
            )
            ->groupBy('company_name')
            ->get();

        // 7️⃣ Ukuran Layar vs Tahun Rilis
        $screenTrend = (clone $baseQuery)
            ->select(
                'launched_year',
                DB::raw('AVG(CAST(screen_size AS DECIMAL(4,2))) as avg_screen')
            )
            ->groupBy('launched_year')
            ->orderBy('launched_year')
            ->get();

        // 8️⃣ Processor Usage
        $processorUsage = (clone $baseQuery)
            ->select('processor', DB::raw('COUNT(*) as total'))
            ->groupBy('processor')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 9️⃣ Kamera Belakang Dominan
        $cameraUsage = (clone $baseQuery)
            ->select('back_camera', DB::raw('COUNT(*) as total'))
            ->groupBy('back_camera')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 🔟 Flagship vs Non-Flagship - PERBAIKI QUERY
        $flagshipCompare = (clone $baseQuery)
            ->selectRaw("
                CASE
                    WHEN CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED) >= 700
                        THEN 'Flagship'
                    ELSE 'Non-Flagship'
                END as category,
                COUNT(*) as total
            ")
            ->groupBy('category')
            ->get();

        return response()->json([
            'perBrand' => $perBrand,
            'perYear' => $perYear,
            'priceDistribution' => $priceDistribution,
            'avgPricePerBrand' => $avgPricePerBrand,
            'ramVsPrice' => $ramVsPrice,
            'avgBattery' => $avgBattery,
            'screenTrend' => $screenTrend,
            'processorUsage' => $processorUsage,
            'cameraUsage' => $cameraUsage,
            'flagshipCompare' => $flagshipCompare,
        ]);
    }
}

// Baby