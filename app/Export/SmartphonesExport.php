<?php

namespace App\Export;

use App\Models\Smartphone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SmartphonesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Smartphone::all();
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
            'Created At',
            'Updated At'
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

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ]
            ],
            
            'A:N' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            
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
}
//exel