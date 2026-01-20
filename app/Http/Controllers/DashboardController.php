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

        // 🔥 AMBIL DATA HANYA UNTUK 7 CHART YANG DIBUTUHKAN
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

        // 3️⃣ Rata-rata Harga per Brand
        $avgPricePerBrand = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED)) as avg_price")
            )
            ->groupBy('company_name')
            ->get();

        // 4️⃣ Rata-rata Baterai per Brand
        $avgBattery = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REPLACE(battery_capacity, 'mAh', '') AS UNSIGNED)) as avg_battery")
            )
            ->groupBy('company_name')
            ->get();

        // 5️⃣ Processor Usage
        $processorUsage = (clone $baseQuery)
            ->select('processor', DB::raw('COUNT(*) as total'))
            ->groupBy('processor')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 6️⃣ Kamera Belakang Dominan
        $cameraUsage = (clone $baseQuery)
            ->select('back_camera', DB::raw('COUNT(*) as total'))
            ->groupBy('back_camera')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 7️⃣ Flagship vs Non-Flagship
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
            
            // HANYA 7 DATA YANG DIBUTUHKAN
            'perBrand' => $perBrand,
            'perYear' => $perYear,
            'avgPricePerBrand' => $avgPricePerBrand,
            'avgBattery' => $avgBattery,
            'processorUsage' => $processorUsage,
            'cameraUsage' => $cameraUsage,
            'flagshipCompare' => $flagshipCompare,
        ]);
    }

    // ================= FILTER (AJAX | HANYA 7 CHART) =================
    public function filter(Request $request)
    {
        $baseQuery = Smartphone::query();

        // 🔥 FIX: Handle ketika TIDAK ADA brand yang dipilih
        if ($request->has('brands') && !empty($request->brands)) {
            $baseQuery->whereIn('company_name', $request->brands);
        }

        // 🔥 FILTER TAHUN
        if ($request->filled('year')) {
            $year = $request->year;
            $baseQuery->where('launched_year', $year);
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

        // 3️⃣ Rata-rata Harga per Brand
        $avgPricePerBrand = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REGEXP_SUBSTR(price_usa, '[0-9]+') AS UNSIGNED)) as avg_price")
            )
            ->groupBy('company_name')
            ->get();

        // 4️⃣ Rata-rata Baterai per Brand
        $avgBattery = (clone $baseQuery)
            ->select(
                'company_name',
                DB::raw("AVG(CAST(REPLACE(battery_capacity, 'mAh', '') AS UNSIGNED)) as avg_battery")
            )
            ->groupBy('company_name')
            ->get();

        // 5️⃣ Processor Usage
        $processorUsage = (clone $baseQuery)
            ->select('processor', DB::raw('COUNT(*) as total'))
            ->groupBy('processor')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 6️⃣ Kamera Belakang Dominan
        $cameraUsage = (clone $baseQuery)
            ->select('back_camera', DB::raw('COUNT(*) as total'))
            ->groupBy('back_camera')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 7️⃣ Flagship vs Non-Flagship
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
            // HANYA KIRIM 7 DATA YANG DIBUTUHKAN
            'perBrand' => $perBrand,
            'perYear' => $perYear,
            'avgPricePerBrand' => $avgPricePerBrand,
            'avgBattery' => $avgBattery,
            'processorUsage' => $processorUsage,
            'cameraUsage' => $cameraUsage,
            'flagshipCompare' => $flagshipCompare,
        ]);
    }
}