<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecasting extends Model
{
    use HasFactory;

    public $table = 'forecasting';

    protected $fillable = [
        'forecast_category',
        'category',
        'forecast_value',
        'forecast_month',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];
}
