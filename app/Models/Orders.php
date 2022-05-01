<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $table = 'company_orders';

    protected $fillable = [
        'transaction_id',
        'stock_id',
        'quantity',
        'total_price',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];
}
