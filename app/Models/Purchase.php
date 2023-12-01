<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';

    protected $fillable = [
        'id',
        'pur_id',
        'pur_name',
        'pro_id',
        'category_id',
        'unit_id',
        'amount',
        'qty',
        'total_amt',
        'status',
        'remark',
    ];
}
    