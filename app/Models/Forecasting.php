<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecasting extends Model
{
    use HasFactory;

    public $table = 'forecasting';

    protected $fillable = [
        'category',
        'forecast_supply',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];
}
