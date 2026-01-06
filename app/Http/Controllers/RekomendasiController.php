<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecommendationService;

class RekomendasiController extends Controller
{
    public function proses(Request $request, RecommendationService $service)
    {
        // =============================
        // 1. Konversi Rupiah → USD
        // =============================
        $USD_TO_IDR = 16000;

        $budgetUSD = ((int) $request->budget) / $USD_TO_IDR;

        // =============================
        // 2. Siapkan input ke Service
        // =============================
        $input = [
            'budget'  => $budgetUSD,
            'ram'     => (int) ($request->ram ?? 0),
            'kamera'  => (int) ($request->kamera ?? 0),
            'baterai' => (int) ($request->baterai ?? 0),
        ];

        // =============================
        // 3. Hitung rekomendasi (SAW)
        // =============================
        $hasil = $service->calculate($input);

        // =============================
        // 4. Tampilkan hasil
        // =============================
        return view('rekomendasi.hasil', compact('hasil'));
    }
}
