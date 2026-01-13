<?php

namespace App\Services;

use App\Models\Smartphone;
use Illuminate\Support\Collection;

class RecommendationService
{
    public function calculate(array $input): Collection
    {
        // =============================
        // 1. FILTER BERDASARKAN SPESIFIKASI MINIMAL
        // =============================
        $smartphones = Smartphone::where('price_usa', '<=', $input['budget'])
            ->where('ram', '>=', $input['ram'])
            ->where('back_camera', '>=', $input['kamera'])
            ->where('battery_capacity', '>=', $input['baterai'])
            ->get();

        if ($smartphones->isEmpty()) {
            return collect();
        }

        // =============================
        // 2. AMBIL NILAI MAX & MIN
        // =============================
        $maxRam     = max(1, $smartphones->max('ram'));
        $maxCamera  = max(1, $smartphones->max('back_camera'));
        $maxBattery = max(1, $smartphones->max('battery_capacity'));
        $minPrice   = max(1, $smartphones->min('price_usa'));

        // =============================
        // 3. BOBOT TETAP (DITENTUKAN SISTEM)
        // =============================
        $wHarga   = 0.40; // cost
        $wRam     = 0.20; // benefit
        $wKamera  = 0.25; // benefit
        $wBaterai = 0.15; // benefit

        // =============================
        // 4. HITUNG SKOR SAW
        // =============================
        return $smartphones
            ->map(function ($phone) use (
                $minPrice,
                $maxRam,
                $maxCamera,
                $maxBattery,
                $wHarga,
                $wRam,
                $wKamera,
                $wBaterai
            ) {
                // Normalisasi
                $hargaNorm   = $minPrice / max($phone->price_usa, 1);      // cost
                $ramNorm     = $phone->ram / $maxRam;                      // benefit
                $kameraNorm  = $phone->back_camera / $maxCamera;           // benefit
                $bateraiNorm = $phone->battery_capacity / $maxBattery;     // benefit

                $score =
                    ($hargaNorm   * $wHarga) +
                    ($ramNorm     * $wRam) +
                    ($kameraNorm  * $wKamera) +
                    ($bateraiNorm * $wBaterai);

                return (object) [
                    'smartphone' => $phone,
                    'score'      => round($score, 4),
                ];
            })
            ->sortByDesc('score')
            ->values();
    }
}
