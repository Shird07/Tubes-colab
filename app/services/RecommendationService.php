<?php

namespace App\Services;

use App\Models\Smartphone;
use Illuminate\Support\Collection;

class RecommendationService
{
    /**
     * Hitung rekomendasi smartphone dengan metode SAW
     */
    public function calculate(array $input): Collection
    {
        // =============================
        // 1. Filter berdasarkan budget
        // =============================
        $smartphones = Smartphone::where(
            'price_usa',
            '<=',
            $input['budget']
        )->get();

        if ($smartphones->isEmpty()) {
            return collect();
        }

        // =============================
        // 2. Ambil nilai max & min
        // =============================
        $maxRam     = $smartphones->max('ram');
        $maxCamera  = $smartphones->max('back_camera');
        $maxBattery = $smartphones->max('battery_capacity');
        $minPrice   = $smartphones->min('price_usa');

        // =============================
        // 3. Normalisasi bobot user
        // =============================
        $totalBobot =
            $input['ram'] +
            $input['kamera'] +
            $input['baterai'] +
            5; // bobot harga default

        $wHarga   = 5 / $totalBobot;
        $wRam     = $input['ram'] / $totalBobot;
        $wKamera  = $input['kamera'] / $totalBobot;
        $wBaterai = $input['baterai'] / $totalBobot;

        // =============================
        // 4. Hitung skor SAW
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
                $hargaNorm   = $minPrice / max($phone->price_usa, 1);
                $ramNorm     = $phone->ram / max($maxRam, 1);
                $kameraNorm  = $phone->back_camera / max($maxCamera, 1);
                $bateraiNorm = $phone->battery_capacity / max($maxBattery, 1);

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
// cuihhh