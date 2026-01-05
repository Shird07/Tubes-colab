<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    use HasFactory;

    protected $table = 'smartphones';

    // Nonaktifkan kolom created_at & updated_at
    public $timestamps = false;

    protected $fillable = [
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
    ];
}
