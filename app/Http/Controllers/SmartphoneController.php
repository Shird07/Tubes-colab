<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SmartphoneController extends Controller
{
    // ===============================
    // TAMPILKAN DATA (ADMIN & USER + SEARCH + FILTER + PAGINATION)
    // ===============================
    public function index(Request $request)
    {
        $search = $request->search;
        $brandFilter = $request->brand;
        $yearFilter = $request->year;
        $ramFilter = $request->ram;

        // Query dengan semua filter
        $smartphones = Smartphone::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'LIKE', "%{$search}%")
                  ->orWhere('company_name', 'LIKE', "%{$search}%")
                  ->orWhere('processor', 'LIKE', "%{$search}%")
                  ->orWhere('ram', 'LIKE', "%{$search}%")
                  ->orWhere('price_usa', 'LIKE', "%{$search}%");
            });
        })
        ->when($brandFilter, function ($query, $brandFilter) {
            $query->where('company_name', $brandFilter);
        })
        ->when($yearFilter, function ($query, $yearFilter) {
            $query->where('launched_year', $yearFilter);
        })
        ->when($ramFilter, function ($query, $ramFilter) {
            $query->where('ram', 'LIKE', "%{$ramFilter}GB%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        // ========== DATA UNTUK STATS CARDS ==========
        // Total brand unik (dari semua data)
        $brandsCount = Smartphone::distinct('company_name')->count('company_name');
        
        // Rata-rata harga (handle berbagai format: $999, USD $999, dll)
        $avgPrice = 0;
        $prices = Smartphone::pluck('price_usa');
        $validPrices = $prices->filter(function($price) {
            return is_numeric(preg_replace('/[^0-9.]/', '', $price));
        });
        
        if ($validPrices->count() > 0) {
            $avgPrice = $validPrices->avg(function($price) {
                return floatval(preg_replace('/[^0-9.]/', '', $price));
            });
        }
        
        // Tahun terbaru
        $latestYear = Smartphone::max('launched_year');
        
        // ========== DATA UNTUK DROPDOWN FILTER ==========
        // Daftar brand unik untuk filter
        $brandsList = Smartphone::distinct('company_name')
            ->whereNotNull('company_name')
            ->orderBy('company_name')
            ->pluck('company_name');
        
        // Daftar tahun unik untuk filter
        $yearsList = Smartphone::distinct('launched_year')
            ->whereNotNull('launched_year')
            ->orderBy('launched_year', 'desc')
            ->pluck('launched_year');

        return view('smartphones.index', compact(
            'smartphones',
            'brandsCount',
            'avgPrice',
            'latestYear',
            'brandsList',
            'yearsList'
        ));
    }

    // ===============================
    // FORM TAMBAH DATA (ADMIN)
    // ===============================
    public function create()
    {
        return view('smartphones.create');
    }

    // ===============================
    // SIMPAN DATA (ADMIN)
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'company_name'     => 'required|string',
            'model_name'       => 'required|string',
            'mobile_weight'    => 'required|string',
            'ram'              => 'required|string',
            'front_camera'     => 'required|string',
            'back_camera'      => 'required|string',
            'processor'        => 'required|string',
            'battery_capacity' => 'required|string',
            'screen_size'      => 'required|string',
            'price_usa'        => 'required|string',
            'launched_year'    => 'required|integer',
        ]);

        Smartphone::create($request->only([
            'company_name',
            'model_name',
            'mobile_weight',
            'ram',
            'front_camera',
            'back_camera',
            'processor',
            'battery_capacity',
            'screen_size',
            'price_usa',
            'launched_year',
        ]));

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil ditambahkan');
    }

    // ===============================
    // FORM EDIT DATA (ADMIN)
    // ===============================
    public function edit(Smartphone $smartphone)
    {
        return view('smartphones.edit', compact('smartphone'));
    }

    // ===============================
    // UPDATE DATA (ADMIN)
    // ===============================
    public function update(Request $request, Smartphone $smartphone)
    {
        $request->validate([
            'company_name'     => 'required|string',
            'model_name'       => 'required|string',
            'mobile_weight'    => 'required|string',
            'ram'              => 'required|string',
            'front_camera'     => 'required|string',
            'back_camera'      => 'required|string',
            'processor'        => 'required|string',
            'battery_capacity' => 'required|string',
            'screen_size'      => 'required|string',
            'price_usa'        => 'required|string',
            'launched_year'    => 'required|integer',
        ]);

        $smartphone->update($request->only([
            'company_name',
            'model_name',
            'mobile_weight',
            'ram',
            'front_camera',
            'back_camera',
            'processor',
            'battery_capacity',
            'screen_size',
            'price_usa',
            'launched_year',
        ]));

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil diupdate');
    }

    // ===============================
    // HAPUS DATA (ADMIN)
    // ===============================
    public function destroy(Smartphone $smartphone)
    {
        $smartphone->delete();

        return redirect()
            ->route('smartphones.index')
            ->with('success', 'Data smartphone berhasil dihapus');
    }

    // ===============================
    // EXPORT TO EXCEL
    // ===============================
    public function exportExcel()
    {
        $export = new class implements \Maatwebsite\Excel\Concerns\FromCollection, 
            \Maatwebsite\Excel\Concerns\WithHeadings,
            \Maatwebsite\Excel\Concerns\WithMapping,
            \Maatwebsite\Excel\Concerns\WithStyles {
            
            public function collection()
            {
                return \App\Models\Smartphone::all();
            }
            
            public function headings(): array
            {
                return [
                    'ID',
                    'Brand',
                    'Model',
                    'Weight (g)',
                    'RAM',
                    'Front Camera',
                    'Back Camera',
                    'Processor',
                    'Battery Capacity',
                    'Screen Size',
                    'Price (USD)',
                    'Launched Year',
                ];
            }
            
            public function map($smartphone): array
            {
                return [
                    $smartphone->id,
                    $smartphone->company_name,
                    $smartphone->model_name,
                    $smartphone->mobile_weight,
                    $smartphone->ram,
                    $smartphone->front_camera,
                    $smartphone->back_camera,
                    $smartphone->processor,
                    $smartphone->battery_capacity,
                    $smartphone->screen_size,
                    $smartphone->price_usa,
                    $smartphone->launched_year,
                ];
            }
            
            public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
            {
                return [
                    // Style untuk header (baris pertama)
                    1 => [
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => 'FFFFFF']
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => '4F46E5'] // Warna ungu
                        ]
                    ],
                    
                    // Style untuk seluruh kolom
                    'A:N' => [
                        'alignment' => [
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ]
                    ],
                    
                    // Auto size untuk semua kolom
                    'A' => ['width' => 8],
                    'B' => ['width' => 15],
                    'C' => ['width' => 25],
                    'D' => ['width' => 12],
                    'E' => ['width' => 10],
                    'F' => ['width' => 15],
                    'G' => ['width' => 15],
                    'H' => ['width' => 20],
                    'I' => ['width' => 15],
                    'J' => ['width' => 12],
                    'K' => ['width' => 15],
                    'L' => ['width' => 12],
                    'M' => ['width' => 20],
                    'N' => ['width' => 20],
                ];
            }
        };
        
        $filename = 'smartphones_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download($export, $filename);
    }
}
//end controllerexel