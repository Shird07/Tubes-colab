<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'Gopix', 'logo' => 'partner/Gopix.png'],
            ['name' => 'Honor', 'logo' => 'partner/Honor.png'],
            ['name' => 'Huawei', 'logo' => 'partner/huawei.png'],
            ['name' => 'Infinix', 'logo' => 'partner/infinix.png'],
            ['name' => 'iPhone', 'logo' => 'partner/iphone.png'],
            ['name' => 'iQOO', 'logo' => 'partner/iqoo.png'],
            ['name' => 'Lenovo', 'logo' => 'partner/lenovo.png'],
            ['name' => 'Motorola', 'logo' => 'partner/motorola.png'],
            ['name' => 'Nokia', 'logo' => 'partner/nokia.png'],
            ['name' => 'OnePlus', 'logo' => 'partner/oneplus.png'],
            ['name' => 'Oppo', 'logo' => 'partner/oppo.png'],
            ['name' => 'Poco', 'logo' => 'partner/poco.png'],
            ['name' => 'Realme', 'logo' => 'partner/realme.png'],
            ['name' => 'Samsung', 'logo' => 'partner/samsung.png'],
            ['name' => 'Sony', 'logo' => 'partner/sony.png'],
            ['name' => 'Tecno Mobile', 'logo' => 'partner/tecno_mobile.png'],
            ['name' => 'Vivo', 'logo' => 'partner/vivo.png'],
            ['name' => 'Xiaomi', 'logo' => 'partner/xiaomi.png'],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
