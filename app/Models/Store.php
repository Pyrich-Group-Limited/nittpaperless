<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_identification_code',
        'asset_type',
        'asset_description',
        'location',
        'number_of_units',
        'model_number',
        'year_of_manufacture',
        'serial_number',
        'date_of_purchase',
        'initial_cost',
        'measure_improvement',
        'depreciation',
        'appreciation',
    ];
}
