<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmartphoneController extends Controller
{
    // ===============================
    // TAMPILKAN DATA VISUALISASI (CHART)
    // ===============================
    public function index(Request $request)
    {
        // Data untuk chart: Jumlah Smartphone per Brand
        $brandData = Smartphone::select('company_name', DB::raw('COUNT(*) as total'))
            ->groupBy('company_name')
            ->orderBy('total', 'desc')
            ->get();

        $brands = $brandData->pluck('company_name')->toArray();
        $brandTotals = $brandData->pluck('total')->toArray();

        // Data untuk chart: Jumlah Smartphone per Tahun
        $yearData = Smartphone::select('launched_year', DB::raw('COUNT(*) as total'))
            ->groupBy('launched_year')
            ->orderBy('launched_year')
            ->get();

        $years = $yearData->pluck('launched_year')->toArray();
        $yearTotals = $yearData->pluck('total')->toArray();

        return view('smartphones.index', compact('brands', 'brandTotals', 'years', 'yearTotals'));
    }

    // ===============================
    // TAMPILKAN DATA TABEL (UNTUK HALAMAN LAIN)
    // ===============================
    public function list(Request $request)
    {
        $search = $request->search;

        $smartphones = Smartphone::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'LIKE', "%{$search}%")
                  ->orWhere('company_name', 'LIKE', "%{$search}%")
                  ->orWhere('processor', 'LIKE', "%{$search}%")
                  ->orWhere('ram', 'LIKE', "%{$search}%")
                  ->orWhere('price_usa', 'LIKE', "%{$search}%");
            });
        })->paginate(10);

        return view('smartphones.list', compact('smartphones'));
    }

    // Method lainnya tetap sama...
    // create(), store(), edit(), update(), destroy()
}