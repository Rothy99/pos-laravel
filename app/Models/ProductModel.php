<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{

    protected $table = 'product';

    protected $fillable = [
        'id',
        'pro_name',
        'pro_code',
        'category_id',
        'cur_stock',
        'price',
        'alert',
        'unit_id',
        'image',
    ];

}
