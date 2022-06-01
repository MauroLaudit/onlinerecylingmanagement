<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $table = 'transaction_company';

    protected $fillable = [
        'transaction_id',
        'company_name',
        'client_name',
        'address',
        'contact_no',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    // public function Orders()
    // {
    //     return $this->belongsTo(Orders::class);
    // }
}
