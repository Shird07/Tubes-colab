<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;

class RekomendasiController extends Controller
{
    public function proses(Request $r)
    {
        // =============================
        // 1. KONVERSI RUPIAH → USD
        // =============================
        $USD_TO_IDR = 16000;

        $budgetRupiah = (int) $r->budget;
        $budgetUSD    = $budgetRupiah / $USD_TO_IDR;

        // =============================
        // 2. QUERY DASAR (WAJIB)
        // =============================
        $q = Smartphone::query();
        $q->where('price_usa', '<=', $budgetUSD);

        // =============================
        // 3. FILTER OPSIONAL
        // =============================
        if (!empty($r->brand)) {
            $q->where('company_name', 'LIKE', '%' . $r->brand . '%');
        }

        if (!empty($r->camera)) {
            $q->where('back_camera', '>=', (int) $r->camera);
        }

        if (!empty($r->ram)) {
            $q->where('ram', '>=', (int) $r->ram);
        }

        if (!empty($r->battery)) {
            $q->where('battery_capacity', '>=', (int) $r->battery);
        }

        if (!empty($r->processor) && is_array($r->processor)) {
            $q->whereIn('processor', $r->processor);
        }

        $data = $q->get();

        // =============================
        // 4. FALLBACK JIKA KOSONG
        // =============================
        if ($data->isEmpty()) {
            $data = Smartphone::where('price_usa', '<=', $budgetUSD)
                ->orderBy('price_usa', 'desc')
                ->limit(5)
                ->get();

            if ($data->isEmpty()) {
                return back()->with('error', 'Budget terlalu kecil, tidak ada smartphone yang sesuai.');
            }
        }

        // =============================
        // 5. SCORING + ALASAN
        // =============================
        $maxCamera  = max(1, $data->max('back_camera'));
        $maxRam     = max(1, $data->max('ram'));
        $maxBattery = max(1, $data->max('battery_capacity'));

        $hasil = $data->map(function ($p) use ($maxCamera, $maxRam, $maxBattery, $USD_TO_IDR, $r) {

            $score =
                ($p->back_camera / $maxCamera) +
                ($p->ram / $maxRam) +
                ($p->battery_capacity / $maxBattery);

            $alasan = [];

            if ($r->camera && $p->back_camera >= $r->camera) {
                $alasan[] = "Kamera {$p->back_camera} MP sesuai kebutuhan Anda";
            }

            if ($r->ram && $p->ram >= $r->ram) {
                $alasan[] = "RAM {$p->ram} GB mendukung multitasking";
            }

            if ($r->battery && $p->battery_capacity >= $r->battery) {
                $alasan[] = "Baterai {$p->battery_capacity} mAh tahan lama";
            }

            if (empty($alasan)) {
                $alasan[] = "Pilihan terbaik dalam budget Anda";
            }

            return [
                'phone'    => $p,
                'score'    => round($score, 3),
                'price_rp' => (int) ($p->price_usa * $USD_TO_IDR),
                'alasan'   => $alasan,
            ];
        })->sortByDesc('score')->values();

        // =============================
        // 6. RETURN VIEW (INI YANG TADI HILANG)
        // =============================
        return view('rekomendasi.hasil', compact('hasil'));
    }
}
