<?php

namespace App\Services;

use App\Models\Smartphone;

class RecommendationService
{
    public function calculate(array $input)
    {
        // =============================
        // 1. Ambil data smartphone
        // =============================
        $smartphones = Smartphone::all();

        if ($smartphones->isEmpty()) {
            return collect();
        }

        // =============================
        // 2. Filter berdasarkan budget
        // =============================
        $filtered = $smartphones->where('price', '<=', $input['budget']);

        if ($filtered->isEmpty()) {
            return collect();
        }

        // =============================
        // 3. Ambil nilai max & min
        // =============================
        $maxRam     = $filtered->max('ram');
        $maxCamera  = $filtered->max('camera');
        $maxBattery = $filtered->max('battery');

        $minPrice = $filtered->min('price');

        // =============================
        // 4. Normalisasi bobot user
        // =============================
        $totalBobot =
            $input['ram'] +
            $input['kamera'] +
            $input['baterai'] +
            5; // harga default

        $wHarga   = 5 / $totalBobot;
        $wRam     = $input['ram'] / $totalBobot;
        $wKamera  = $input['kamera'] / $totalBobot;
        $wBaterai = $input['baterai'] / $totalBobot;

        // =============================
        // 5. Hitung skor SAW
        // =============================
        $result = $filtered->map(function ($phone) use (
            $minPrice,
            $maxRam,
            $maxCamera,
            $maxBattery,
            $wHarga,
            $wRam,
            $wKamera,
            $wBaterai
        ) {
            $hargaNorm   = $minPrice / $phone->price;       // cost
            $ramNorm     = $phone->ram / $maxRam;           // benefit
            $kameraNorm  = $phone->camera / $maxCamera;     // benefit
            $bateraiNorm = $phone->battery / $maxBattery;   // benefit

            $score =
                ($hargaNorm * $wHarga) +
                ($ramNorm * $wRam) +
                ($kameraNorm * $wKamera) +
                ($bateraiNorm * $wBaterai);

            return [
                'smartphone' => $phone,
                'score'      => round($score, 4),
            ];
        });

        // =============================
        // 6. Urutkan hasil
        // =============================
        return $result->sortByDesc('score')->values();
    }
    public function calculateFromCollection($smartphones)
{
    if ($smartphones->isEmpty()) {
        return collect();
    }

    // Parsing numerik dari VARCHAR
    $prices   = $smartphones->map(fn($s) => (int) preg_replace('/\D/', '', $s->price));
    $rams     = $smartphones->map(fn($s) => (int) preg_replace('/\D/', '', $s->ram));
    $cameras  = $smartphones->map(fn($s) => (int) preg_replace('/\D/', '', $s->camera));
    $batteries= $smartphones->map(fn($s) => (int) preg_replace('/\D/', '', $s->battery));

    $minPrice   = $prices->min();
    $maxRam     = $rams->max();
    $maxCamera  = $cameras->max();
    $maxBattery = $batteries->max();

    // Bobot default (bisa dikembangkan)
    $wHarga   = 0.3;
    $wRam     = 0.2;
    $wKamera  = 0.3;
    $wBaterai = 0.2;

    return $smartphones->map(function ($phone) use (
        $minPrice, $maxRam, $maxCamera, $maxBattery,
        $wHarga, $wRam, $wKamera, $wBaterai
    ) {
        $price   = (int) preg_replace('/\D/', '', $phone->price);
        $ram     = (int) preg_replace('/\D/', '', $phone->ram);
        $camera  = (int) preg_replace('/\D/', '', $phone->camera);
        $battery = (int) preg_replace('/\D/', '', $phone->battery);

        $score =
            (($minPrice / max($price,1)) * $wHarga) +
            (($ram / max($maxRam,1)) * $wRam) +
            (($camera / max($maxCamera,1)) * $wKamera) +
            (($battery / max($maxBattery,1)) * $wBaterai);

        return [
            'smartphone' => $phone,
            'score' => round($score, 4),
        ];
    })->sortByDesc('score')->values();
}

}


