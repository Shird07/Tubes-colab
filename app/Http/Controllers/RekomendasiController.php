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

        $budgetRupiah = (int) $request->budget;
        $budgetUSD = $budgetRupiah / $USD_TO_IDR;

        // =============================
        // 2. Validasi sederhana (opsional tapi disarankan)
        // =============================
        $request->validate([
            'budget'  => 'required|numeric|min:0',
            'ram'     => 'nullable|numeric|min:0',
            'kamera'  => 'nullable|numeric|min:0',
            'baterai' => 'nullable|numeric|min:0',
        ]);

        // =============================
        // 3. Siapkan input ke Service
        // =============================
        $input = [
            'budget'  => $budgetUSD,
            'ram'     => (int) ($request->ram ?? 0),
            'kamera'  => (int) ($request->kamera ?? 0),
            'baterai' => (int) ($request->baterai ?? 0),
        ];

        // =============================
        // 4. Hitung rekomendasi (Filter + SAW)
        // =============================
        $hasil = $service->calculate($input);

        // =============================
        // 5. Tampilkan hasil
        // =============================
        return view('rekomendasi.hasil', compact('hasil'));
    }
}
